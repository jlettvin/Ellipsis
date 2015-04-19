<?php
/// index.php (HTML entrypoint for Ellipsis).
///__________________________________________
/// index.php is generated automatically by /Users/jlettvin/Desktop/Ellipsis/...ellipsis.php
/// when it is missing from a directory served by Ellipsis
/// and the directory is named on a line in "..."
/// and recursively into contiguous directories served by Ellipsis.
/// Ellipsis boilerplate used as tail of ellipsis participating script.
list($SEP, $ELL)=[DIRECTORY_SEPARATOR,"...ellipsis.php"];
for(list($DIR,$PHP)=array(__DIR__, $SEP.$ELL); $DIR!=$SEP;) {
    list($INC,$DIR)=array("{$DIR}{$PHP}", dirname($DIR));
    if(is_readable($INC)) { require_once($INC); root($argv); exit(0); }}
echo "<html><body>{$ELL} missing.</body></html>".PHP_EOL;
?>