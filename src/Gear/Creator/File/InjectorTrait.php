<?php
namespace Gear\Creator\File;

use Gear\Creator\File\InjectorFactory;

trait InjectorTrait
{
    protected $injector;

    public function getInjector()
    {
        if (!isset($this->injector)) {
            $name = 'Gear\Creator\File\Injector';
            $this->injector = $this->getServiceLocator()->get($name);
        }
        return $this->injector;
    }

    public function setInjector(
        Injector $injector
    ) {
        $this->injector = $injector;
        return $this;
    }
}
