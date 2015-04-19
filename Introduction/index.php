<?php
// Ellipsis boilerplate used as tail of any ellipsis participating script.
$SEP=DIRECTORY_SEPARATOR;
for(list($DIR,$PHP)=array(__DIR__, $SEP.'...ellipsis.php'); $DIR!=$SEP;) {
    list($INC,$DIR)=array("{$DIR}{$PHP}", dirname($DIR));
    if(is_readable($INC)) { require_once($INC); root($argv); exit(0); }}
echo "<html><body>No ellipsis.php</body></html>".PHP_EOL;
?>
