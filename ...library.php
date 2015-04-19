<?php
function resource($type, &$the = [], $content) {
    static $number = [];
    static $stored = [];
    static $default = [
        'cellspacing' => '15',
        'border' => '0',
        'rules' => 'NONE',
        'align' => 'left',
    ];

    extract($the);

    if (isset($code)) {

        if (!isset($number[$type])) $number[$type] = 0;
        if (!isset($stored[$type])) $stored[$type] = [];
        $index = ++$number[$type];
        $stored[$type][$id] = $refno = "{$prefix}{$index}";
        $attributes = '';
        foreach ($default as $k => $v)
            $attributes .= " {$k}=\"{$v}\"";

        return
            tag("table{$attributes}",
                tag('caption align="bottom"',"{$type} {$refno}: {$label}").
                trtd($content));
    } else if(isset($id)) {
        return $stored[$type][$id];
    }
}
?>
