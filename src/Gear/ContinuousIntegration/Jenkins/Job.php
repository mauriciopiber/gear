<?php
namespace Gear\ContinuousIntegration\Jenkins;

class Job
{
    protected $name;

    protected $path;

    protected $standard;

    protected $file;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getStandard()
    {
        return $this->standard;
    }

    public function setStandard($standard)
    {
        $this->standard = $standard;
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
}
