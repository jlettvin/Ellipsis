<?php
function interpret_line_breaks($line) {
    $line = str_replace(
        "^^^^^",
        EL_PAGE ?
        '</div><div class="page">' :
        page_break(horizontal_rule("red")),
        $line);
    $line = str_replace(
        "^^^^",
        '<br clear="all" /><br />', $line);
    $line = str_replace(
        "^^^",
        '<br />', $line);
    $line = str_replace("-----", horizontal_rule("black"), $line);
    return $line;
}
?>
