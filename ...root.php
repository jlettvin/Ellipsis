<?php

// Standard XenoFile RE patterns used during interpretation.
define(XFA, '{');               // Beginning of pattern.
define(XFC, '\s*([^`]*)\s*');   // Code is everything until next backtick.
define(XFD, '\.');              // Dot explicitly in pattern.
define(XFE, '\!');              // Exclamation explicitly in pattern.
define(XFL, '\s*([^\|]*)\s*');  // Label is everythin until next vert bar.
define(XFQ, '\?');              // Questionmark explicitly in pattern.
define(XFT, '`+');              // Note that adjacent backticks are folded.
define(XFV, '\|');              // Vertical bar explicitly in pattern.
define(XFW, '\s*(\w+)\s*');     // Word explicitly in pattern.
define(XFZ, '}');               // End of pattern.

define(XF_BEGIN         , XFA);
define(XF_CODE          , XFC);
define(XF_DOT           , XFD);
define(XF_EXCLAMATION   , XFE);
define(XF_LABEL         , XFL);
define(XF_QMARK         , XFQ);
define(XF_SWORDS        , '([\s\w]+)');
define(XF_TICK          , XFT);
define(XF_VERTICAL      , XFV);
define(XF_WORD          , XFW);
define(XF_END           , XFZ);

function TODO($msg, $still=true) {
    /// TODO function identifies points in code where work is to be done.
    $bt = debug_backtrace();
    $status = $still ? "TODO" : "DONE";
    $data   = $bt[0];
    $caller = isset($data['function']) ? $data['function'] : "?caller";
    $file   = isset($data['file']) ? basename($data['file']) : "?file";
    $line   = isset($data['line']) ? $data['line'] : "?line";
    echo "{$status}[{$file}/{$caller}/{$line}|{$msg}]<br />";
}

function INSTALL($package, $cmd=false) {
    /// INSTALL function is used to detect availability of external program.
    /// It is used in ...service.gnuplot.php and ...service.graphviz.php.
    if (!$cmd) $cmd = $package;
    if (!`which {$cmd}`) TODO("Install {$package}");
}

function ORDS($text) {
    /// ORDS converts a string to entity form to avoid further conversion.
    $text = str_replace("\t", "    ", $text);
    $N = strlen($text);
    $temp = '';
    for ($n = 0; $n < $N; $n++) $temp .= sprintf("&#x%02x;", ord($text[$n]));
    return $temp;
}

error_reporting(E_ALL | E_STRICT);
function root($argv=['www']) {
    static $MathJaxURL =
        "https://cdn.mathjax.org/mathjax/latest/MathJax.js";
    static $MathJaxQRY =
        "config=TeX-AMS-MML_HTMLorMML";

    $dirs = is_readable('...') ? array_map('trim', file('...')) : [];
    extract(['cmd'=>(isset($argv) and is_array($argv) and (count($argv)>0)),
             'top'=>(count(debug_backtrace()) == 0),
             'web'=>(php_sapi_name()=='cli-server'),                        ]);

    //echo PHP_EOL."<p>cmd={$cmd}</p>".PHP_EOL;
    //echo PHP_EOL."<p>top={$top}</p>".PHP_EOL;
    //echo PHP_EOL."<p>web={$web}</p>".PHP_EOL;

    //if      ($cmd) $bcode =  div($dirs, count($argv)>1?$argv[1]:'');
    //else if ($web) $bcode = body($dirs, $argv);

    $bcode = '';
    $bdata = '';

    //if      ($cmd and !$top) $bcode =  div($dirs, count($argv)>1?$argv[1]:'');

    //if      ($cmd and !$top) $bcode = body($dirs, $argv);
    //else if ($web  or  $cmd) $bcode = body($dirs, $argv);
    //else exit -1;
    $bcode = body($dirs, $argv);

    /// Use MathJax to interpret TeX into displayable equations.
    $hdata = <<<HDATA
<link rel="icon" type="image/png" href="...ellipsis.png" />
<script type="text/javascript" src="{$MathJaxURL}?{$MathJaxQRY}"></script> 
<style>
table {margin:6px}
</style>
HDATA;
    $hcode = "".PHP_EOL;
    //$bdata = body($branches, $argv).PHP_EOL;
    //$bcode = "".PHP_EOL;
    //if ($cmd) echo "<div>{$bcode}</div>";
    //else
    {
        $head = "<head>{$hdata}{$hcode}</head>".PHP_EOL;
        $body = "<body>{$bdata}{$bcode}</body>".PHP_EOL;
        echo "<html>{$head}{$body}</html>".PHP_EOL;
    }
}
?>
