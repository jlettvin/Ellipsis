<?php
/// `figure.$id|$label|$code`
///
/// $id: a keyword to use when referencing this figure;
/// $label: a title for this figure;
/// $code: TeX instructions to generate this figure.
///
/// The image is converted to base64 format and inserted directly
/// in the &lt;img&gt; tag instead of referenced through an URL.
function figure($the = []) {
    $def = [];
    if ($the == []) {
        return document_service(__FILE__, 'figure', 'defaults', $def);
    }
    extract($the);
    $img = '';
    if (isset($code)) {
        $att = attributes($code);
        $b64 = base64_encode(file_get_contents(trim($code)));
        $img = img("alt=\"{$label}\" {$att}", $b64);
        if ($label == '#')
            return $img;
    }
    return resource('figure', $the, $img);
}
?>
