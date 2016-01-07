<?php
namespace Gear\Constructor\Helper;


class ArrayUtil {

    /**
     * @param string $file Classe PHP
     * @param string $functions Funções para adicionar
     * @param string $location Localização do Arquivo
     * @return number
     */
    public static function moveArray(&$array, $key, $novoValor)
    {
        $antes = array_slice($array, 0, $key);
    
        $novoArray = [***REMOVED***;
    
        foreach ($antes as $item) {
            $novoArray[***REMOVED*** = $item;
        }
    
        $novoArray[***REMOVED*** = $novoValor;
    
        $depois = array_slice($array, $key);
    
        foreach ($depois as $item) {
            $novoArray[***REMOVED*** = $item;
        }
    
        $array = $novoArray;
    
        return $array;
    }
}

