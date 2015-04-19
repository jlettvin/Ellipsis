<?php
function interpret_line_breaks($line) {
    $line = str_replace("^^^^", '<br clear="all" /><br />', $line);
    $line = str_replace("^^^", '<br />', $line);
    $line = str_replace("-----", '<hr />', $line);
    return $line;
}
?>
