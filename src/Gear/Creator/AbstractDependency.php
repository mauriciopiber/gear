<?php
namespace Gear\Creator;

use Gear\Module\ModuleAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use GearBase\Util\String\StringServiceTrait;

abstract class AbstractDependency implements ServiceLocatorAwareInterface
{
    use StringServiceTrait;

    use ServiceLocatorAwareTrait;

    use ModuleAwareTrait;


    public function extractSrcTypeFromDependency($dependency)
    {
        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            $dependency = $dependency['class'***REMOVED***;
        }

        $srcType = $this->extractSrcType($dependency);
        if ($srcType == 'SearchForm') {
            return 'Form\\Search';
        }
        return $srcType;
    }

    public function extractSrcType($dependency)
    {
        $data = explode('\\', $dependency);
        array_pop($data);
        return implode('\\', $data);
    }

    public function extractSrcNameFromDependency($dependency)
    {
        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            $dependency = $dependency['class'***REMOVED***;
        }

        $data = explode('\\', $dependency);
        return end($data);
    }

    public function useNamespaceToString($namespace)
    {
        $namespaceString = <<<EOL
use $namespace;

EOL;
        $this->namespace .= $namespaceString;
        return true;
    }


    public function useAttributeToString($attribute)
    {
        $namespaceString = <<<EOL
    use $attribute;

EOL;
        $this->attribute .= $namespaceString;
        return true;
    }
}
