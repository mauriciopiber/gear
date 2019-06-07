<?php
namespace Gear\Creator\Injector;

use Gear\Creator\Injector\InjectorFactory;

trait InjectorTrait
{
    protected $injector;

    public function getInjector()
    {
        return $this->injector;
    }

    public function setInjector(
        Injector $injector
    ) {
        $this->injector = $injector;
        return $this;
    }
}
