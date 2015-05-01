<?php
function background($filename = "background.png") {
    static $b64 = '';

    if (!$b64) {
        list($H, $W) = [1186, 905];
        $background =
            @imagecreatetruecolor($W, $H) or
            die('no background img created');
        $white = imagecolorallocate($background, 255, 255, 255);
        $gray  = imagecolorallocate($background, 127, 127, 127);
        imagefill($background, 0, 0, $gray);
        imagefilledrectangle($background, 5, 5, $W-5, $H-5, $white);
        imagepng($background, "background.png");
        imagedestroy($background);

        $contents = file_get_contents("background.png");
        if ($contents) {
            $b64 =
                ' background="data:image/png;base64,'.
                base64_encode($contents).
                '"';
        }
    }
    return $b64;
}

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
