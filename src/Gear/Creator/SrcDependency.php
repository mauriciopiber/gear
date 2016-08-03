<?php
namespace Gear\Creator;

use Gear\Creator\AbstractDependency;
use GearJson\Src\Src;

/**
 * @deprecated Essa classe possui muita dívida técnica, é melhor desativá-la após testar completamente.
 *
 * @author piber
 *
 */
class SrcDependency extends AbstractDependency
{
    protected $module;

    protected $namespace;

    protected $attribute;

    protected $src;

    public function setSrc(Src $src)
    {
        $this->src = $src;
        return $this;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function getServiceManagerName($dependency)
    {
        return sprintf('%s\%s', $this->getModule()->getModuleName(), $dependency);
    }

    public function getTestInjections($src)
    {
        $text = [***REMOVED***;
        if ($src instanceof Src && $src->hasDependency()) {
            foreach ($src->getDependency() as $dependency) {
                $dependsName = $this->extractSrcNameFromDependency($dependency);

                $class     = sprintf('%s', $this->str('class', $dependsName));
                $var       = sprintf('%s', $this->str('var-lenght', $dependsName));
                $baseClass = sprintf('%s', $this->str('class', $src->getName()));
                $baseVar   = sprintf('%s', $this->str('var-lenght', $src->getName()));
                $service   = $this->getServiceManagerName($dependency);


                if (strlen($var) > 18) {
                    $var = substr($var, 0, 17);
                }

                if (strlen($baseVar) > 18) {
                    $baseVar = substr($baseVar, 0, 17);
                }

                $text[***REMOVED*** = array(
                    'baseClass' => $baseClass,
                    'baseVar' => $baseVar,
                    'class' => $class,
                    'var' => $var,
                    'service' => $service,
                );
            }
        }

        return $text;
    }

    public function getFormName()
    {
        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();
        foreach ($dependencies as $dependency) {
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
        foreach ($dependencies as $dependency) {
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
        foreach ($dependencies as $dependency) {
            $srcName = $this->extractSrcNameFromDependency($dependency);


            $srcType = $this->extractSrcTypeFromDependency($dependency);

            $string = new \GearBase\Util\String\StringService();
            $mock = $string->str('var-lenght', 'mock'.$srcName);

            if ($srcType[0***REMOVED*** == '\\') {
                $factoryName = sprintf('%s\%s', ltrim($srcType, '\\'), $srcName);
            } else {
                $factoryName = sprintf('%s\%s\%s', $this->getModule()->getModuleName(), $srcType, $srcName);
            }



            $tests .= <<<EOS
    public function testSet{$srcName}()
    {
        \${$mock} = \$this->getMockSingleClass('{$factoryName}');
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
        $this->namespace = '';

        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();
        foreach ($dependencies as $dependency) {
            $srcType = $this->extractSrcTypeFromDependency($dependency);

            $srcName = $this->extractSrcNameFromDependency($dependency);

            if ($srcType[0***REMOVED*** == '\\') {
                $namespace = sprintf('%s\%sTrait', ltrim($srcType, '\\'), $srcName);
            } else {
                $namespace = sprintf('%s\%s\%sTrait', $this->getModule()->getModuleName(), $srcType, $srcName);
            }



            $this->useNamespaceToString($namespace);
        }

        $eol = ($eol) ? PHP_EOL : '';

        return (!empty($this->namespace)) ? $this->namespace.$eol : $eol;
    }


    public function getUseAttribute($eol = true)
    {
        $this->attribute = '';

        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();

        $count = count($dependencies);

        foreach ($dependencies as $i => $dependency) {
            $srcName = $this->extractSrcNameFromDependency($dependency);
            $namespace = sprintf('%sTrait', $srcName);
            $this->useAttributeToString($namespace);

            if ($count>1 && $i < $count-1) {
                $this->attribute .= PHP_EOL;
            }
        }
        $eol = ($eol) ? PHP_EOL : '';

        return (!empty($this->attribute)) ? $this->attribute.$eol : $eol;
    }
}
