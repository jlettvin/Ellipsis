<?php
/// `timestamp.$id|$label|$code`
///
/// $id: a keyword to use when referencing this equation;
/// $label: a title for this equation;
/// $code: TeX instructions to generate this equation.
///
/// This service inserts a timestamp in place of its call.
function timestamp($the=[]) {
    $tz = 'US/Eastern';
    extract($the);
    date_default_timezone_set($tz);
    //$return = (isset($label)) ? "{$label}: " : "";
    $return = '';
    if (isset($code)) {
        list($month, $day, $year) = explode(',', $code);
        $return .= date('M d Y', mktime(0, 0, 0, $month, $day, $year));
    } else {
        $return .= date('M d Y');
    }
    return $return;
}
?>
