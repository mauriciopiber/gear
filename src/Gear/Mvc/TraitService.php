<?php
namespace Gear\Mvc;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;

class TraitService implements ServiceLocatorAwareInterface, ModuleAwareInterface
{
    use ModuleAwareTrait;
    use ServiceLocatorAwareTrait;

    public function createTrait($src, $location, $name = null, $testLocation = null, $isSearchForm = false, $specialName = null)
    {
        if ($name === null) {
            $name = $this->className;
        }

        $trait = $this->getServiceLocator()->get('fileCreator');
        $trait->setTemplate('template/src/trait.phtml');
        $trait->setFileName($name.'Trait.php');
        $trait->setLocation($location);

        if ($testLocation !== null && is_dir($testLocation)) {


            if ($isSearchForm) {
                $specialName = sprintf('%s\Form\Search\%s', $this->getModule()->getModuleName(), $specialName);
            } else {
                $specialName = sprintf('%s\%s\%s', $this->getModule()->getModuleName(), $src->getType(), $src->getName());
            }

            $traitTest = $this->getServiceLocator()->get('fileCreator');
            $traitTest->setTemplate('template/test/trait.phtml');
            $traitTest->setFileName($name.'TraitTest.php');
            $traitTest->setLocation($testLocation);
            $traitTest->setOptions(array(
                'className' => $name.'Trait',
                'class' => $name,
                'var' => $this->str('var-lenght', $name),
                'expected' => $specialName,
                'module' => $this->getModule()->getModuleName()
            ));
            $traitTest->render();


        }

        $serviceManager = new \Gear\Config\ServiceManager($this->getModule());
        $serviceManager->extractServiceManagerFromSrc($src);

        //convert SearchForm to Factory
        if ($src->getType() == 'SearchFactory') {
            $srcType = 'Factory';
        } else {
           $srcType = $src->getType();
        }

        $trait->setOptions(
            array(
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->str('class', $name),
                'var'   => $this->str('var', $name),
                'lenght' => $this->str('var-lenght', $name),
                'serviceManager' => $serviceManager->getCallable(),
                'srcType' => $srcType,
                'srcName' => $src->getName()
            )
        );

        return $trait->render();
    }
}

