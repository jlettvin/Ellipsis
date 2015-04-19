<?php
function interpret_line_equals($line) {
    static $align = [
        '<'=>' align="left"',
        '>'=>' align="right"',
        '|'=>' align="center"'
    ];
    if ($line[0] != '=') return $line;
    $c = strlen($line);
    for (
        $p=0, $n=$c-1;
        $line[$p] == '='; // and $line[$n] == '=';
        $p++, $n--);
    $t = $line[$p];
    if (array_key_exists($t, $align)) $a = $align[$t];
    else $a = $align['|'];
    $l = max(1, min(5, $p));
    $u = 5 - $l;
    $s = trim(substr($line, $p)); //, $n-$p+1));
    $b = str_repeat('<big>', $u);
    $c = str_repeat('</big>', $u);
    return "<div {$a}>".$b.$s.$c."</div>".PHP_EOL;
    return "<h{$l}{$a}>{$s}</h{$l}>".PHP_EOL;
}
?>
