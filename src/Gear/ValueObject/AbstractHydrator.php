<?php
namespace Gear\ValueObject;

use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractHydrator
{

    public function __construct($data = array())
    {
        if (is_array($data)) {
            $this->hydrate($data);
        }
    }

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
