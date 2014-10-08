<?php
namespace Gear\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;

class Project
{
    protected $folder;

    protected $name;

    public function getFolder()
    {
        return $this->folder;
    }

    public function setFolder($folder)
    {
        $this->folder = $folder;
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
}
