<?php
namespace Gear\Constructor\Src;

use Gear\Module\BasicModuleStructure;
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

    public function getFormName()
    {
        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();
        foreach ($dependencies as $i => $dependency) {
            $srcType = $this->extractSrcTypeFromDependency($dependency);

            if ($srcType == 'Form') {
                $srcName = $this->extractSrcNameFromDependency($dependency);
                return $srcName;
            }

        }
    }

    public function getFilterName()
    {
        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();
        foreach ($dependencies as $i => $dependency) {
            $srcType = $this->extractSrcTypeFromDependency($dependency);

            if ($srcType == 'Filter') {
                $srcName = $this->extractSrcNameFromDependency($dependency);
                return $srcName;
            }

        }
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


            $string = new \Gear\Service\Type\StringService();
            $mock = $string->str('var-lenght', 'mock'.$srcName);


            if ($srcType == 'Factory' && strpos($srcName, 'FormFactory') !== false) {
                //factory retorna form.
                $factoryName = $this->module->getModuleName().'\\Form\\'.str_replace('Factory', '', $srcName);
            } else {

                $factoryName = $this->module->getModuleName().'\\'.$srcType.'\\'.$srcName;
            }


            $tests .= <<<EOS
    public function testSet{$srcName}()
    {
        \${$mock} = \$this->getMockSingleClass('{$this->module->getModuleName()}\\{$srcType}\\{$srcName}');
        \$this->get{$this->src->getName()}()->set{$srcName}(\${$mock});
        \$this->assertEquals(\${$mock}, \$this->get{$this->src->getName()}()->get{$srcName}());
    }

    public function testGet{$srcName}()
    {
        \$this->assertInstanceOf(
            '{$factoryName}',
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
