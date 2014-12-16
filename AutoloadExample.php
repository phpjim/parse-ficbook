<?php

namespace phpjim\parsers\ficbook;

/**
 * This is just an example.
 */
class AutoloadExample extends \yii\base\Widget
{
    public function run()
    {
        $file = file_get_contents('/var/www/lib.phpjim.ru/vendor/phpjim/parse-ficbook/test.html');
        $work = new Work('/var/www/lib.phpjim.ru/vendor/phpjim/parse-ficbook/test.html');
        //$work = new Work('http://ficbook.net/readfic/1003915');
        $work->getData();
        //$dom = new \DOMDocument();
       // $dom->loadHTML($file);
        //$divs = array();
        //foreach($dom->getElementsByTagName('div') as $div){
            /**
             * @var $div \DOMElement
             */
            //$class = explode(" ", $div->getAttribute('class'));

       // }
        return "Hello!";
    }
}

//Loop through each <a> tag in the dom and add it to the link array
//foreach($xml->getElementsByTagName('div') as $link) {
//    $class =  explode(' ', $link->getAttribute('class'));
//    if(!in_array('part_text', $class)){
//        continue;
//    }
//    echo 1;
//    var_dump(trim(get_inner_html($link)));
//
////var_dump($link->saveHTML());
//    echo 1;
//    foreach($link->childNodes as $item){
//        //var_dump($item);
//    }
//    exit();
//    $divs[] = array('class' => explode(' ', $link->getAttribute('class')));
//}

function get_inner_html( $node ) {
    $innerHTML= '';
    $children = $node->childNodes;
    foreach ($children as $child) {
        $innerHTML .= $child->ownerDocument->saveXML( $child );
    }

    return $innerHTML;
}
