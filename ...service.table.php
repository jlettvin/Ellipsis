<?php
/// `table.$id|$label|$code`
///
/// $id: a keyword to use when referencing this tabe;
/// $label: a title for the containing box;
/// $code: material to convert to a table.
function table(&$the) {
    static $N = 0;
    static $Narray = [];

    if ($the == [])
        return document_service(__FILE__, 'equation', 'defaults', $def);

    extract($the);
    if(!isset($code))
        return $Narray[$id];

    $result = '';
    if (isset($code)) {
        $content = array_map('trim', explode(PHP_EOL, $code));
        if (count($content)) {
            $result .= "<table>";
            //$result .= "<caption>{$label}</caption>";
            foreach ($content as $line) {
                $result .= "<tr>";
                foreach (array_map('trim', explode('|', $line)) as $cell)
                    $result .= "<td>{$cell}</td>";
                $result .= "</tr>";
            }
            $result .= "</table>";
        }
        $N++;
        $refno = "{$prefix}{$N}";
        $Narray[$id] = $refno;
        $the['meta'] = "Table {$refno}";
    }
    $the['code'] = $result;
    return box($the);
}
?>
