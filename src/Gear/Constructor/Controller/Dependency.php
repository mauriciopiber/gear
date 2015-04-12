<?php
namespace Gear\Constructor\Controller;

use Gear\ValueObject\BasicModuleStructure;
use Gear\Constructor\AbstractDependency;
use Gear\ValueObject\Controller;

class Dependency extends AbstractDependency
{
    protected $controller;

    protected $module;

    protected $namespace;

    protected $attribute;

    protected $dependencies;

    public function __construct(Controller $controller, BasicModuleStructure $module)
    {
        $this->controller = $controller;
        $this->module = $module;
    }

    /**
     *
     * @return boolean
     */
    public function getDependencies()
    {
        $actions = $this->controller->getActions();
        if (count($actions)<=0) {
            return false;
        }

        $dependencies = [***REMOVED***;

        foreach ($actions as $action) {

            $dependencyList = $action->getDependency();

            foreach ($dependencyList as $i => $dependency) {

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
        $dependencies = $this->getDependencies()->getDependency();


        foreach ($dependencies as $dependency) {
            $srcType = $this->extractSrcTypeFromDependency($dependency);
            $srcName = $this->extractSrcNameFromDependency($dependency);
            $namespace = sprintf('%s\%s\%sTrait', $this->module->getModuleName(), $srcType, $srcName);
            $this->useNamespaceToString($namespace);
        }

        return (!empty($this->namespace)) ? $this->namespace.PHP_EOL : PHP_EOL;
    }

    public function getUseAttribute()
    {
        $dependencies = $this->getDependencies()->getDependency();


        foreach ($dependencies as $dependency) {
            $srcName = $this->extractSrcNameFromDependency($dependency);
            $namespace = sprintf('%sTrait', $srcName);
            $this->useAttributeToString($namespace);
        }

        return (!empty($this->attribute)) ? $this->attribute.PHP_EOL : PHP_EOL;
    }
}
