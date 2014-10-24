<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractValueObject;
use Zend\Stdlib\Hydrator\ClassMethods;

class DbColumn extends AbstractValueObject
{
    protected $name;

    protected $db;
}