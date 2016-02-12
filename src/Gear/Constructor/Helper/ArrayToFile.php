<?php
namespace Gear\Constructor\Helper;

class ArrayToFile
{
    /**
     * @param string $file Classe PHP
     * @param string $functions Funções para adicionar
     * @param string $location Localização do Arquivo
     * @return number
     */
    public static function addFunctionsToClass($file, $functions)
    {
        //verifica quantas linhas há no arquivo e cria um array
        $lines = explode(PHP_EOL, $file);

        //Adiciona as novas linhas no meio do array, pega o numero de linhas -2.
        $lines[count($lines)-2***REMOVED*** = $functions;

        //Cria um novo arquivo de texto.
        $newFile = implode(PHP_EOL, $lines);

        return $newFile;
    }
}
