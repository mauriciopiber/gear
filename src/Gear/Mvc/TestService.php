<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class TestService extends AbstractJsonService
{

    protected $fileLocation;

    protected $fileName;

    protected $testFolder;

    protected $suite;

    protected $target;

    protected $namespace;

    public function getInputFilter()
    {
        $name = new Input('target');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $name = new Input('suite');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty())
        ->addValidator(new \Zend\Validator\InArray(array('haystack' => array('acceptance', 'functional', 'unit'))));

        $inputFilter = new InputFilter();
        $inputFilter->add($name);

        return $inputFilter;
    }


    public function prepare($data)
    {
        $this->suite = $data['suite'***REMOVED***;
        $this->target = $data['target'***REMOVED***;

        $this->setTestFolder($this->getModule()->getTestFolder());

        return $this;
    }

    public function getFileNameToClass()
    {
        return str_replace('.php', '', $this->getFileName());
    }


    public function getNamespace()
    {

        if (!isset($this->namespace)) {
            $target   = $this->getTarget();
            $targets  = explode('/', $target);
            end($targets);
            $key = key($targets);
            unset($targets[$key***REMOVED***);

            if (!empty($targets)) {
                $this->namespace = '\\'.implode('\\', $targets);
            }

        }


        return $this->namespace;
    }


    public function getFileName()
    {
        if (!isset($this->fileName)) {

            $target   = $this->getTarget();
            $targets  = explode('/', $target);
            $fileName = end($targets);
            $this->setFileName($fileName);

        }
        return $this->fileName;
    }

    public function getFileLocation()
    {
        if (!isset($this->fileLocation)) {

            $location = $this->getTarget();
            $locations = explode('/', $location);

            array_pop($locations);

            $location = $this->getTestFolder().'/'.$this->getSuite().'/'.implode('/', $locations);

            //var_dump($location);
            $this->setFileLocation($location);


        }
        return $this->fileLocation;
    }


    public function getSuite()
    {
        return $this->suite;
    }

    public function setSuite($suite)
    {
        $this->suite = $suite;
        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    public function setFileLocation($fileLocation)
    {
        $this->fileLocation = $fileLocation;
        return $this;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getTestFolder()
    {
        return $this->testFolder;
    }

    public function setTestFolder($testFolder)
    {
        $this->testFolder = $testFolder;
        return $this;
    }
}
