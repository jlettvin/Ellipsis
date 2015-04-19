<?php

//require_once('utf8.inc');

$call = [
    PHP_EOL => function($sym) {
        extract($sym);
        while (($chr = $src[$off++]) != '') $tgt .= $chr;
        return compact(array_keys($sym));
    },
    '=' => function($sym) {
        return '';
    }
];

if (realpath($argv[0]) == realpath(__FILE__)) {
    $file = (count($argv) > 1) ? $argv[1] : 'markdown.wiki';
    $src = file_get_contents($file);
    //$src = unpack('H*', iconv("UTF-8", "UCS-4BE", file_get_contents($file)));
    list($tgt, $off, $fun)=['', 0, 'eol'];
    extract(call_user_func($call[PHP_EOL], compact('src', 'tgt', 'off')));
    echo $tgt.PHP_EOL;
}
?>
