<?php
namespace Gear\Util;

trait GearVersionTrait
{
    public $gearVersion;

    public function getGearVersion()
    {
        if (!isset($this->gearVersion)) {
            $moduleGear = new \Gear\Module();

            $config = $moduleGear->getConfig();
            $this->gearVersion = $config['gear'***REMOVED***['modules'***REMOVED***['gear'***REMOVED***['version'***REMOVED***;
        }

        return $this->gearVersion;
    }

    public function setGearVersion($version)
    {
        $this->gearVersion = $version;
        return $this;
    }
}
