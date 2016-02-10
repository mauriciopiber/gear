<?php
namespace Gear\Mvc;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use GearJson\Src\Src;

class InterfaceService implements ServiceLocatorAwareInterface, ModuleAwareInterface
{
    use ModuleAwareTrait;
    use ServiceLocatorAwareTrait;

    public function createInterface(Src $src, $location)
    {
        $this->src = $src;

        $this->name = $this->src->getName();
        $this->srcType = $this->src->getType();

        $trait = $this->getServiceLocator()->get('fileCreator');
        $trait->setTemplate('template/src/interface.phtml');
        $trait->setFileName($this->name.'Interface.php');
        $trait->setLocation($location);

        $trait->setOptions(
            array(
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->str('class', $this->name),
                'var'   => $this->str('var', $this->name),
                'lenght' => $this->str('var-lenght', $this->name),
                'srcType' => $this->srcType,
                'srcName' => $this->name
            )
        );

        return $trait->render();
    }

}
