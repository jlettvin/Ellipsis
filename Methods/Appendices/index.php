<?php
// Ellipsis boilerplate used as tail of any ellipsis participating script.
list($SEP, $ELL)=[DIRECTORY_SEPARATOR,'...ellipsis.php'];
for(list($DIR,$PHP)=array(__DIR__, $SEP.$ELL); $DIR!=$SEP;) {
    list($INC,$DIR)=array("{$DIR}{$PHP}", dirname($DIR));
    if(is_readable($INC)) { require_once($INC); root($argv); exit(0); }}
echo "<html><body>{$ELL} missing.</body></html>".PHP_EOL;
?>