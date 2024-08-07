<?php
namespace Gear\Integration\Suite\Mvc\MvcSuite;

use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuiteFactory;

trait MvcSuiteTrait
{
    protected $mvcSuite;

    /**
     * Get Mvc Suite
     *
     * @return Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite
     */
    public function getMvcSuite()
    {
        if (!isset($this->mvcSuite)) {
            $name = 'Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite';
            $this->mvcSuite = $this->getServiceLocator()->get($name);
        }
        return $this->mvcSuite;
    }

    /**
     * Set Mvc Suite
     *
     * @param MvcSuite $mvcSuite Mvc Suite
     *
     * @return \Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite
     */
    public function setMvcSuite(
        MvcSuite $mvcSuite
    ) {
        $this->mvcSuite = $mvcSuite;
        return $this;
    }
}
