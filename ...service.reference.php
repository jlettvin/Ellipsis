<?php
/// `reference.$id|$label|$code`
///
/// $id: a keyword to use when referencing this reference;
/// $label: a title for this reference;
/// $code: TeX instructions to generate this reference.
///
/// This module prepares in-text references and reference listings.
/// $label is unused.

function reference($the = []) {
    static $gparray = [];
    static $lbarray = [];
    static $N = 1;
    global $ellipsis;

    static $theKeys = ['prefix', 'id', 'label', 'code'];

    extract($the);
    $return = '';
    if (isset($code)) {
        $entries = '';
        foreach (explode(PHP_EOL, $code) as $line) {
            $temp = array_map('trim', explode('=', $line, 2));
            if (count($temp) != 2)
                continue;
            list($key, $val) = array_map('trim', explode('=', $line, 2));
            $val = str_replace("'", "\'", $val);
            $val = htmlspecialchars($val);
            $tmps = "'{$key}' => '{$val}',";
            $entries .= $tmps;
        }
        $code = "[{$entries}]";

        eval("\$publication = {$code};");
        if (!isset($ellipsis['reference'][$id])) {
            $ellipsis['reference'][$id] = $publication;
        }
        extract($publication);
        // No manifestation of definition.
    } else if (isset($ellipsis['reference'][$id])) {
        $publication = $ellipsis['reference'][$id];
        if (isset($publication)) {
            extract($publication);
            if (!isset($refno)) {
                $publication['refno'] = $refno = $N++;
                $ellipsis['reference'][$refno] = $publication;
                $ellipsis['reference'][$id   ] = $publication;
            }
            if (isset($etal)) {
                $return = $etal;
            } else if(isset($author)) {
                $return = $author;
            } else {
                $mangled = implode(',', $publication);
                TODO($mangled);
            }
            $return .= "<sup>{$refno}</sup>";
        }
    } else {
        $return = 'Calls to reference require 2 parts ref, or 4 parts def.';
    }
    return $return;
}

function references() {
    global $ellipsis;
    // The order of these keys dictates the order of display.
    $pubKeys = [
        'booktitle', 'title', 'author', 'etal',
        'publication', 'journal', 'edition',
        'specific', 'year', 'month', 'date',
        'volume', 'number', 'pages',
        'publisher', 'organization', 'address',
        'isbn',
        'note'
    ];

    if (!isset($pubKeys)) echo "****FOO****";
    $ref = $ellipsis['reference'];
    $N = 1+count($ref) / 2;
    $return = '';
    for ($n = 1; $n < $N; $n++) {
        $return .= "<tr><td valign=\"top\">{$n}.</td><td>";
        $comma = '';
        foreach ($pubKeys as $key) {
            if (isset($ref[$n][$key])) {
                $return .= $comma.$ref[$n][$key];
                $comma = ', ';
            }
        }
        $return .= '</td></tr>'.PHP_EOL;
        //$return .= "<br/>";
    }
    return tag('table', $return);
}
?>
