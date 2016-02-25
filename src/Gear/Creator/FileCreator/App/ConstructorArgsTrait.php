<?php
namespace Gear\Creator\FileCreator\App;

use Gear\Creator\FileCreator\App\ConstructorArgs;

trait ConstructorArgsTrait
{
    protected $constructorArgs;

    public function getConstructorArgs()
    {
        if (!isset($this->constructorArgs)) {
            $name = 'Gear\Creator\FileCreator\App\ConstructorArgs';
            $this->constructorArgs = $this->getServiceLocator()->get($name);
        }
        return $this->constructorArgs;
    }

    public function setConstructorArgs(
        ConstructorArgs $constructorArgs
    ) {
        $this->constructorArgs = $constructorArgs;
        return $this;
    }
}
