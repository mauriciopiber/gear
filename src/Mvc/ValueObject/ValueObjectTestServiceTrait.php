<?php
namespace Gear\Mvc\ValueObject;

use Gear\Mvc\ValueObject\ValueObjectTestService;

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
            $this->valueObjectTestService = $this->getServiceLocator()->get(ValueObjectTestService::class);
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
