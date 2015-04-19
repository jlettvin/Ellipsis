<?php
/// `make.$id|$label|$code`
///
/// $id: a keyword to use when referencing this make;
/// $label: a title for this make;
/// $code: material to execute with this make.
/// 
/// This service blindly executes code in an external shell.
/// The idea is to produce artifacts needed for use in the paper.
function make($the, $att=[]) {
    extract($the);
    $out = '';
    if (isset($code)) {
        //if (is_file('species.php')) echo 'YES!';
        //else echo 'NO.';
        //TODO("make '{$code}'?");
        list($out, $err) = service($code);
        if ($err) TODO("Fix ".__FILE__." error: ".$err);
    }
    return $out;
}
?>
