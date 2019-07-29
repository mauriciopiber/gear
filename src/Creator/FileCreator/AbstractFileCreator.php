<?php
namespace Gear\Creator\FileCreator;

abstract class AbstractFileCreator
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
