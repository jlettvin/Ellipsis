<?php
/// `equation.$id|$label|$code`
///
/// https://www.tug.org/texlive/doc/texlive-en/texlive-en.pdf
///
/// $id: a keyword to use when referencing this equation;
/// $label: a title for this equation;
/// $code: TeX instructions to generate this equation.
///
/// This service uses TeX to generate an image of the equation.
/// The image is converted to base64 format and inserted directly
/// in the &lt;img&gt; tag instead of referenced through an URL.
//
// TODO Simplify this code.
function equation(
    $the = [
        'prefix' => '',
        'id'     => 'Euler',
        'code'   => 'e^{i\pi}+1 = 0',
        'label'  => 'Euler\'s identity'
    ]
) {
    static $eqno = 0;
    static $eqarray = [];

    //introspect($the);

    $def = [];
    if ($the == []) {
        return document_service(__FILE__, 'equation', 'defaults', $def);
    }

    $result = '';

    extract($the);
    if (isset($code)) {
        $where = '';
        $part = explode('where:', $code, 2);
        if (count($part) == 2) {
            $code = $part[0];
            $where = $part[1];
        }
        $eqno++;
        $refno = "{$prefix}{$eqno}";
        $eqarray[$id] = $refno;
        $result .= '<br clear="all"/>';
        $result .=
            '<br clear="all"/>'.
            '<table width="100%" '.
            'align="right" '.
            'style="border-spacing: 5px">'.PHP_EOL;
        $result .= '<tr><td align="center" width="70%">'.PHP_EOL;
        $result .= "\($code\)";
        if ($label != '') {
            $result .= '</td><td align="right"><i>'.$label.'</i>'.PHP_EOL;
        }
        $result .= '</td><td align="right">'."[{$prefix}{$eqno}]".PHP_EOL;
        $result .= '</td></tr></table>'.
            '<br clear="all"/>'.
            PHP_EOL;
        if ($where) {
            $result .= '<table align="left" hspace="10" vspace="10" border="1" rules="NONE">';
            $result .= '<tr><td colspan="2">where:</td></tr>';
            foreach(explode(PHP_EOL, $where) as $definition) {
                if (!$definition) continue;
                //return "TODO1[{$definition}]";

                list($name, $info) = array_map(
                    'trim',
                    explode('=', $definition, 2));
                if ($name and $info) {
                    $result .=
                        '<tr><td>\('.
                        $name.
                        '\)</td><td>= \('.
                        implode('\;', explode(' ', $info)).
                        '\)</td></tr>';
                }
            }
            $result .= '</table>';
        }
        //return 'YES';
    } else if(isset($id)) {
        $result .= $eqarray[$id]; //"Equation<sup>{$eqarray[$id]}</sup>";
    }
    return $result;
}
?>
