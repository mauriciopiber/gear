<?php
namespace Gear\Util\Vector;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class ArrayService implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * Move um array utilizando 2 array_slice
     *
     * @param array $array
     * @param integer $key
     * @param array $novoValor
     * @return $array[***REMOVED*** Novo Array
     */
    public function moveArray(&$array, $key, $novoValor)
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

    public function arrayToFile($file, $array)
    {
        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($array, true));
        $dataArray = str_replace('\\\\', '\\', $dataArray);
        $dataArray = implode("\n", array_map('rtrim', explode("\n", $dataArray)));
        $allData = '<?php return ' . $dataArray . ';'.PHP_EOL;
        file_put_contents($file, $allData);
        return true;
    }

}
