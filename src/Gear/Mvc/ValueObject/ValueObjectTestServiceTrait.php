<?php
namespace Gear\Mvc\ValueObject;

use Gear\Mvc\ValueObject\ValueObjectTestServiceFactory;

trait ValueObjectTestServiceTrait
{
    protected $valueObjectTestService;

    /**
     * Get Value Object Test Service
     *
     * @return Gear\Mvc\ValueObject\ValueObjectTestService
     */
    public function getValueObjectTestService()
    {
        if (!isset($this->valueObjectTestService)) {
            $name = 'Gear\Mvc\ValueObject\ValueObjectTestService';
            $this->valueObjectTestService = $this->getServiceLocator()->get($name);
        }
        return $this->valueObjectTestService;
    }

    /**
     * Set Value Object Test Service
     *
     * @param ValueObjectTestService $valueObjectTest Value Object Test Service
     *
     * @return \Gear\Mvc\ValueObject\ValueObjectTestService
     */
    public function setValueObjectTestService(
        ValueObjectTestService $valueObjectTest
    ) {
        $this->valueObjectTestService = $valueObjectTest;
        return $this;
    }
}
