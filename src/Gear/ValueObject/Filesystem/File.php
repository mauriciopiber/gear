<?php
namespace Gear\ValueObject\Filesystem;

use Gear\Common\WritableAwareInterface;

class File implements WritableAwareInterface
{
    protected $location;

    protected $name;

    protected $extension;

    protected $content;

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

    public function write()
    {

        if (! is_dir($this->getLocation()) || $this->getName() == '' || $this->getContent() == '') {
            return false;
        }

        $file = $this->getLocation() . '/' . $this->getName();
        if (is_file($file)) {
            unlink($file);
        }

        $fp = fopen($file, "a");

        $fileGenerated = $this->getContent();

        $fileGenerated = substr($fileGenerated, 0, strrpos($fileGenerated, "\n"));

        $escreve = fwrite($fp, $fileGenerated);
        fclose($fp);
        chmod($file, 0777); // changed to add the zero

        return $file;
    }
}
