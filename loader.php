<?php
// Специальные функции:
function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

//$string = 'April 15, 2003';
//$pattern = '/[^A-Za-z0-9]/u';//'/(\w+) (\d+), (\d+)/i';
//$replacement = '${1}1,$3';
//echo preg_replace($pattern, $replacement, $string);
				$file = 'export.xml';
                $xmlDoc = file_get_contents( $file );
                $tplFile = file_get_contents( 'template/template.text' );
                $xmlObject = new SimpleXMLElement( $xmlDoc );

				$count=0;
                foreach ( $xmlObject -> offer as $offer ) {
                    $attr = $offer -> attributes();
                    // var_dump($offer -> {'building-name' });
                    $id = $attr[ 'internal-id' ];
                    // echo $id, '<br />';
                    $header = count( $offer -> {'room-space'} ) . ' ккв. '
                            . $offer -> {'area'} -> value . ' м<sup>2</sup> в ' . $offer -> {'building-name'};
					                            
                    // Img:
                    $filepostfix = uniqid(rand(10000, 99999));
                    $imgname = preg_replace( '/[^A-Za-z0-9]/u', '_', rus2translit( $offer -> {'building-name' } ) );
                    $imgname = $imgname . $filepostfix ;

                    if ( !is_file( 'images/'. $imgname . '.jpg' ) ) {
                        file_put_contents( 'images/' . $imgname . '.jpg', file_get_contents($offer -> image) );
                        echo $offer -> image .'<br />';
                    }
                   	// echo $count=$count+1, '<br />';
                   	$count=$count+1;
                }

?>