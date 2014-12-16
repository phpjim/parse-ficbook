<?php
/**
 * Created by PhpStorm.
 * User: Vadims
 * Date: 14.12.2014
 * Time: 14:51
 */

namespace phpjim\parsers\ficbook;


class Work {
    protected $_mainPageContent = false;

    protected $_attributesData = array();

    protected $_hatAttributeDefinitions = array(

    );

    protected $_hatText;
    protected $_hatResidue;

    public function __construct($data){
        $this->_mainPageContent = $data;
        $this->
    }

    public function getData(){
        $data = new \DOMDocument();
        @$data->loadHTMLFile($this->_mainPageContent);
        $this->_mainPageContent = $data;
            //var_dump($this->_mainPageContent);
        //$this->getTitle($this->getMainCell($this->_mainPageContent));
        $this->getHat($this->getMainCell($this->_mainPageContent));
        var_dump($this->getAuthor());
    }

    /**
     * @param \DOMDocument $document
     * @param string $tag
     * @return \DOMElement|null
     */
    protected function getMainCell(\DOMDocument $document, $tag = 'td')
    {
        foreach ($document->getElementsByTagName($tag) as $item) {
            /**
             * @var $item \DOMElement
             */
            $class = explode(" ", $item->getAttribute('class'));
            if (in_array('main_cell', $class)) {
                return $item;
            }
            continue;
        }
        return null;
    }

    protected function getHat(\DOMElement $element){

        $element = $element->getElementsByTagName('table')->item(0);
        $hat = '';
        foreach ($element->getElementsByTagName('td') as $item){
            $children = $item->childNodes;
            foreach ($children as $child) {
                if (in_array($child->nodeType, array(XML_ELEMENT_NODE,XML_TEXT_NODE))) {
                    $hat .= $child->ownerDocument->saveXML($child);
                }
            }
        }
        $this->_hatText = $this->_hatResidue = str_replace("\n", "&#013;", $hat);
    }

    protected function getTitle(\DOMElement $element){
        return $element->getElementsByTagName('h1')->item(0);
    }

    public function getAuthor(){
        preg_match_all("`<b>Автор:</b>(.*?)<br/>`", $this->_hatText, $matches);
        if (!is_null($matches[0][0])){
            $this->_hatResidue = str_replace($matches[0][0], '', $this->_hatResidue);
            return $matches[1][0];
        }
        return null;
    }

    public function geta(){
        //        preg_match_all("`<b>Беты \(редакторы\):</b>(.*?)<br/>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Фэндом:</b>(.*?)<br/>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Пэйринг или персонажи:</b>(.*?)<br/>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Рейтинг:</b>(.*?)<br/>`", $hat, $vote);
//        var_dump($vote[1][0]);
        preg_match_all("`<b>Жанры:</b>(.*?)<br/>`", $hat, $vote);
        $data = $vote[0][0];
        $data = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'.$data;

        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->substituteEntities = TRUE;
        $dom->loadHTML($data);
        foreach($dom->getElementsByTagName('a') as $link){
            var_dump(trim($link->nodeValue));
        }
//        preg_match_all("`<b>Размер:</b>(.*?)<br/>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Кол-во частей:</b>(.*?)<br/>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Статус:(.*?)</b>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Понравилось читателям:</b>(.*?)<br/>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Описание:</b><br/><span class=\"urlize\">(.*?)</span>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Посвящение:</b><br/><span class=\"urlize\">(.*?)</span>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Публикация на других ресурсах:</b><br/><span class=\"urlize\">(.*?)</span>`", $hat, $vote);
//        var_dump($vote[1][0]);
//        preg_match_all("`<b>Работа написана по заявке:</b><br/><a(.*?)</a>`", $hat, $vote);
//        var_dump($vote[1][0]);

        //var_dump($hat);
    }
} 