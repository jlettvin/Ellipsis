<?php
/// `bulleted.$id|$label|$code`
/// `numbered.$id|$label|$code`
///
/// $id: a keyword to use when referencing this list;
/// $label: a title for the containing box;
/// $code: material to convert to a list.

function list_assist(&$the, $type) {
    static $N = 0;
    static $Narray = [];
    static $types = ['ul', 'ol'];

    if ($the == [])
        return document_service(__FILE__, 'equation', 'defaults', $def);

    extract($the);
    if(!isset($code))
        return $Narray[$id];

    $content = [];
    $return = '';
    $refno = '';
    if (isset($code)) $content = array_map('trim', explode(PHP_EOL, $code));
    if (count($content)) {
        $return = "<{$type} align=\"left\">";
        foreach ($content as $item)
            if (($item = trim($item))) $return .= "<li>{$item}</li>";
        $return .= "</{$type}>";
        $N++;
        $refno = "{$prefix}{$N}";
        $Narray[$id] = $refno;
        $the['meta'] = "List {$refno}";
    }
    return $return;
}

function bulleted($the) {
    $the['code'] = list_assist($the, 'ul');
    return box($the);
}

function numbered($the) {
    $the['code'] = list_assist($the, 'ol');
    return box($the);
}
?>
