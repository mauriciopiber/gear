<?php
namespace ModuleUnit\Free\MyClass;

use ModuleUnit\Free\MyClass\UnitSrcName;

trait UnitSrcNameTrait
{
    /** @var \ModuleUnit\Free\MyClass\UnitSrcName */
    protected $unitSrcName;

    public function setUnitSrcName(UnitSrcName $unitSrcName)
    {
        $this->unitSrcName = $this->unitSrcName;
        return $this;
    }

    public function getUnitSrcName()
    {
        if(!isset($this->unitSrcName)) {
            $this->unitSrcName = new UnitSrcName();
        }
        return $this->unitSrcName;
    }
}
