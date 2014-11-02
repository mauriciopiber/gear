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

    public function getUses($dataset)
    {
        $text = [***REMOVED***;

        $src = $dataset;


        if ($src->hasDependency()) {
            foreach($src->getDependency() as $dependency) {

                $dependencyToInject = $this->splitSrcNames($dependency);

                if ($dependencyToInject == $src->getName()) {


                    $strTo = explode("\\", $dependency);

                    $use = sprintf('%s\%s as %s',  $this->getConfig()->getModule(), $dependency, $dependencyToInject.$strTo[0***REMOVED***);
                } else {

                    foreach (\Gear\Service\Constructor\SrcService::avaliable() as $srcName) {
                        $pos = strpos($dependency, $srcName);

                        if ($pos !== false) {
                            $dependencyOk = $this->getDependencyName($dependency, $srcName);
                            break;
                        }

                    }

                    $use = sprintf('%s\%s', $this->getConfig()->getModule(), $dependencyOk);
                }


                $text[***REMOVED*** = array('use' => $use);
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
        }

        throw new \Exception(sprintf('Não foi possível encontrar nenhum src para %s.', $dependency));
    }

    public function getAttribute($dependency)
    {

        $srcName = $this->querySrcName($dependency);

        $dependencyName = str_replace($dependency, '', $srcName);
        $dependencySrc = str_replace('\\', '', $dependency);

        $dependencyTable = str_replace($srcName, '', $dependencySrc);

        $dependency = lcfirst($dependencyTable).$srcName;

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
                $dependencyToInject = $this->splitSrcNames($dependency);
                $attribute = $this->getAttribute($dependencyToInject);
                $service = $this->getServiceManagerName($dependency);
                $text[***REMOVED*** = array(
                    'docVar' => $service,
                    'scope' => $scope,
                    'attribute' => $attribute,
                );
            }
        }
        return $text;
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

                $dependencyToInject = $this->splitSrcNames($dependency);
                $class   = sprintf('%s', $this->str('class', $this->getInjection($dependency)));

                if ($dependencyToInject == $src->getName()) {

                    $strTo = explode("\\", $dependency);

                    $classUse = $src->getName().$strTo[0***REMOVED***;
                } else {
                    $classUse = $this->getInjection($class);
                }

                $var     = sprintf('%s', $this->str('var', $dependencyToInject));
                $service = $this->getServiceManagerName($this->querySrcName($class).'\\'.$class);

                $text[***REMOVED*** = array(
                    'class' => $class,
                    'var' => $var,
                    'service' => $service,
                    'classUse' => $classUse
                );
            }
        }
        return $text;
    }

    public function getTestInjections($src)
    {
        $text = [***REMOVED***;
        if ($src instanceof Src && $src->hasDependency()) {

            foreach ($src->getDependency() as $dependency) {
                $dependencyToInject = $this->splitSrcNames($dependency);

                $class     = sprintf('%s', $this->str('class', $dependencyToInject));
                $var       = sprintf('%s', $this->str('var', $dependencyToInject));
                $baseClass = sprintf('%s', $this->str('class', $src->getName()));
                $baseVar   = sprintf('%s', $this->str('var', $src->getName()));
                $service   = $this->getServiceManagerName($dependency);

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
        $split = str_replace('Repository\\', '', $split);
        $split = str_replace('\\', '', $split);
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
