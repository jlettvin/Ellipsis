<?php

function test_numbering() {
    static $numbering_styles = [
        '_'=>'US',
        'A'=>'Arabic' ,
        'C'=>'Chinese',
        'e'=>'english', 'E'=>'English',
        'g'=>'greek'  , 'G'=>'Greek'  ,
        'H'=>'Hindi',
        'r'=>'roman'  , 'R'=>'Roman'  ,
        'T'=>'Tibetan',
    ];
    static $alternatives = [
        'ANSI'                          => 0x30,
        'Arabic-Indic'                  => 0x660,
        'Extended Arabic-Indic'         => 0x6f0,
        #'NKO'=>0x7c0,
        'Devanagari'                    => 0x966,
        'Bengali'                       => 0x9e6,
        'Gurmukhi'                      => 0xa66,
        'Gujarati'                      => 0xae6,
        'Oriya'                         => 0xb66,
        'Tamil'                         => 0xbe6,
        'Telugu'                        => 0xc66,
        'Kannada'                       => 0xce6,
        'Malayalam'                     => 0xd66,
        #'Sinhala'=>0xde6,
        'Thai'                          => 0xe50,
        'Lao'                           => 0xed0,
        'Tibetan'                       => 0xf20,
        'Myanmar'                       => 0x1040,
        #'Myanmar Shan'=>0x1090,
        'Khmer'                         => 0x17e0,
        'Mongolian'                     => 0x1810,
        #'Limub'=>0x1946,
        #'New Tai Lue'=>0x19d0,
        #'Tai Tham Hora'=>0x1a80,
        #'Tai Tham Tham'=>0x1a90,
        #'Balinese'=>0x1b50,
        #'Sundanese'=>0x1bb0,
        #'Lepcha'=>0x1c40,
        #'Ol Chiki'=>0x1c50,
        #'Vai'=>0xa620,
        #'Saurashtra'=>0xa8d0,
        #'Kayah Li'=>0xa900,
        #'Javanese'=>0xa9d0,
        #'Myanmar Tai Laing'=>0xa9f0,
        #'Cham'=>0xaa50,
        #'Meetei Mayek'=>0xabf0,
        'Fullwidth'                     => 0xff10,
        #'Osmanya'=>0x104a0,
        #'Brahmi'=>0x11066,
        #'Sora Sompeng'=>0x110f0,
        #'Chakma'=>0x11136,
        #'Sharada'=>0x111d0,
        #'Khudawadi'=>0x112f0,
        #'Tirhuta'=>0x114d0,
        #'Modi'=>0x11650,
        #'Takri'=>0x116c0,
        #'Warang Citi'=>0x118e0,
        #'Mro'=>0x16a60,
        #'Pahawh Hmong'=>0x16b50,
        'Mathematical Bold'             => 0x1d7ce,
        'Mathematical Double-Struck'    => 0x1d7d8,
        'Mathematical Sans-Serif'       => 0x1d7e2,
        'Mathematical Sans-Serif Bold'  => 0x1d7ec,
        'Mathematical Monospace'        => 0x1d7f6,
        ];
    $result = 'test_numbering:<br/>'.PHP_EOL;
    $row = '';
    foreach ($numbering_styles as $key => $name) {
        $col = tag('td', $name.':&nbsp;&nbsp;', ['align'=>'right']);
        foreach (range(0,10) as $digit) {
            $col .= tag('td', render_number($digit, $key),
            ['width'=>40, 'align'=>'center']);
        }
        $row .= tag('tr', $col);
    }
    foreach ($alternatives as $name => $zero) {
        $col = tag('td', $name.':&nbsp;&nbsp;', ['align'=>'right']);
        foreach (range(0,10) as $digit) {
            $col .= tag('td', NumberAs($name, $digit),
            ['width'=>40, 'align'=>'center']);
        }
        $row .= tag('tr', $col);
    }
    $result = tag(
        'table',
        $row,
        ['align'=>'center']
    );
    return $result;
}

$specialization = function($argv) {
    echo heading($argv[2], $argv[1], substr($argv[0], 0, -4));
    echo <<<TEXT
One of the core features of a scientific paper is numbering.
Objects are numbered using a variety of systems.
English-adapted Arabic numerals,
English letters and
Roman numerals are in common use.
Other numbering systems are useful too.
Ellipsis offers a wide variety of numbering systems.
TEXT;
    echo test_numbering();
};
// Ellipsis boilerplate used as tail of any ellipsis participating script.
$SEP=DIRECTORY_SEPARATOR;
for(list($DIR,$PHP)=array(__DIR__, $SEP.'ellipsis.php'); $DIR!=$SEP;) {
    list($INC,$DIR)=array("{$DIR}{$PHP}", dirname($DIR));
    if(is_readable($INC)) {
        require_once($INC); $specialization($argv); break;
    }
}
?>
