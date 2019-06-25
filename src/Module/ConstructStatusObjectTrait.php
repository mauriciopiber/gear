<?php
namespace Gear\Module;

use Gear\Module\ConstructStatusObject;

trait ConstructStatusObjectTrait
{
    protected $constructStatusObject;

    public function getConstructStatusObject()
    {
        return $this->constructStatusObject;
    }

    public function setConstructStatusObject(
        ConstructStatusObject $constructStatusObject
    ) {
        $this->constructStatusObject = $constructStatusObject;
        return $this;
    }
}
