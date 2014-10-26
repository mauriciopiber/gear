<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

class DbColumn
{
    protected $name;

    protected $db;


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
}