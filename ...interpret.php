<?php
// Convert backtick content to ellipsis custom function output.

function interpret_line($line, $functions) {
    foreach ($functions as $function) {
        if (substr($function, 0, 15) == 'interpret_line_') {
            $line = call_user_func($function, $line);
        }
    }
    return $line;
}

function interpret_lines($text, $prefix) {
    $buf = '';
    $functions = get_defined_functions()['user'];

    foreach (array_map('trim', explode(PHP_EOL, $text)) as $line) {
        $buf .=
            ($line == '') ?
            '</p>'.PHP_EOL.'<p>' :
            interpret_line($line, $functions);
        $last = substr($buf, -1);
        //$buf .= str_repeat($last, 20);

        if (strpos('.!?', $last) !== FALSE) {
            $buf .= str_repeat('&#x2000;', 1);
        } else {
            $buf .= '&#x20;';
        }
    }
    return $buf;
}

function interpret($text, $prefix='') {
    $text = interpret_service($text, $prefix);
    $text = interpret_lines($text, $prefix);
    return $text;
}
?>
