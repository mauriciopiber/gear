<?php
namespace Gear\Creator\FileCreator\App;

use Gear\Creator\FileCreator\App\ConstructorArgs;

trait ConstructorArgsTrait
{
    protected $constructorArgs;

    public function getConstructorArgs()
    {
        return $this->constructorArgs;
    }

    public function setConstructorArgs(
        ConstructorArgs $constructorArgs
    ) {
        $this->constructorArgs = $constructorArgs;
        return $this;
    }
}
