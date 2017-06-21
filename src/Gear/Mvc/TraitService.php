<?php
namespace Gear\Mvc;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringServiceAwareInterface;
use Gear\Mvc\Config\ServiceManagerTrait;
use Gear\Creator\CodeTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;

class TraitService implements ServiceLocatorAwareInterface, ModuleAwareInterface, StringServiceAwareInterface
{
    use FileCreatorTrait;
    use CodeTrait;
    use ServiceManagerTrait;
    use StringServiceTrait;
    use ModuleAwareTrait;
    use ServiceLocatorAwareTrait;

    public function createTrait(
        $src,
        $location = null,
        $name = null,
        $testLocation = null,
        $isSearchForm = false,
        $specialName = null
    ) {
        if ($name === null) {
            $name = $src->getName();
        }

        $location = $this->getCode()->getLocation($src);

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/trait/src.phtml');
        $trait->setFileName($name.'Trait.php');
        $trait->setLocation($location);

        $callable = $this->getServiceManager()->getServiceCallable($src);

        $service = $this->getServiceManager()->getServiceName($src);

        $trait->setOptions(
            [
                'classDocs' => $this->getCode()->getClassDocs($src),
                'module' => $this->getModule()->getModuleName(),
                'namespace' => $this->getCode()->getNamespace($src),
                'class' => $this->str('class', $name),
                'label' => $this->str('label', $name),
                'var'   => $this->str('var', $name),
                'lenght' => $this->str('var-length', $name, ['offset' => 'mock'***REMOVED***),
                'srcType' => $src->getType(),
                'srcName' => $src->getName(),
                'service' => $service,
                'callable' => $callable
            ***REMOVED***
        );

        return $trait->render();
    }
}
