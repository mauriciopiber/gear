<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractHydrator;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;


class ServiceManager extends AbstractHydrator
{
    protected $service = 'invokables';

    protected $object;

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }

    public function getInputFilter()
    {
        $service = new Input('service');
        $service->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty())
        ->addValidator(new \Zend\Validator\InArray(array('haystack' => array('invokables', 'factories'))));


        $object = new Input('object');
        $object->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($service)
        ->add($object);

        return $inputFilter;
    }
}
