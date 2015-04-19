<?php
function interpret_line_list($line) {
    static $rename = ['*'=>'ul', '#'=>'ol'];
    static $tags = [];
    static $chrs = '';

    $return = '';
    list($C, $D) = [strlen($chrs), strlen($line)];

    if (!array_key_exists($line[0], $rename)) {
        foreach ($tags as $type) $return .= "</{$type}>";
        $tags = [];
        return $line;
    } else {
        for ($n = 0; $n < $C and $n < $D; $n++) {
            list($c, $d) = [$chrs[$n], $line[$n]];
            list($cr, $dr) = [$rename[$c], $rename[$d]];
            if (isset($cr) and isset($dr)) {
            }
        }
        //foreach (
    }
    return $return;
    //$c = strlen($line);
    //for (
        //$p=0, $n=$c-1;
        //$line[$p] == '='; // and $line[$n] == '=';
        //$p++, $n--);
    //$l = max(1, min(5, $p));
    //$s = trim(substr($line, $p)); //, $n-$p+1));
    //return "</p><h{$l}>{$s}</h{$l}><p>".PHP_EOL;
}
?>
