<?php
namespace Gear\Service\Type;

use Gear\Common\StringServiceAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\ConfigAwareInterface;
use Gear\ValueObject\Config\Config;
use Gear\ValueObject\Src;

class ClassService implements
  ServiceLocatorAwareInterface,
  StringServiceAwareInterface,
  ConfigAwareInterface
{
    /**
     * miscellaneous/use-partials.phtml
     *
     * @param unknown $module
     * @return multitype:multitype:string
     */
    public function getDependencyName($dependency)
    {

        $srcName = $this->querySrcName($dependency);

        $dependencyName = str_replace($dependency, '', $srcName);
        $dependencySrc = str_replace('\\', '', $dependency);

        $dependencyTable = str_replace($srcName, '', $dependencySrc);

        $dependency = $srcName.'\\'.$dependencyTable.$srcName;

        return $dependency;
    }

    public function resolveUse($entity)
    {
        foreach (\Gear\Service\Constructor\SrcService::avaliable() as $srcName) {
            $pos = strpos($entity, $srcName);

            if ($pos !== false) {
                $dependencyOk = $this->getDependencyName($entity, $srcName);
                break;
            }
        }

        if (!isset($dependencyOk)) {
            throw new \Exception(sprintf('Can\'t find dependency type for %s in %s', $entity, __FUNCTION__));
        }

        return $dependencyOk;
    }

    public function getUses($dataset)
    {
        $text = [***REMOVED***;
        $src = $dataset;

        if ($src->hasDependency()) {
            foreach($src->getDependency() as $dependency) {

                if (is_string($dependency)) {

                    $dependencyToInject = $this->splitSrcNames($dependency);

                    if ($dependencyToInject == $src->getName()) {

                        $strTo = explode("\\", $dependency);
                        $use = sprintf('%s\%s as %s',  $this->getConfig()->getModule(), $dependency, $dependencyToInject.$strTo[0***REMOVED***);
                    } else {

                        $dependencyOk = $this->resolveUse($dependency);

                        $use = sprintf('%s\%s', $this->getConfig()->getModule(), $dependencyOk);
                    }
                    $text[***REMOVED*** = array('use' => $use);
                } else {

                    foreach ($dependency as $dependencyItem) {

                        $dependencyOk = $this->resolveUse($dependencyItem);

                        $use = sprintf('%s\%s', $this->getConfig()->getModule(), $dependencyOk);

                        $text[***REMOVED*** = array('use' => $use);

                    }

                }
            }
        }
        return $text;
    }

    public function querySrcName($dependency)
    {

        foreach (\Gear\Service\Constructor\SrcService::avaliable() as $srcName) {
            $pos = strpos($dependency, $srcName);
            if ($pos !== false) {

                return $srcName;
                break;
            }

            $dependencyName = $this->getSrcTypeFromDependency($dependency);


            if ($dependencyName == $srcName) {


                return $srcName;
                break;
            }

        }

        throw new \Exception(sprintf('Não foi possível encontrar nenhum src para %s.', $dependency));
    }

    public function getAttribute($dependency)
    {

        $srcName = $this->querySrcName($dependency);

        $dependencyName = str_replace($dependency, '', $srcName);
        $dependencySrc = str_replace('\\', '', $dependency);

        $dependencyTable = str_replace($srcName, '', $dependencySrc);

        if (strlen(lcfirst($dependencyTable).$srcName) >= 20) {
            $dependency = lcfirst($srcName);
        } else {
            $dependency = lcfirst($dependencyTable).$srcName;
        }


        return $dependency;
    }

    /**
     * miscellaneous/use-partials.phtml
    */
    public function getAttributes($src, $scope = 'protected')
    {
        $text = [***REMOVED***;
        if ($src->hasDependency()) {
            foreach($src->getDependency() as $dependency) {
                if (is_string($dependency)) {
                    $text[***REMOVED*** = $this->resolveAttribute($dependency);
                } elseif(is_array($dependency)) {
                    foreach($dependency as $dependencyItem) {
                        $text[***REMOVED*** = $this->resolveAttribute($dependencyItem);

                    }
                }
            }
        }
        return $text;
    }


    public function resolveAttribute($dependency, $scope = 'protected')
    {
        $dependencyToInject = $this->splitSrcNames($dependency);


        $attribute = $this->getAttribute($dependencyToInject);
        $service = $this->getServiceManagerName($dependency);
        return array(
            'docVar' => $service,
            'scope' => $scope,
            'attribute' => $attribute,
        );
    }

    public function getInjection($dependency)
    {
        $srcName = $this->querySrcName($dependency);

        $dependencyName = str_replace($dependency, '', $srcName);
        $dependencySrc = str_replace('\\', '', $dependency);

        $dependencyTable = str_replace($srcName, '', $dependencySrc);

        $dependency = $dependencyTable.$srcName;

        return $dependency;
    }

    /**
     * miscellaneous/injection-partials.phtml
     */
    public function getInjections($src)
    {
        $text = [***REMOVED***;
        if ($src->hasDependency()) {
            foreach ($src->getDependency() as $dependency) {
                if (is_string($dependency)) {
                    $text[***REMOVED*** = $this->resolveInjection($dependency, $src);
                } else {
                    foreach ($dependency as $dependencyItem) {
                        $text[***REMOVED*** = $this->resolveInjection($dependencyItem, $src);
                    }
                }
            }
        }
        return $text;
    }

    public function concatVar($dependencyName, $srcName)
    {
        if (strlen($dependencyName) >= 20) {
            return lcfirst($srcName);
        } else {
            return lcfirst($dependencyName);
        }
    }

    /**
     * Returns dependency name.
     */
    public function getSrcTypeFromDependency($dependencyName)
    {
        $names = explode('\\', $dependencyName);
        return $names[0***REMOVED***;
    }

    /**
     * Returns dependency name.
     */
    public function getSrcNameFromDependency($dependencyName)
    {
        $names = explode('\\', $dependencyName);
        return end($names);
    }

    /**
     *
     * @param string $dependencyName SERVICE\\NAME
     */
    public function resolveInjection($dependencyName, $src)
    {
        $dependencySourceName = $this->getSrcTypeFromDependency($dependencyName);

        $dependencyToInject = $this->getInjection($dependencyName);

        $var     = sprintf('%s', $this->str('var', $dependencyToInject));
        $class   = sprintf('%s', $this->str('class', $dependencyToInject));

        if ($dependencyToInject == $src->getName()) {
            $strTo = explode("\\", $dependency);
            $classUse = $src->getName().$strTo[0***REMOVED***;
        } else {
            $classUse = $this->getInjection($class);
        }


        $service = $this->getServiceManagerName($this->querySrcName($class).'\\'.$class);

        if ($src instanceof \Gear\ValueObject\Controller) {
            $type = 'Controller';
        } elseif($src instanceof \Gear\ValueObject\Src) {
            $type = $src->getType();
        } else {
            throw new \Exception('Não foi possível estabelecer qual valor deve ser concatenado na hora de resolver a injection.');
        }


        return array(
            'class' => $class,
            'var' => $this->concatVar($var, $dependencySourceName),
            'service' => $service,
            'classUse' => $classUse
        );
    }

    public function getTestInjections($src)
    {
        $text = [***REMOVED***;
        if ($src instanceof Src && $src->hasDependency()) {

                foreach ($src->getDependency() as $dependency) {

                    $dependsName = $this->getSrcNameFromDependency($dependency);
                    $dependsType = $this->getSrcTypeFromDependency($dependency);


                    $class     = sprintf('%s', $this->str('class', $dependsName.$dependsType));
                    $var       = sprintf('%s', $this->str('var', $dependsName.$dependsType));
                    $baseClass = sprintf('%s', $this->str('class', $src->getName()));
                    $baseVar   = sprintf('%s', $this->str('var', $src->getName()));
                    $service   = $this->getServiceManagerName($dependency.$dependsType);


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

    public function getServiceManagerName($dependency)
    {
        return sprintf('%s\%s', $this->getConfig()->getModule(), $dependency);
    }


    public function splitSrcNames($toSplit)
    {
        $split = $toSplit;
        //$split = str_replace('Service\\', '', $split);

        return $split;
    }

    public function setStringService(StringService $fileWriter)
    {
        $this->stringService = $fileWriter;

        return $this;
    }

    public function getStringService()
    {
        if (!isset($this->stringService)) {
            $this->stringService = $this->getServiceLocator()->get('stringService');
        }

        return $this->stringService;
    }

    public function str($type, $message)
    {
        return $this->getStringService()->str($type, $message);
    }


    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setConfig(Config $config)
    {

        $this->config = $config;

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

}
