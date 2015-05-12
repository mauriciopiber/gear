<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Validator;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;

class Src extends AbstractHydrator
{
    protected $type;

    protected $name;

    protected $abstract;

    protected $extends;

    protected $db;

    protected $dependency = array();

    protected $namespace;

    public function __construct($data)
    {

        if (isset($data['db'***REMOVED***) && $data['db'***REMOVED*** != '' && !is_array($data['db'***REMOVED***)) {
            $db = new \Gear\ValueObject\Db(array('table' => $data['db'***REMOVED***,'columns' => (isset($data['columns'***REMOVED***) ? $data['columns'***REMOVED*** : null)));

            $this->db = $db;
        }
        unset($data['db'***REMOVED***);
        unset($data['columns'***REMOVED***);

        parent::__construct($data);

    }

    public function export()
    {
        if ($this->getDb() instanceof \Gear\ValueObject\Db) {
            $db = $this->getDb()->getTable();
        } elseif ($this->getDb() != '' && strlen($this->getDb())>3) {

            $db = $this->getDb();
        } else {
            $db = null;
        }


        return array(
            'name' => $this->getName(),
            'type' => $this->getType(),
            'dependency' => $this->getDependency(),
            'db' => $db,
            'namespace' => $this->getNamespace()
        );
    }

    public function getInputFilter()
    {

        $inputFilter = new InputFilter();


        return $inputFilter;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setDependency($dependency = null)
    {
        if (is_array($dependency)) {
            $this->dependency = $dependency;
        } elseif (strlen($dependency) > 1) {
            $this->dependency = explode(',', $dependency);
        } else {
            $this->dependency = [***REMOVED***;
        }
        return $this;
    }

    public function getDependency()
    {
        return $this->dependency;
    }

    public function hasDependency()
    {
        return (count($this->dependency) > 0) ? true : false;
    }

    public function setType($type)
    {
        $this->type = $type;

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

    public function getExtends()
    {
        return $this->extends;
    }

    public function setExtends($extends)
    {
        $this->extends = $extends;

        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }

    public function getAbstract()
    {
        return $this->abstract;
    }

    public function setAbstract($abstract)
    {
        $this->abstract = (bool) $abstract;
        return $this;
    }

    public function getNamespace() {
        return $this->namespace;
    }

    public function setNamespace($namespace) {
        $this->namespace = $namespace;
        return $this;
    }

}
