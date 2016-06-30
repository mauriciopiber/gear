<?php
namespace Gear\Creator\File;

use Gear\Util\Vector\ArrayService;
use Gear\Util\Vector\ArrayServiceTrait;

class Injector
{
    use ArrayServiceTrait;

    public function __construct(ArrayService $arrayService)
    {
        $this->arrayService = $arrayService;
    }

    /**
     * Adiciona novas funções em um arquivo.
     *
     * @param $fileCode Arquivo que receberá as funções.
     * @param $functions Novas funções
     *
     * @return $newFile Arquivo que foi salvo
     */

    public function inject(array $lines, array $functions)
    {
        $endClass = array_search('}', $lines);

        if (empty($lines[$endClass-1***REMOVED***)) {
            $lines = $this->getArrayService()->replaceLine($lines, $endClass-1, $functions);
        } else {
            $lines = $this->getArrayService()->moveArray($lines, $endClass, $functions);
        }

        // remove as linhas em branco após a última função.

        $fixEmptyLines = false;
        $count = count($lines);

        foreach ($lines as $i => $line) {

            if ($line === "    }") {
                $fixEmptyLines = true;
                break;
            }
        }

        if ($fixEmptyLines === false) {
            $lines = array_values($lines);
            return $lines;
        }

        for($i = ($count-2); $i >= 0; $i--) {

            if ($lines[$i***REMOVED*** === "    }") {
                break;
            }

            if (empty($lines[$i***REMOVED***)) {
                unset($lines[$i***REMOVED***);
            }
        }
        $lines = array_values($lines);
        return $lines;
    }
}
