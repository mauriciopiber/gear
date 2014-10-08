<?php
namespace Gear\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;

class Project
{

    protected $folder;

    protected $name;

    protected $host;

    public function __construct($name, $host)
    {
    	$this->setName($name);
    	$this->setHost($host);
    	$this->setFolder();
    }

    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * O projeto deve estar contido por padrão em uma pasta irmã da pasta do projeto atual, para funcionar corretamente.
     * @param string $folder
     * @return \Gear\ValueObject\Project
     */
    public function setFolder($folder = null)
    {
        if (!$folder) {
            $folder = realpath(__DIR__.'/../../../../../');
            if(is_dir($folder.'/module')) {
                $projectBase = realpath($folder.'/../');
                $this->folder = $projectBase;
                return $this;
            }
            $folder = realpath(__DIR__.'/../../../../../../../');
            if(is_dir($folder.'/module')) {
                $projectBase = realpath($folder.'/../');
                $this->folder = $projectBase;
                return $this;
            }
        }

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

    public function getHost()
    {
        return $this->host;
    }

    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }
}
