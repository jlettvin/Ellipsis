<?php
//namespace ELLIPSIS;

$ellipsis = [
    'symbol' => [],
    'module' => ['...'=>['code'=>[], 'data'=>[]]],
    'doc'    => [],
    ];

// Bring in service modules.
$olddoc = '';
foreach (glob(__DIR__.DIRECTORY_SEPARATOR."...*.php") as $filename) {
    $real = realpath($filename);
    require_once($real);
    $service = $service_name = substr(basename($filename), 3, -4);
    //$service =
        //(substr($service_name, 0, 8) == 'service_') ?
        //substr($service_name, 8) :
        //$service_name;
    $name = substr($service, 8);
    $ellipsis['doc'][$service] =
        '<table border="1" bgcolor="#e0f0f0">'.
        '<tr><td align="center">'.
        '<b><u>'.
        $name.
        '</u> service documentation ...</b>'.
        '</td></tr>'.
        '<tr><td>'.
        implode(
            '<br/>',
            array_map(
                function($i) { return trim(substr($i,3)); },
                array_filter(
                    explode(PHP_EOL, file_get_contents($real)),
                    function($i) { return (substr($i,0,3) == '///'); }
    ))).
        '</td></tr>'.
        "<tr><td colspan=\"2\"><small>{$real}</small></td></tr>".
        '</table>'.
        PHP_EOL;
    $about = ['service'=>$service, 'name'=>$filename, 'path'=>$real];
    if (isset($newdoc) && $doc != $olddoc) {
        $about['doc'] = $doc;
        $olddoc = $doc;
    }
    $ellipsis['module'][$service] = $about;
    $ellipsis['module']['...']['code'][] = basename($filename);
}

if (file_exists('ellipsis.png')) {
    $dir = basename(__DIR__);
    $sep = DIRECTORY_SEPARATOR;
    if (file_exists($dir.'...'))
        $ellipsis['module']['...']['data'][] = $dir.'...';
    foreach (
        array_map('trim', explode(PHP_EOL, file_get_contents('...'))) as $x)
    {
        if ($x == '') continue;
        // if (file_exists($x.'...'))
            // $ellipsis['module']['...']['data'][] = $x;
        if (is_dir($x)) {
            $ellipsis['module']['...']['data'][] = $x.$sep;
            $markdown = "{$x}{$sep}{$x}...";
            //$cwd = getcwd();
            //chdir($x);
            if (is_readable($markdown))
                $ellipsis['module']['...']['data'][] = $markdown;
            //chdir($cwd);
        }
    }
    foreach (['...', 'index.php', 'ellipsis.png', 'README.md'] as $x) {
        if (file_exists($x.'...'))
            $ellipsis['module']['...']['data'][] = $x;
    }
}
//echo '<pre>'.implode('|', $ellipsis['module']['...']).'</pre>';

specials();
?>
