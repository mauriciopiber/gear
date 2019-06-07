<?php
namespace Gear\Integration\Suite\Src\SrcSuite;

use Gear\Integration\Suite\Src\SrcSuite\SrcSuiteFactory;

trait SrcSuiteTrait
{
    protected $srcSuite;

    /**
     * Get Src Suite
     *
     * @return Gear\Integration\Suite\Src\SrcSuite\SrcSuite
     */
    public function getSrcSuite()
    {
        return $this->srcSuite;
    }

    /**
     * Set Src Suite
     *
     * @param SrcSuite $srcSuite Src Suite
     *
     * @return \Gear\Integration\Suite\Src\SrcSuite\SrcSuite
     */
    public function setSrcSuite(
        SrcSuite $srcSuite
    ) {
        $this->srcSuite = $srcSuite;
        return $this;
    }
}
