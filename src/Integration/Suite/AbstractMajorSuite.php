<?php
namespace Gear\Integration\Suite;

abstract class AbstractMajorSuite extends AbstractSuite
{
    protected $minorSuites;

    protected $locationKey;

    public function getMinorSuites()
    {
        return $this->minorSuites;
    }

    public function getLocationKey()
    {
        if (!isset($this->locationKey)) {
            $this->locationKey = $this->getSuite();

            if ($this->getSuite() !== $this->getSuperType()) {
                $this->locationKey .= '/'.$this->getSuperType();
            }
        }
        return $this->locationKey;
    }

    abstract public function getSuite();
}
