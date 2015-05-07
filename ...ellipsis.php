<?php
//namespace ELLIPSIS;

static $verbose_level = 2;
static $contents = '...Contents';
$ellipsis = [
    'symbol' => [],
    'module' => [$contents=>['code'=>[], 'data'=>[]]],
    'doc'    => [],
    ];

$verbose = function($msg, $level=2) use($verbose_level) {
    if ($level >= $verbose_level) {
        $backtrace = debug_backtrace();
        $parent = $backtrace[1];
        $my = $backtrace[0];
        $function = "{$parent['function']}({$my['line']})";
        error_log($function.': '.$msg);
    }
};
$verbose(str_repeat('_', 80));

function loadEllipsis() {
    global $contents;
    global $ellipsis;
    global $verbose;

    $cwd = realpath(getcwd());

    $verbose("Load Ellipsis modules from {$cwd}.");
    $olddoc = '';
    foreach (glob(__DIR__.DIRECTORY_SEPARATOR."...*.php") as $filename) {
        $real = realpath($filename);
        $verbose("Load Ellipsis module {$real}.");
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
        $ellipsis['module'][$contents]['code'][] = basename($filename);
    }

    if (file_exists('...ellipsis.png')) {
        $dir = basename(__DIR__);
        $sep = DIRECTORY_SEPARATOR;
        $source = __DIR__.$sep.$contents;
        //TODO("Why not A ".$source."?");
        if (file_exists($source)) {
            $verbose("Load markdown ...Contents.");
            $ellipsis['module'][$contents]['data'][] = $source;
        }
        //TODO("Why not B ".$dir." with ".$source."?");
        foreach (
            array_map(
                'trim',
                explode(PHP_EOL, file_get_contents($source))) as $section)
        {
            if ($section == '') continue;
            // if (file_exists($section.$contents))
            // $ellipsis['module'][$contents]['data'][] = $section;
            if (is_dir($section)) {
                $verbose("Load directory {$section}.");
                $ellipsis['module'][$contents]['data'][] = $section.$sep;
                $markdown = "{$section}{$sep}{$section}...";
                if (is_readable($markdown)) {
                    $verbose("Load markdown {$section}... .");
                    $ellipsis['module'][$contents]['data'][] = $markdown;
                }
            }
        }
        foreach ([$contents, 'index.php', '...ellipsis.png', 'README.md'] as $x) {
            if (file_exists($x.$contents))
                $ellipsis['module'][$contents]['data'][] = $x;
        }
    }
    //echo '<pre>'.implode('|', $ellipsis['module'][$contents]).'</pre>';

    $verbose('Finished descending');

    specials();
}

loadEllipsis();
?>
