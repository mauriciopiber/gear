<?php
namespace Gear\Constructor;

abstract class AbstractDependency {


    /**
     *
     * @param string $dependency A single dependency
     * @returns \Gear\Service\Constructor\SrcService::avaliable() SRC Gear Type.
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
        foreach (\Gear\Service\Constructor\SrcService::avaliable() as $srcName) {
            $pos = strpos($dependency, $srcName);
            if ($pos !== false) {
                return $srcName;
                break;
            }
            continue;
        }
        throw new \Exception(sprintf('Não foi possível encontrar nenhum src para %s.', $dependency));
    }

    public function extractSrcNameFromDependency($dependency)
    {
        foreach (\Gear\Service\Constructor\SrcService::avaliable() as $srcName) {


            $pos = strpos($dependency, $srcName);

            if ($pos !== false) {

                $srcName = $this->extractSrcType($dependency);
                $dependencyName = str_replace($dependency, '', $srcName);
                $dependencySrc = str_replace('\\', '', $dependency);
                $dependencyTable = str_replace($srcName, '', $dependencySrc);
                $dependencyOk = $dependencyTable.$srcName;

                break;
            }
        }

        if (!isset($dependencyOk)) {
            throw new \Exception(sprintf('Can\'t find dependency type for %s in %s', $entity, __FUNCTION__));
        }

        return $dependencyOk;
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
