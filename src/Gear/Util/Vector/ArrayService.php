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
    public function moveArray(array &$array, $key, array $novoValor)
    {
        $antes = array_slice($array, 0, $key);

        foreach ($novoValor as $item) {
            array_push($antes, $item);
        }

        $depois = array_slice($array, $key);

        foreach ($depois as $item) {
            array_push($antes, $item);
        }

        return $antes;
    }

    public function replaceLine(&$array, $key, $novoValor)
    {
        $antes = array_slice($array, 0, $key);

        foreach ($novoValor as $item) {
            array_push($antes, $item);
        }

        $depois = array_slice($array, $key+1);

        foreach ($depois as $item) {
            array_push($antes, $item);
        }

        return $antes;

        $array[$key***REMOVED*** = $novoValor;
        return $array;
    }

    public function replaceRange($file, $offset, $max, $insert)
    {
        foreach ($insert as $newLine) {
            $max -= 1;

            if ($max >= 0) {
                $file = $this->replaceLine($file, $offset, [$newLine***REMOVED***);
                $offset += 1;
                continue;
            }

            $file = $this->moveArray($file, $offset, [$newLine***REMOVED***);
            $offset += 1;
            continue;
        }

        return $file;
    }

    public function varExport54($var, $indent="") {
        switch (gettype($var)) {
            case "string":
                return '\'' . addcslashes($var, "\\\$\"\r\n\t\v\f") . '\'';
            case "array":
                $indexed = array_keys($var) === range(0, count($var) - 1);
                $r = [***REMOVED***;
                foreach ($var as $key => $value) {
                    $r[***REMOVED*** = "$indent    "
                    . ($indexed ? "" : $this->varExport54($key) . " => ")
                    . $this->varExport54($value, "$indent    ");
                }
                return "[\n" . implode(",\n", $r) . "\n" . $indent . "***REMOVED***";
            case "boolean":
                return $var ? "true" : "false";
            default:
                return var_export($var, TRUE);
        }
    }

    public function arrayToFile($file, $array)
    {
        $dataArray = implode("\n", array_map('rtrim', explode("\n", $this->varExport54($array))));
        $dataArray = str_replace('\\\\', '\\', $dataArray);

        $allData = '<?php return ' . $dataArray . ';'.PHP_EOL;
        file_put_contents($file, $allData);
        return true;
    }

    /**
     * Transforma arrays em texto para scripts PHP.
     *
     * @param $data   Dados que serão escritos em PHP
     * @param $indent Identação
     *
     * @return string $texto Texto em PHP
     */

    public function toJson($data, $indent)
    {
        $texto = '';

        $limit = (count($data)-1);

        $start = 0;

        foreach ($data as $value => $item) {
            $texto .= str_repeat(' ', ($indent*4));

            $texto .= sprintf('"%s": "%s"', $value, $item);

            if ($start < $limit) {
                $texto .= ',';
            }

            $texto .= "\n";

            $start += 1;
        }

        return $texto;

    }
}
