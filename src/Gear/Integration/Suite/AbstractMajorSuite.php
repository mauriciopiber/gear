<?php
namespace Gear\Integration\Suite;

abstract class AbstractMajorSuite extends AbstractSuite
{
    protected $minorSuites;

    public function getMinorSuites()
    {
        return $this->minorSuites;
    }
}
