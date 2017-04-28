<?php
namespace Gear\Integration\Suite;

abstract class AbstractMinorSuite extends AbstractSuite
{

    protected $majorSuite;

    protected $locationKey;

    /**
     * Constructor
     *
     * @return \Gear\Integration\Suite\Src\SrcMinorSuite
     */
    public function __construct(AbstractMajorSuite $majorSuite)
    {
        $this->majorSuite = $majorSuite;
        return $this;
    }


    public function getGearFile()
    {
        return $this->gearFile;
    }

    public function setGearFile($gearFile)
    {
        $this->gearFile = $gearFile;
        return $this;
    }

    public function getMajorSuite()
    {
        return $this->majorSuite;
    }

    public function getLocationKey()
    {
        return $this->locationKey;
    }

    public function setLocationKey($locationKey)
    {
        $this->locationKey = $locationKey;
        return $this;
    }
}
