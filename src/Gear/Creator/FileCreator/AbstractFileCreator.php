<?php
namespace Gear\Creator\FileCreator;

use Gear\Service\AbstractJsonService;

abstract class AbstractFileCreator extends AbstractJsonService
{
    /**
     * Retorna apenas os nomes de uma coleção de dependências.
     */
    public function getDependencyNames(array $dependencies)
    {
        $names = [***REMOVED***;

        foreach ($dependencies as $dependency) {
            $allNames = explode('\\', $dependency);
            $name = end($allNames);
            $varName = $this->str('class', $name);
            $names[***REMOVED*** = $varName;
        }

        return $names;
    }
}
