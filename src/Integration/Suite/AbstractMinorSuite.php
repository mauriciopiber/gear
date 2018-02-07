<?php
namespace Gear\Integration\Suite;

use Gear\Integration\Suite\MinorSuiteInterface;

abstract class AbstractMinorSuite extends AbstractSuite implements MinorSuiteInterface
{
    protected $majorSuite;

    protected $locationKey;

    protected $migrationFile;

    protected $gearFile;

    protected $longName = false;

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

    public function isUsingLongName()
    {
        return $this->longName;
    }

    public function getMajorSuite()
    {
        return $this->majorSuite;
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


    public function getMigrationFile()
    {
        return $this->migrationFile;
    }

    public function setMigrationFile($migrationFile)
    {
        $this->migrationFile = $migrationFile;
        return $this;
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
