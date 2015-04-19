<?php
error_reporting(E_ALL | E_STRICT);

function radius($x,$y) { return sqrt($x*$x + $y*$y); }

function species() {
    list($r0, $x0, $y0) = array_fill(0, 3, 120);
    list(     $X , $Y ) = array_fill(0, 2, range(-$r0, +$r0));
    list($P, $M, $D, $rs, $Rmax) = [[], 255, count($X), 100, radius($x0, $y0)];
    $image = ['L' => ''      , 'M' => ''      , 'S' => ''      , 'LMS' => '' ];
    $count = ['L' => 650     , 'M' => 340     , 'S' => 10      , 'I'   => 0  ];
    $cones = ['L' => [$M,0,0], 'M' => [0,$M,0], 'S' => [0,0,$M]              ];
    foreach (array_keys($image) as $k)
        ${'im'.$k} = $image[$k] = @imagecreatetruecolor($D, $D)
        or die("{$k} mosaic fail");
    foreach ($image as $im)
        imagefill($im, 0, 0, imagecolorallocate($im, 240, 240, 240));
    foreach ($cones as $cone => $channel) {
        list($r, $g, $b)    = $channel;
        $$cone              = imagecolorallocate($imLMS, $r, $g, $b);
        ${$cone.'L'}        = imagecolorallocate($imL  , $r, $g, $b);
        ${$cone.'M'}        = imagecolorallocate($imM  , $r, $g, $b);
        ${$cone.'S'}        = imagecolorallocate($imS  , $r, $g, $b);
        if (($N=$count[$cone])) $P = array_merge($P, array_fill(0, $N, $cone));
    }
    foreach ($X as $x1) {
        $x = $x1+$x0;
        foreach ($Y as $y1) {
            $y   = $y1+$y0;
            $r   = radius($x1, $y1);
            $LMS = ($LM  = $count['L'] + $count['M']) + $count['S'];
            $c   = $P[rand(0, (($r < $rs) ? $LM : $LMS) - 1)];
            imagesetpixel($imLMS    , $x, $y, $$c); // Combined mosaic
            imagesetpixel($image[$c], $x, $y, $$c); // Species  mosaic
        }
    }
    foreach ($image as $key => $im) imagepng(    $im, "species{$key}.png");
    foreach ($image as         $im) imagedestroy($im                     );
}

species();
?>
