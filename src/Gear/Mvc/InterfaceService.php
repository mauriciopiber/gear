<?php
namespace Gear\Mvc;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Module\ModuleAwareInterface;
use GearJson\Src\Src;
use GearBase\Util\String\StringServiceTrait;
use GearBase\Util\String\StringServiceAwareInterface;
use Gear\Creator\FileCreatorTrait;

class InterfaceService implements ServiceLocatorAwareInterface, ModuleAwareInterface, StringServiceAwareInterface
{
    use FileCreatorTrait;
    use StringServiceTrait;
    use ModuleAwareTrait;
    use ServiceLocatorAwareTrait;

    //namespace
    //extends
    //dependency
    public function create(Src $src)
    {
        $this->src = $src;

        $this->name = $this->src->getName();
        $this->srcType = $this->src->getType();

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/interface.phtml');
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

    public function createInterface(Src $src, $location)
    {
        $this->src = $src;

        $this->name = $this->src->getName();
        $this->srcType = $this->src->getType();

        $trait = $this->getFileCreator();
        $trait->setTemplate('template/module/mvc/interface.phtml');
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
