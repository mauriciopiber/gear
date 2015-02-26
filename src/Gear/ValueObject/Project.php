<?php
namespace Gear\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Hydrator\ClassMethods;

class Project
{

    protected $folder;

    protected $project;

    protected $host;

    protected $git;

    protected $database;

    protected $username;

    protected $password;

    public function __construct($name, $host = null, $git = null)
    {
        if (is_array($name)) {
            $this->hydrate($name);
        } else {
            $this->setProject($name);
            $this->setHost($host);
            $this->setGit($git);
            $this->setFolder();
        }
    }

    public function extract()
    {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }

    public function hydrate($data)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }

    public function getFolder()
    {
        if (empty($this->folder)) {
            $this->setFolder();
        }
        return $this->folder;
    }

    public static function getStaticFolder()
    {
        $folder = realpath(__DIR__ . '/../../../../../');

        if (is_dir($folder . '/module')) {
            $projectBase = realpath($folder);
            return $projectBase;
        }
        $folder = realpath(__DIR__ . '/../../../../../../');

        if (is_dir($folder . '/vendor')) {
            $projectBase = realpath($folder);
            return $projectBase;
        }

        return null;
    }

    public static function getStaticParentFolder()
    {
        $folder = realpath(__DIR__ . '/../../../../../');

        if (is_dir($folder . '/module')) {
            $projectBase = realpath($folder . '/../');
            return $projectBase;
        }
        $folder = realpath(__DIR__ . '/../../../../../../');

        if (is_dir($folder . '/vendor')) {
            $projectBase = realpath($folder . '/../');
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
        if (empty($folder)) {
            if (! isset($this->folder)) {
                $this->folder = self::getStaticParentFolder();
            }
        } else {
            $this->folder = $folder;
        }

        return $this;
    }

    public function getProject()
    {
        return $this->name;
    }

    public function setProject($name)
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

    public function getDatabase()
    {
        return $this->database;
    }

    public function setDatabase($database)
    {
        $this->database = $database;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
