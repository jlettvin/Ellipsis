<?php
/// `gnuplot.$id|$label|$code`
///
/// www.gnuplot.info/docs_4.4/gnuplot.pdf
///
/// $id: a keyword to use when referencing this plot;
/// $label: a title for this plot;
/// $code: gnuplot instructions to generate this plot.
/// 
/// The standard offered here is to generate a 512x512 PNG image
/// using thick lines for scientific paper photo-reproduction
/// and reduce its size to 256x256 to save space then
/// title the plot at the bottom in bold.
/// The image is converted to base64 format and inserted directly
/// in the &lt;img&gt; tag instead of referenced through an URL.
function gnuplot($the = []) {
    INSTALL('gnuplot');
    $def = [
        'samples'=> '10000',
        'term'   => 'png size 512,512 crop enhanced'
        ];
    if ($the == []) {
        return document_service(__FILE__, 'figure', 'defaults', $def);
    }
    extract($def);
    extract($the);
    $img = '';
    if (isset($code)) {
        $img = '';
        $att = attributes($code);
        $src  = "set samples {$samples};";
        $src .= "set term {$term};";
        $src .= " {$code}";
        $command = "echo '{$src}' | gnuplot";

        list($out, $err) = service($command);
        if ($err) TODO("Fix ".__FILE__." error: ".$err);

        $b64 = base64_encode($out);
        $img = img("alt=\"{$label}\" {$att}", $b64);
    }
    return resource('gnuplot', $the, $img);
}
?>
