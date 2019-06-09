<?php
namespace Gear\Creator\Codes;

use Gear\Util\Dir\DirServiceTrait;
use Gear\Util\Dir\DirServiceAwareInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\String\StringServiceAwareInterface;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Creator\AppDependencyTrait;
//use Gear\Creator\ControllerDependencyTrait;
//use Gear\Creator\SrcDependencyTrait;
use Gear\Schema\Src\Src;
use Gear\Schema\Controller\Controller;
use Gear\Schema\App\App;
use Gear\Creator\FileCreator\FileCreatorTrait;

abstract class AbstractCodeBase implements
    FileNamespaceInterface,
    FileLocationInterface,
    ModuleStructureInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface
{
    use FileCreatorTrait;
    use ArrayServiceTrait;
    use DirServiceTrait;
    use ServiceManagerTrait;
    use StringServiceTrait;
    use ModuleStructureTrait;

    const USE = 'use %s;';
    /**/

    public function printUse($uses)
    {
        $html = '';

        foreach ($uses as $use) {
            $html .= sprintf(self::USE, $use).PHP_EOL;
        }

        return $html;
    }

    /**
    public function resolveAliase($item)
    {
        if (is_array($item) && isset($item['class'***REMOVED***)) {

            if (isset($item['aliase'***REMOVED***)) {
                $item = $item['aliase'***REMOVED***;
            } else {
                $item = $item['class'***REMOVED***;
            }
        }

        $names = explode('\\', $item);
        $name = end($names);
        return $name;
    }
    */

    public function extractSrcType($dependency)
    {
        $data = explode('\\', $dependency);
        array_pop($data);
        return implode('\\', $data);
    }

    public function extractSrcTypeFromDependency($dependency)
    {
        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            $dependency = $dependency['class'***REMOVED***;
        }

        $srcType = $this->extractSrcType($dependency);
        if ($srcType == 'SearchForm') {
            return 'Form\\Search';
        } elseif ($srcType == 'ControllerPlugin') {
            return 'Controller\\Plugin';
        }

        return $srcType;
    }

    public function extractSrcNameFromDependency($dependency)
    {
        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            $dependency = $dependency['class'***REMOVED***;
        }

        $data = explode('\\', $dependency);
        return end($data);
    }

    public function resolveName($item)
    {
        if (is_array($item) && isset($item['class'***REMOVED***)) {
            $item = $item['class'***REMOVED***;
        }

        $names = explode('\\', $item);
        $name = end($names);
        return $name;
    }

    public function resolveNamespace($item)
    {
        //extract class name if is an array
        if (is_array($item) && isset($item['class'***REMOVED***)) {
            $item = $item['class'***REMOVED***;
        }

        $namespace = ($item[0***REMOVED*** != '\\') ? $this->getModule()->getModuleName().'\\' : '';
        $item = ltrim($item, '\\');
        $extendsItem = explode('\\', $item);
        return $namespace.implode('\\', $extendsItem);
    }

    /**
     * Retorna as funções existentes em determinado arquivo.
     */
    public function getFunctionsNameFromFile($file)
    {

        if (is_array($file)) {
            $text = implode(PHP_EOL, $file);
        } elseif (is_file($file)) {
            $text = file_get_contents($file);
        } else {
            $text = '';
        }


        preg_match_all('/public function [a-zA-Z0-9()***REMOVED****/', $text, $matches);

        $actions = [***REMOVED***;

        if (!empty($matches)) {
            foreach ($matches[0***REMOVED*** as $match) {
                $actionName = str_replace('public function ', '', $match);
                $actionName = str_replace('Action()', '', $actionName);
                $actionName = str_replace('Action(', '', $actionName);
                $actionName = str_replace('()', '', $actionName);
                $actionName = str_replace('(', '', $actionName);
                $actionName = trim($actionName);
                if (!empty($actionName)) {
                    $actionName = $this->str('class', $actionName);
                }
                $actions[***REMOVED***  = $actionName;
            }
        }

        return $actions;
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

/*
        if (empty($lines[count($lines)-2***REMOVED***)) {
            unset($lines[count($lines)-2***REMOVED***);
        } */

        return $lines;
    }
}
