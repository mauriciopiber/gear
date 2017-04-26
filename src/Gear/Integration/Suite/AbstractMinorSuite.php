<?php
namespace Gear\Integration\Suite;

abstract class AbstractMinorSuite extends AbstractSuite
{

    protected $majorSuite;

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

    public function getMajorSuite()
    {
        return $this->majorSuite;
    }
}
