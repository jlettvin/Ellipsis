<?php
function interpret_line_breaks($line) {
    $line = str_replace(
        "^^^^^",
        '<br clear="all" /><br />'.
        '<div style="page-break-after:always"></div>',
        $line);
    $line = str_replace(
        "^^^^",
        '<br clear="all" /><br />', $line);
    $line = str_replace(
        "^^^",
        '<br />', $line);
    $line = str_replace(
        "-----",
        '<hr />', $line);
    return $line;
}
?>
