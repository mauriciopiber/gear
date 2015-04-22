<?php
namespace Column\Factory;

use Column\Factory\ForeignKeysFactory;

trait ForeignKeysFactoryTrait
{
    protected $foreignKeysFactory;

    public function getForeignKeysFactory()
    {
        if (!isset($this->foreignKeysFactory)) {
            $serviceName = 'Column\Factory\ForeignKeysFactory';
            $this->foreignKeysFactory = $this->getServiceLocator()->get($serviceName);
        }
        return $this->foreignKeysFactory;
    }

    public function setForeignKeysFactory(ForeignKeysFactory $foreignKeysFactory)
    {
        $this->foreignKeysFactory = $foreignKeysFactory;
        return $this;
    }
}
