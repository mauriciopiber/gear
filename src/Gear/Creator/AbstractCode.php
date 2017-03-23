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
use Gear\Creator\AppDependencyTrait;
use Gear\Creator\ControllerDependencyTrait;
use Gear\Creator\SrcDependencyTrait;
use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\App\App;
use Gear\Creator\FileCreatorTrait;

abstract class AbstractCode implements
    FileNamespaceInterface,
    FileLocationInterface,
    ModuleAwareInterface,
    ServiceLocatorAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface
{
    use FileCreatorTrait;
    use AppDependencyTrait;
    use ControllerDependencyTrait;
    use SrcDependencyTrait;
    use ArrayServiceTrait;
    use DirServiceTrait;
    use ServiceManagerTrait;
    use StringServiceTrait;
    use ModuleAwareTrait;
    use ServiceLocatorAwareTrait;

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

    public function loadDependencyService($data)
    {
        if ($data instanceof Src) {
            $this->dependency = $this->getSrcDependency()->setSrc($data);
            return;
        }


        if ($data instanceof Controller) {
            $this->dependency = $this->getControllerDependency()->setController($data);
            return;
        }

        if ($data instanceof App) {
            $this->dependency = $this->getAppDependency()->setApp($data);
            return;
        }
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
