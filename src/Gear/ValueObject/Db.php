<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class Db extends AbstractHydrator
{

    protected $table;

    public function extract()
    {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }

    public function hydrate(array $data)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }

    public function getTable()
    {
        return $this->table;
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
}
