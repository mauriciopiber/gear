<?php
namespace Gear\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;

class Project
{

    protected $folder;

    protected $name;

    protected $host;

    protected $git;

    public function __construct($name, $host = null, $git = null)
    {
        $this->setName($name);
        $this->setHost($host);
        $this->setGit($git);
        $this->setFolder();
    }

    public function getFolder()
    {
        return $this->folder;
    }

    public static function getStaticFolder()
    {

        $folder = realpath(__DIR__ . '/../../../../../');
        if (is_dir($folder . '/module')) {
            $projectBase = realpath($folder);
            return $projectBase;
        }
        $folder = realpath(__DIR__ . '/../../../../../../../');
        if (is_dir($folder . '/module')) {
            $projectBase = realpath($folder);
            return $projectBase;
        }


        return null;
    }

    /**
     * O projeto deve estar contido por padrão em uma pasta irmã da pasta do projeto atual, para funcionar corretamente.
     *
     * @param string $folder
     * @return \Gear\ValueObject\Project
     */
    public function setFolder($folder = null)
    {
        if (! $folder) {
            $folder = realpath(__DIR__ . '/../../../../../');
            if (is_dir($folder . '/module')) {
                $projectBase = realpath($folder . '/../');
                $this->folder = $projectBase;
                return $this;
            }
            $folder = realpath(__DIR__ . '/../../../../../../../');
            if (is_dir($folder . '/module')) {
                $projectBase = realpath($folder . '/../');
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

    public function getGit()
    {
        return $this->git;
    }

    public function setGit($git)
    {
        $this->git = $git;
        return $this;
    }
}
