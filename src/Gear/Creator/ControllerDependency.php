<?php
namespace Gear\Creator;

use Gear\Creator\AbstractDependency;
use GearJson\Controller\Controller;

class ControllerDependency extends AbstractDependency
{
    protected $module;

    protected $namespace;

    protected $attribute;

    protected $dependencies;

    protected $controller;

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function getController()
    {
        return $this->controller;
    }


    public function getTests()
    {
        if ($this->controller->hasDependency() == null) {
            return '';
        }


        $dependencies = $this->getDependencies()->getDependency();


        $valid = [***REMOVED***;

        foreach ($dependencies as $dependency) {
            $srcName = $this->extractSrcNameFromDependency($dependency);
            $srcType = $this->extractSrcTypeFromDependency($dependency);

            $factoryName = $this->getModule()->getModuleName().'\\'.$srcType.'\\'.$srcName;


            if (!in_array($factoryName, $valid)) {
                $valid[***REMOVED*** = $factoryName;
            }
        }

        return $valid;
    }


    public function getDependencies()
    {
        $actions = $this->controller->getActions();
        if (count($actions)<=0) {
            return $this;
        }

        $dependencies = [***REMOVED***;

        foreach ($actions as $action) {
            $dependencyList = $action->getDependency();

            foreach ($dependencyList as $dependency) {
                if (in_array($dependency, $dependencies)) {
                    continue;
                }

                $dependencies[***REMOVED*** = $dependency;
                continue;
            }
        }
        $this->dependencies = $dependencies;
        return $this;
    }

    public function getDependency()
    {
        return $this->dependencies;
    }

    public function getUseNamespace()
    {
        $this->namespace = '';

        $dependencies = $this->getDependencies()->getDependency();

        if (empty($dependencies)) {
            return null;
        }

        if (!empty($dependencies)) {
            foreach ($dependencies as $dependency) {
                $srcType = $this->extractSrcTypeFromDependency($dependency);

                $srcName = $this->extractSrcNameFromDependency($dependency);

                $namespace = sprintf('%s\%s\%sTrait', $this->getModule()->getModuleName(), $srcType, $srcName);



                $this->useNamespaceToString($namespace);
            }
        }
        return (!empty($this->namespace)) ? $this->namespace.PHP_EOL : PHP_EOL;
    }

    public function getUseAttribute()
    {
        $this->attribute = '';

        $dependencies = $this->getDependencies()->getDependency();


        if (!empty($dependencies)) {
            foreach ($dependencies as $dependency) {
                $srcName = $this->extractSrcNameFromDependency($dependency);
                $namespace = sprintf('%sTrait', $srcName);
                $this->useAttributeToString($namespace);
            }
        }

        return (!empty($this->attribute)) ? $this->attribute.PHP_EOL : PHP_EOL;
    }
}
