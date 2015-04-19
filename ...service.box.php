<?php
/// `box.$id|$label|$code`
///
/// $id: a keyword to use when referencing this box;
/// $label: a title for this box;
/// $code: material to wrap with this box.
/// 
/// This service puts $code in a single cell in a single table with a border.
/// It changes the font to the &lt;code&gt; fixed width style and
/// maintains the same line breaks as found in the $code section.
function box($the, $att=[]) {
    static $N = 0;
    static $default = [
        'cellspacing' => '5',
        'border' => '1',
        'rules' => 'NONE',
        'align' => 'left',
        'hspace' => '10',
        'vspace' => '10',
    ];

    extract($the);
    $caption = '';
    $prefix = isset($meta) ? $meta : "box {$N}";
    if (isset($label) and $label != '') {
        $caption =
            tag('tr', tag('td valign="top" align="center"',
            tag('b',tag('u', "{$prefix}:")).' '.$label));
    }
    if (isset($code)) {
        //$attributes = array_slice($default, 0, count($default));
        //$attributes = array_merge($attributes, $att);
        //$attributes = array_merge($attributes, attributes($code));
        $attributes = '';
        foreach ($default as $k => $v)
            $attributes .= " {$k}=\"{$v}\"";
        $att = attributes($code);
        if (!isset($meta)) $N++;
        return tag(
            'table '.
            'cellspacing="5" '.
            'rules="NONE" '.
            'hspace="10" '.
            'vspace="10" '.
            'border="1" '.
            "{$att} ",
            //'align="left" ',
            $caption.
            tag('tr', tag('td valign="top" align="center"',
                str_replace(PHP_EOL, "<br />",
                    tag('code', $code))
            )));
    }
    return '';
}
?>
