<?php
namespace Gear\Service\Type;

use Gear\Common\StringServiceAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Common\ConfigAwareInterface;
use Gear\ValueObject\Config\Config;

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
    public function getUses($src)
    {
        $text = [***REMOVED***;

        if ($src->hasDependency()) {
            foreach($src->getDependency() as $dependency) {
                $use = sprintf('%s\%s', $this->getConfig()->getModule(), $dependency);
                $text[***REMOVED*** = array('use' => $use);
            }
        }
        return $text;
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
                $attribute = sprintf('%s', $this->str('var', $dependencyToInject));
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

    /**
     * miscellaneous/injection-partials.phtml
     */
    public function getInjections($src)
    {
        $text = [***REMOVED***;

        if ($src->hasDependency()) {
            foreach($src->getDependency() as $dependency) {

                $dependencyToInject = $this->splitSrcNames($dependency);

                $class   = sprintf('%s', $this->str('class', $dependencyToInject));
                $var     = sprintf('%s', $this->str('var', $dependencyToInject));
                $service = $this->getServiceManagerName($dependency);

                $text[***REMOVED*** = array(
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
        $split = str_replace('Service\\', '', $split);
        $split = str_replace('Repository\\', '', $split);
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
