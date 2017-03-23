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

    public function getUseNamespace($eol = true)
    {
        $this->namespace = '';

        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();
        foreach ($dependencies as $dependency) {


            if (is_array($dependency) && isset($dependency['ig_t'***REMOVED***) && $dependency['ig_t'***REMOVED*** === true) {
                continue;
            }

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


    public function getUseAttribute($eol = true, array $ignoreList = null)
    {
        $this->attribute = '';

        if ($this->src->hasDependency() == null) {
            return '';
        }

        $dependencies = $this->src->getDependency();

        $count = count($dependencies);

        foreach ($dependencies as $i => $dependency) {

            if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
                $dependency = $dependency['class'***REMOVED***;
            }

            if (in_array($dependency, $ignoreList)
                || in_array($this->getModule()->getModuleName().'\\'.$dependency, $ignoreList)
            ) {
                continue;
            }

            //var_dump($i, $dependency);
            $srcName = $this->extractSrcNameFromDependency($dependency);
            $namespace = sprintf('%sTrait', $srcName);
            $this->useAttributeToString($namespace);

            if ($count>1 && $i < $count-1) {
                $this->attribute .= PHP_EOL;
            }
        }
        //die();

        $eol = ($eol) ? PHP_EOL : '';

        return (!empty($this->attribute)) ? $this->attribute.$eol : $eol;
    }
}
