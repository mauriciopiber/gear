<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractHydrator;

class Test extends AbstractHydrator
{

    protected $fileLocation;

    protected $fileName;

    protected $testFolder;

    protected $suite;

    protected $target;

    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function prepare($moduleName)
    {
        $module = new \Gear\ValueObject\BasicModuleStructure($moduleName);
        $module->prepare($moduleName);

        $this->setTestFolder($module->getTestFolder());

        return $this;
    }

    public function getFileNameToClass()
    {
        return str_replace('.php', '', $this->getFileName());
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
