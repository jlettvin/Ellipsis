<?php
/// Convert backtick content to ellipsis custom function output.

function hexstr($str) {
    $N = strlen($str);
    $R = '';
    for ($n = 0; $n < $N; $n++) {
        $c = $str[$n];
        $R .= sprintf("&#x%02x", ord($c));
    }
    return $R;
}

function interpret_service($text, $prefix='')
{
    global $ellipsis;
    static $processed = 0;
    static $named = [];
    static $word = '\s*(\w+)\s*';
    static $label = '\s*([^\|]*)\s*';
    static $code = '\s*([^`]*)\s*';
    static $bt = '`+';
    static $dot = '\.';
    static $bar = '\|';
    static $qmark = '\?';
    static $ob = '{';
    static $cb = '}';


    ///////////////////////////////////////////////////////////////////////////
    $xf_define =
        XF_BEGIN.
        XF_TICK.
        XF_WORD.
        XF_DOT.
        XF_WORD.
        XF_VERTICAL.
        XF_LABEL.
        XF_VERTICAL.
        XF_CODE.
        XF_TICK.
        XF_END;
    $define = function($part) use($processed, &$named, $prefix) {
        $fun = "define";
        list($service, $id, $label, $code) = array_slice($part, 1, 4);
        if (function_exists($service)) {
            $processed++;
            $att = '';
            $text = call_user_func($service,
                compact('id', 'code', 'label', 'prefix', 'att'));
            if (!isset($named[$service])) $named[$service] = [];
            $temp = $named[$service][$id] =
                call_user_func($service, compact('id', 'prefix'));
            //TODO("{$fun} '{$service}':'{$id}' = {$temp}");
        } else {
            $text = "(unimplemented: {$service},{$id},{$label},{$code})";
        }
        return $text;
    };

    ///////////////////////////////////////////////////////////////////////////
    $xf_refer =
        XF_BEGIN.
        XF_TICK.
        XF_WORD.
        XF_DOT.
        XF_WORD.
        XF_TICK.
        XF_END;
    $refer = function($part) use($processed, &$named, $prefix) {
        $fun = "refer";
        $result = '';
        list($service, $id) = array_slice($part, 1, 2);
        if (function_exists($service)) {
            if ($service == 'reference') {
                $result =
                    call_user_func($service, compact('id', 'prefix'));
            } else {
                if (isset($named[$service])) {
                    if (isset($named[$service][$id])) {
                        //$result = $named[$service][$id];
                        $result .=
                            "{$service}<sup>".
                            call_user_func($service, compact('id', 'prefix')).
                            "</sup>";
                    } else {
                        TODO($fun.": No service index'{$service}'");
                    }
                } else {
                    TODO($fun.": No service '{$service}'");
                }
            }
        } else {
            TODO($fun.": No module '{$service}'");
        }
        return $result;
    };

    ///////////////////////////////////////////////////////////////////////////
    $xf_remind =
        XF_BEGIN.
        XF_TICK.
        XF_WORD.
        XF_QMARK.
        XF_CODE.
        XF_TICK.
        XF_END;
    $remind = function($part) use($processed, &$named, $prefix) {
        $fun = "remind";
        list($service, $notes) = array_slice($part, 1, 2);
        //if (function_exists($service))
        {
            $result =
                '<table border="1" bgcolor="#f0e0e0"><tr><td align="center">'.
                '<b><u>'.
                $service.
                '</u> reminder ...</b><hr/>'.
                $notes.
                '</td></tr></table>'.PHP_EOL;
        //} else {
            //$result = "(nonexistent: {$service}";
        }
        return $result;
    };

    ///////////////////////////////////////////////////////////////////////////
    $xf_symbol =
        XF_BEGIN.
        XF_TICK.
        XF_SWORDS.
        XF_TICK.
        XF_END;
    $symbol = function($part) use($ellipsis, $processed) {
        $fun = "special";
        $processed++;
        if (function_exists($part[1])) {
            return call_user_func($part[1], []);
        } else {
            return $ellipsis['symbol'][$part[1]];
        }
    };

    ///////////////////////////////////////////////////////////////////////////
    $xf_info =
        XF_BEGIN.
        XF_TICK.
        XF_WORD.
        XF_QMARK.
        XF_TICK.
        XF_END;
    $info = function($part) use($processed, &$named, $ellipsis, $prefix) {
        $fun = "info";
        $service = $part[1];
        $wrap = 8;
        if ($service == '') {
            $modules = $ellipsis['module'];
            ksort($modules);
            $result  = '<table bgcolor="#e0f0e0"><tr><td>';
            $result .=
                '<table border="1" cellpadding="4">'.
                '<tr><td colspan="'.$wrap.'" align="center"><b>'.
                'service modules ...'.
                '</b></td></tr><tr>';
            $keys = array_keys($modules);
            $i = 0;
            foreach ($modules as $name=>$data) {
                if ($name == "...") continue;
                $current = $data['service'];
                $common = substr($current, 0, 8);
                $remain = substr($current, 8);
                if (substr($common, 0, 8) != 'service.')
                    continue;
                $result .= "<td>{$remain}</td>";
                $i++;
                if ($i >= $wrap) {
                    $i = 0;
                    $result .= "</tr><tr>";
                }
            }
            $result .= "</tr>";
            $result .=
                '</td></tr></table>'.
                '</td></tr></table>'.
                PHP_EOL;
        } else if (function_exists($service)) {
            $result =
                $ellipsis['doc']['service.'.$service];
        } else {
            $result = "(nonexistent: {$service}";
        }
        return $result;
    };

    ///////////////////////////////////////////////////////////////////////////

    $replace = function($parts, $func, &$text) use ($processed) {
        $fun = "replace";
        foreach ($parts as $part)
            $text = str_replace($part[0], call_user_func($func, $part), $text);
        return ($processed != 0);
    };

    ///////////////////////////////////////////////////////////////////////////
    $order = [
        [$xf_define, $define, 'expand first for forward referencing'   ],
        [$xf_refer , $refer , 'expand 2nd to express referencing'      ],
        [$xf_info  , $info  , 'inline help for services'               ],
        [$xf_remind, $remind, 'document places for further development'],
        [$xf_symbol, $symbol, 'document services or expand symbols'    ],
        ];

    foreach ($order as $item) {
        list($pattern, $function, $why) = $item;
        while (preg_match_all($pattern, $text, $match, PREG_SET_ORDER))
            if (!$replace($match, $function, $text)) break;
    }

    return $text;
}
?>
