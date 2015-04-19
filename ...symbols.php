<?php
function specials() {
    global $ellipsis;
    $ellipsis['symbol']['TEX'] =
       'T<span style="text-transform: uppercase; vertical-align: -0.5ex; margin-left: -0.1667em; margin-right; -0.125em;">e</span>X';
    $ellipsis['symbol']['TeX'] =
       'T<span style="text-transform: uppercase; vertical-align: -0.5ex; margin-left: -0.1667em; margin-right; -0.125em;">e</span>X';
    $ellipsis['symbol']['   '] = str_repeat('&#x2000;', 3);
    $ellipsis['symbol']['  '] = str_repeat('&#x2000;', 2);
}
?>
