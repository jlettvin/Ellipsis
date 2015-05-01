<?php
/// `listing.$id|$label|$code`
///
/// $id: a keyword to use when referencing this listing;
/// $label: a title for this listing;
/// $code: TeX instructions to generate this listing.
///
/// This service formats text for viewing as code.
function listing($the =
    ['id'=>'none', 'label'=>'No content', 'code'=>'index.php']
) {
    static $preno = 0;
    static $prearray = array();

    $result = '';

    if (is_array($the)) {
        extract($the);
        if (!isset($code)) return "TODO[nocode.{$id}]";
        $explicit = attributes($code);
        $att = [
            'cellspacing' => '5',
            'border' => '1',
            'rules' => 'NONE',
            'align' => 'left',
            'hspace' => '10',
            'vspace' => '10',
        ];
        if ($explicit) {
            $changes = explode(' ', $explicit);
            foreach ($changes as $change) {
                if (!$change) continue;
                $pair = explode('=', $change);
                if (count($pair) == 2) {
                    list($key, $val) = $pair;
                    $att[$key] = substr($val, 1, -1);
                } else {
                    TODO("Fix unpaired k=v in '{$change}'");
                }
            }
        }
        $preno++;
        $prearray[$id] = $preno;
        if (is_readable($code)) $code = file_get_contents($code);
        $atts = '';
        foreach ($att as $k => $v) $atts .= " {$k}=\"{$v}\"";
        $result =
            tag("table {$atts}",
                trtd(codepre(ORDS($code))).
                trtd("<b>Listing {$preno}: {$label}</b>")
            ).PHP_EOL;
    } else {
        $result .= X_labels($prearray, func_get_args(), 'Listing');
    }
    return $result;
}
?>
