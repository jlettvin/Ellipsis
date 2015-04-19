<?php
function tag($full, $content) {
    $tag = explode(' ', $full)[0];
    return "<{$full}>{$content}</{$tag}>";
}

function trtd($content) {
    return tag('tr', tag('td', $content));
}

function codepre($content) {
    return tag('code', tag('pre', $content));
}

function img($att, $b64) {
    return
        "<img {$att} ".
        "src=\"data:image/png;base64,{$b64}\" />";
}
?>
