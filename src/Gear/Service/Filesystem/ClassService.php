<?php
namespace Gear\Service\Filesystem;

use Gear\Service\AbstractService;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Reflection\ClassReflection;

class ClassService
{

    /**
     *
     * @param int $indent
     * @param string $text
     * @param array $params
     * @param boolean $newline
     * @throws \Exception Linha mal formada
     * @return string
     */
    public function powerLine($indent,$text,$params = array(),$newline = false)
    {
        if(is_array($params)) {
            $string = $this->getI($indent).trim(vsprintf($text,$params)).PHP_EOL;
        } elseif(is_string($params)) {
            $string = $this->getI($indent).trim(sprintf($text,$params)).PHP_EOL;
        } else {
            throw new \Exception('Linha mal formada '.$text);
        }
        if($newline) {
            $string .= PHP_EOL;
        }
        return $string;
    }

    public function getI($var = 1,$patterns = 4)
    {
        return $this->getIndent($var,$patterns);
    }


    public function getIndent($var = 1, $patterns = 4)
    {
        $patters_std = ' ';

        $indent = ($var * $patterns);

        $buffer = '';
        for($t = 0; $t < ($indent); $t ++)
        {
        $buffer .= $patters_std;
        }
        return $buffer;
    }
}
