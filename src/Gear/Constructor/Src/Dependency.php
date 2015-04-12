<?php
namespace Gear\Constructor\Src;

use Gear\ValueObject\BasicModuleStructure;
use Gear\Constructor\AbstractDependency;

class Dependency extends AbstractDependency
{
    protected $src;

    protected $module;

    protected $namespace;

    protected $attribute;

    public function __construct($src, BasicModuleStructure $module)
    {
        $this->src = $src;
        $this->module = $module;
    }

    public function getUseNamespace()
    {
        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();
        foreach ($dependencies as $i => $dependency) {
            $srcType = $this->extractSrcTypeFromDependency($dependency);
            $srcName = $this->extractSrcNameFromDependency($dependency);
            $namespace = sprintf('%s\%s\%sTrait', $this->module->getModuleName(), $srcType, $srcName);
            $this->useNamespaceToString($namespace);
        }

        return (!empty($this->namespace)) ? $this->namespace.PHP_EOL : PHP_EOL;
    }


    public function getUseAttribute()
    {
        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();

        foreach ($dependencies as $i => $dependency) {

            $srcName = $this->extractSrcNameFromDependency($dependency);
            $namespace = sprintf('%sTrait', $srcName);
            $this->useAttributeToString($namespace);
        }


        return (!empty($this->attribute)) ? $this->attribute.PHP_EOL : PHP_EOL;
    }
}
