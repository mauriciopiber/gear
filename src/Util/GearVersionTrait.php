<?php
namespace Gear\Util;

trait GearVersionTrait
{
    public $gearVersion;

    public function getGearVersion()
    {

        return $this->gearVersion;
    }

    public function setGearVersion($version)
    {
        $this->gearVersion = $version;
        return $this;
    }
}
