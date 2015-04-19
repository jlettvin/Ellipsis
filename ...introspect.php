<?php
function gossip() {
    $params = func_get_args();
    $buf = '';
    $buf .= '<p><pre>';
    $buf .= str_repeat('+', 80).PHP_EOL;
    foreach ($params as $param) {
        print_r($param);
        $buf .= PHP_EOL;
    }
    $backtrace = debug_backtrace();

    $buf .= str_repeat('1', 80).PHP_EOL;
    $parent = $backtrace[1];
    $function = "{$parent['function']}({$parent[line]})";
    $buf .= $function.PHP_EOL;
    print_r($parent[args]).PHP_EOL;

    $buf .= str_repeat('2', 80).PHP_EOL;
    if (count($backtrace) > 2) {
        $grand = $backtrace[2];
        $function = "{$grand['function']}({$grand[line]})";
        $buf .= $function.PHP_EOL;
        print_r($grand[args]).PHP_EOL;
    } else {
        $buf .= "No grandparent".PHP_EOL;
    }

    $buf .= str_repeat('-', 80).PHP_EOL;
    $buf .= '</pre></p>'.PHP_EOL;
    if (in_array('exit', $params)) exit(0);
    return $buf;
}
?>
