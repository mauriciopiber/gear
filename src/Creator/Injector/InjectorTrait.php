<?php
namespace Gear\Creator\Injector;

use Gear\Creator\Injector\InjectorFactory;

trait InjectorTrait
{
    protected $injector;

    public function getInjector()
    {
        if (!isset($this->injector)) {
            $name = 'Gear\Creator\Injector\Injector';
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
