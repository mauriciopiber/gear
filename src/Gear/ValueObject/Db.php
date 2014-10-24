<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractValueObject;
use Zend\Stdlib\Hydrator\ClassMethods;

class Db extends AbstractValueObject
{
    protected $name;

    protected $columns;
}