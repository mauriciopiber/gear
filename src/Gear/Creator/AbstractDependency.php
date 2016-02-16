<?php
namespace Gear\Creator;

abstract class AbstractDependency
{
    /**
     *
     * @param string $dependency A single dependency
     * @returns \Gear\Constructor\Service\SrcService::avaliable() SRC Gear Type.
     */
    public function getTypeOfDependency($dependency)
    {

    }

    public function extractSrcTypeFromDependency($dependency)
    {
        $srcType = $this->extractSrcType($dependency);
        if ($srcType == 'SearchFactory') {
            return 'Factory';
        }
        return $srcType;
    }

    public function extractSrcType($dependency)
    {
        $data = explode('\\', $dependency);
        $value = array_pop($data);
        return implode('\\', $data);
    }

    public function extractSrcNameFromDependency($dependency)
    {
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
