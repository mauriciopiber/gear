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
        $location,
        $name = null,
        $testLocation = null,
        $isSearchForm = false,
        $specialName = null
    ) {
        if ($name === null) {
            $name = $src->getName();
        }

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/trait/src.phtml');
        $trait->setFileName($name.'Trait.php');
        $trait->setLocation($location);

        /**
        if ($testLocation !== null && is_dir($testLocation)) {
            if ($isSearchForm) {
                $specialName = sprintf(
                    '%s\Form\Search\%s',
                    $this->getModule()->getModuleName(),
                    $specialName
                );
            } else {
                $specialName = sprintf(
                    '%s\%s\%s',
                    $this->getModule()->getModuleName(),
                    $src->getType(),
                    $src->getName()
                );
            }

            $traitTest = $this->getFileCreator();
            $traitTest->setTemplate('template/module/test/trait.phtml');
            $traitTest->setFileName($name.'TraitTest.php');
            $traitTest->setLocation($testLocation);
            $traitTest->setOptions([
                'className' => $name.'Trait',
                'class' => $name,

                'var' => $this->str('var-length', $name),
                'expected' => $specialName,
                'module' => $this->getModule()->getModuleName()
            ***REMOVED***);
            $traitTest->render();
        }*/

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
