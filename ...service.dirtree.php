<?php
/// `dirtree.{anything}
///
/// This service shows a directory tree for the current directory.
/// The remaining fields in {anything} are ignored.
function dirtree() {
    //$result = `tree -a -T . -J`;
    //$result = implode('<br/>', explode(', ', $result));
    $command = "find .";
    list($out, $err) = service($command);
    if ($err) TODO("Fix ".__FILE__." error: ".$err);

    return '<br /><code>'.str_replace(PHP_EOL, '<br />', $out).'</code><br/>';
}
?>
