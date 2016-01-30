<?php
namespace Gear\Mvc;

use Gear\Service\AbstractJsonService;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class ViewService extends AbstractJsonService
{
    protected $fileLocation;

    protected $fileName;

    protected $viewFolder;

    protected $target;

    public function getInputFilter()
    {
        $name = new Input('target');
        $name->getValidatorChain()
        ->addValidator(new \Zend\Validator\NotEmpty());

        $inputFilter = new InputFilter();
        $inputFilter->add($name);


        return $inputFilter;
    }


    public function getFileName()
    {
        if (!isset($this->fileName)) {

            $target   = $this->getTarget();
            $targets  = explode('/', $target);
            $fileName = end($targets);

            $this->fileName = $fileName;
        }
        return $this->fileName;
    }

    public function getFileLocation()
    {
        if (!isset($this->fileLocation)) {

            $location = $this->getTarget();
            $locations = explode('/', $location);

            array_pop($locations);

            $location = $this->getViewFolder().'/'.implode('/', $locations);

            $this->fileLocation = $location;

        }
        return $this->fileLocation;
    }

    public function prepare($data)
    {

        $this->target = $data['target'***REMOVED***;

        $this->setViewFolder($this->getModule()->getViewFolder());

        $location = $this->getTarget();
        $locations = explode('/', $location);

        array_pop($locations);

        $deep = count($locations);

        $lastFolder = $this->getViewFolder();

        for ($i = count($locations); $i > 0; $i--) {
            $lastFolder = $lastFolder.'/'.$locations[$i-1***REMOVED***;
        }

        //var_dump($locations);

        return $this;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function setTarget($dir)
    {
        $this->target = $dir;
        return $this;
    }

    public function getViewFolder()
    {
        return $this->viewFolder;
    }

    public function setViewFolder($mainFolder)
    {
        $this->viewFolder = $mainFolder;
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
}
