<?php
namespace Gear\Creator\Component\Constructor;

use Gear\Creator\Component\Constructor\ConstructorParamsFactory;

trait ConstructorParamsTrait
{
    protected $constructorParams;

    /**
     * Get Constructor Params
     *
     * @return Gear\Creator\Component\Constructor\ConstructorParams
     */
    public function getConstructorParams()
    {
        if (!isset($this->constructorParams)) {
            $name = 'Gear\Creator\Component\Constructor\ConstructorParams';
            $this->constructorParams = $this->getServiceLocator()->get($name);
        }
        return $this->constructorParams;
    }

    /**
     * Set Constructor Params
     *
     * @param ConstructorParams $constructorParams Constructor Params
     *
     * @return \Gear\Creator\Component\Constructor\ConstructorParams
     */
    public function setConstructorParams(
        ConstructorParams $constructorParams
    ) {
        $this->constructorParams = $constructorParams;
        return $this;
    }
}
