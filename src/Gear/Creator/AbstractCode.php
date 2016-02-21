<?php
namespace Gear\Creator;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use GearBase\Util\Dir\DirServiceTrait;
use GearBase\Util\Dir\DirServiceAwareInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringServiceAwareInterface;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Creator\FileNamespaceInterface;
use Gear\Creator\FileLocationInterface;
use Gear\Util\Vector\ArrayServiceTrait;

abstract class AbstractCode implements
    FileNamespaceInterface,
    FileLocationInterface,
    ModuleAwareInterface,
    ServiceLocatorAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface
{
    use ArrayServiceTrait;
    use DirServiceTrait;
    use ServiceManagerTrait;
    use StringServiceTrait;
    use ModuleAwareTrait;
    use ServiceLocatorAwareTrait;


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
                $actionName = $this->str('class', $actionName);
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

    public function inject($fileCode, $functions)
    {
        $lines = explode(PHP_EOL, $fileCode);

        $functions =  explode(PHP_EOL, $functions);

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
