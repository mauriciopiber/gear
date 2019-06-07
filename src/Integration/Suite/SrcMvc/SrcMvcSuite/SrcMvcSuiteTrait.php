<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcSuite;

use Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuiteFactory;

trait SrcMvcSuiteTrait
{
    protected $srcMvcSuite;

    /**
     * Get Src Mvc Suite
     *
     * @return Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite
     */
    public function getSrcMvcSuite()
    {
        return $this->srcMvcSuite;
    }

    /**
     * Set Src Mvc Suite
     *
     * @param SrcMvcSuite $srcMvcSuite Src Mvc Suite
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcSuite\SrcMvcSuite
     */
    public function setSrcMvcSuite(
        SrcMvcSuite $srcMvcSuite
    ) {
        $this->srcMvcSuite = $srcMvcSuite;
        return $this;
    }
}
