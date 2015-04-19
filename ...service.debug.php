<?php
/// `symboltable.{anything}
///
/// This service shows the Ellipsis symboltable with the exception that
/// the 'body' symbol is not shown.
/// This is because the body symbol would repeat what is already seen.
/// The remaining fields in {anything} are ignored.
function symboltable($the=[]) {
    global $ellipsis;

    if ($the != [] and !is_array($the['symbols']))
        return "'{$the['symbols']}'";
    extract($the);
    if (!isset($symbols)) $symbols = $ellipsis;
    if (!isset($level)) $level = 0;
    $return = '';

    //if ($level == 0)
        $return .= '<table border="1"><tr><td><code><pre>';

    foreach ($symbols as $key => $val) {
        /// The 'body' symbol is not shown.
        if ($key == 'body') continue;
        $return .=
            '&NewLine;'.str_repeat('&nbsp;', $level)."'{$key}':".
            '&NewLine;'.symboltable(['symbols'=>$val, 'level'=>$level+1]);
        //if ($level == 0)
            $return .= "</td></tr><tr><td>";
    }

    //if ($level == 0)
    {
        $return .= '</pre></code></td></tr></table>';
        $return = str_replace("'", "&apos;", $return);
    }

    return $return.PHP_EOL;
}
?>
