<?php
/// `def.$id|$label|$code`
///
/// $id: a keyword to use when referencing this definition;
/// $label: an unused title for this definition;
/// $code: replacement text for this definition.
/// 
/// This service puts $code in a single cell in a single table with a border.
/// It changes the font to the &lt;code&gt; fixed width style and
/// maintains the same line breaks as found in the $code section.
function def($the=[]) {
    global $ellipsis;
    extract($the);
    if (isset($code)) {
        $ellipsis['symbol'][$id] = $code;
        return '';
    } else {
        return $ellipsis['symbol'][$id];
    }
}
?>
