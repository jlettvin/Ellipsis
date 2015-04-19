<?php
function interpret_line_quotes($line) {
    static $quotes = [
        '\'\'\'\'\'' => ['<b><i>', '</i></b>'],
        '\'\'\'' => ['<i>', '</i>'],
        '\'\'' => ['<b>', '</b>'],
        ];
    foreach ($quotes as $pattern => $pair) {
        $parts = explode($pattern, $line);
        assert(count($parts)&1);
        $line = '';
        foreach ($parts as $n => $part) {
            if ($n&1) $part = $pair[0].$part.$pair[1];
            $line .= $part;
        }
    }
    return $line;
}
?>
