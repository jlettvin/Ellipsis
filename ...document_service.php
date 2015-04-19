<?php
function document_service($source, $service, $title, $array) {
    global $ellipsis;
    $defs = '';
    foreach ($array as $key=>$val)
        if ($key and $val)
            $defs .= "<tr><td align=\"right\">{$key}</td><td>{$val}</td></tr>";
    if ($defs == '') $defs = '<tr><td>No defaults ...</td></tr>';
    //$source = str_replace('`', '&x#60;', $source);
    return
        '<table border="1" bgcolor="#f0f0f0">'.
        '<tr><td align="center" colspan="2"><b><u>'.
        "{$service}</u> {$title} ...".
        '</b></td></tr>'.
        $defs.
        '<tr><td colspan="2"><small>'.
        "{$source}".
        '</small></td></tr>'.
        "</table>".
        //$ellipsis['doc'][$service].
        PHP_EOL;
}
?>
