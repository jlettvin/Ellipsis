<?php
/// service function to capture stderr while executing services.
///
/// $command will be stripped of final semicolon if any.
function service($command) {
    $tf = tempnam("/tmp", "XOF");
    $command = trim($command);
    if (substr($command, -1) == ';') $command = substr($command, 0, -1);
    $command .= " 2>{$tf}";
    $out = `$command`;
    $err = file_get_contents($tf);
    unlink($tf);
    return [$out, $err];
}
?>
