<?php
namespace Gear\Service\Filesystem;

class ClassService
{

    /**
     *
     * @param  int        $indent
     * @param  string     $text
     * @param  array      $params
     * @param  boolean    $newline
     * @throws \Exception Linha mal formada
     * @return string
     */
    public function powerLine($indent,$text,$params = array(),$newline = false)
    {
        if (is_array($params)) {
            $string = $this->getI($indent).trim(vsprintf($text,$params)).PHP_EOL;
        } elseif (is_string($params)) {
            $string = $this->getI($indent).trim(sprintf($text,$params)).PHP_EOL;
        } else {
            throw new \Exception('Linha mal formada '.$text);
        }
        if ($newline) {
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
        $pattersStd = ' ';

        $indent = ($var * $patterns);

        $buffer = '';
        for ($t = 0; $t < ($indent); $t ++) {
        $buffer .= $pattersStd;
        }

        return $buffer;
    }
}
