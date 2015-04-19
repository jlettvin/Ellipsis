<?php
function interpret_line_indent($line) {
    for ($n = 6; $n >= 3; $n--) {
        if (substr($line, 0, $n) == str_repeat('_', $n)) {
            $S = str_repeat('&#x2000;', $n);
            $line = "{$S}".substr($line, $n);
        }
    }
    return $line;
}
?>
