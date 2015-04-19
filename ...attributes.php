<?php
function attributes(&$text) {
    static $pattern = '{\{[^\}]*\}}';
    $att = '';
    while (preg_match_all($pattern, $text, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $what = substr(trim($match[0]), 1, -1);
            $text = str_replace($match[0], '', $text);
            $att .= ' '.$what;
        }
    }
    return $att;
}
?>
