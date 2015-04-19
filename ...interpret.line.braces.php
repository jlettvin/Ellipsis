<?php
function interpret_line_braces($line) {
    static $pattern = '@{{(\w+)\(\w+,\w+\)(^})+}}@';
    //$pattern = "/({{([\w]+)\((.+)\)([^}]*))(.*?)(}})/";
    preg_match_all($pattern, $line, $parts, PREG_SET_ORDER);
    foreach ($parts as $part) {
        print_r($part);
        continue;
        list($old, $key, $id, $val) =
            array_map('trim', [$part[0], $part[2], $part[3], $part[4]]);
        $result = call_user_func([$this, $key], $id, $val);
        $line = str_replace($old, $result, $line);
    }
    return $line;
}
?>
