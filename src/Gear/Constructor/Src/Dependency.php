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

    public function getTests()
    {
        if ($this->src->hasDependency() == null) {
            return '';
        }

        $tests = '';
        $dependencies = $this->src->getDependency();
        foreach ($dependencies as $i => $dependency) {

            $srcName = $this->extractSrcNameFromDependency($dependency);
            $srcType = $this->extractSrcTypeFromDependency($dependency);


            $tests .= <<<EOS
    public function testSet{$srcName}()
    {

    }

    public function testGet{$srcName}()
    {
        \$this->assertInstanceOf(
            '{$module}\\{$srcType}\\{$srcName}',
            \$this->get{$this->src->getName()}()->get{$srcName}()
        );
    }

EOS;
        }

        return $tests;

    }

    public function getUseNamespace($eol = true)
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

        $eol = ($eol) ? PHP_EOL : '';

        return (!empty($this->namespace)) ? $this->namespace.$eol : $eol;
    }


    public function getUseAttribute($eol = true)
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
        $eol = ($eol) ? PHP_EOL : '';

        return (!empty($this->attribute)) ? $this->attribute.$eol : $eol;
    }
}
