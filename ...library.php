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
    } else if(isset($id) and isset($type)) {
        if (isset($stored[$type][$id]))
            return $stored[$type][$id];
        else {
            //TODO('unassigned type or id');
            //return "AAAA {$type} {$id} BBBB";
            return '';
        }
    } else {
        // TODO('Bad type or id');
        // return "CCCC {$type} {$id}";
        return '';
    }
}

function horizontal_rule($color) {
    return
        '<hr style="'.
        'height:0;'.
        'border:0;'.
        'width:900;'.
        "border-top:1px solid {$color};".
        '" />';
}

function page_break($text) {
    return '<div style="page-break-after:always">'.$text.'</div>';
}
?>
