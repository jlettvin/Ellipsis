<?php
/// `graph,$id,$label,$code`
///
/// www.graphviz.org/Documentation/dotguide.pdf
///
/// $id: a keyword to use when referencing this plot;
/// $label: a title for this plot;
/// $code: graphviz instructions to generate this graph.
/// 
/// This service uses graphviz to generate a graph using the 'dot' language.
/// The graph title is at the bottom in bold.
/// The image is converted to base64 format and inserted directly
/// in the &lt;img&gt; tag instead of referenced through an URL.
function graph($the = []) {
    INSTALL('graphviz', 'dot');
    extract($the);
    $def = ['rankdir'=>'LR', 'ranksep'=>'0.3', 'size'=>'4.0,4.0'];
    if ($the == []) {
        return document_service(__FILE__, 'graph', 'defaults', $def);
    }
    $img = '';
    $err = '';
    if (isset($code)) {
        $att = '';
        $defstr = '';
        foreach ($def as $k => $v)
            $defstr .= " {$k}=\"{$v}\";";
        $recode = "digraph ellipsis { {$defstr} {$code} }";
        $command = "echo '{$recode}' | dot -Tpng";

        list($out, $err) = service($command);
        if ($err) TODO("Fix ".__FILE__." error: ".$err);

        $b64 = base64_encode($out);
        $img = img("alt=\"{$label}\" {$att}", $b64);
        //TODO("redirect stderr into tempnam file during backticks.");
    }
    return resource('graph', $the, $img);
}
?>
