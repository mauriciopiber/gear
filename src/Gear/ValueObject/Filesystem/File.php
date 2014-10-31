<?php
namespace Gear\ValueObject\Filesystem;

use Gear\Common\WritableAwareInterface;
use Gear\ValueObject\AbstractHydrator;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class File extends AbstractHydrator
{
    protected $location;

    protected $name;

    protected $extension;

    protected $content;

    public function getInputFilter()
    {
        $location = new Input('location');
        $location->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $name = new Input('name');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $content = new Input('content');
        $content->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($location);
        $inputFilter->add($name);
        $inputFilter->add($content);

        return $inputFilter;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
