<?php
namespace Gear\Integration\Component\GearFile;

use Gear\Integration\Component\GearFile\GearFileFactory;

trait GearFileTrait
{
    protected $gearFile;

    /**
     * Get Gear File
     *
     * @return Gear\Integration\Component\GearFile\GearFile
     */
    public function getGearFile()
    {
        return $this->gearFile;
    }

    /**
     * Set Gear File
     *
     * @param GearFile $gearFile Gear File
     *
     * @return \Gear\Integration\Component\GearFile\GearFile
     */
    public function setGearFile(
        GearFile $gearFile
    ) {
        $this->gearFile = $gearFile;
        return $this;
    }
}
