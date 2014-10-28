<?php
namespace Gear\ValueObject;

class Module
{

    protected $name;

    protected $structure;

    public function __construct($moduleName)
    {
        $this->setName($moduleName);
        $this->setStructure(new \Gear\ValueObject\BasicModuleStructure($this->getName()));
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

    public function getStructure()
    {
        return $this->structure;
    }

    public function setStructure($structure)
    {
        $this->structure = $structure;
        return $this;
    }
}
