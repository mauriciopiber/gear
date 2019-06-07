<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite;

use Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuiteFactory;

trait ControllerMvcSuiteTrait
{
    protected $controllerMvcSuite;

    /**
     * Get Controller Mvc Suite
     *
     * @return Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite
     */
    public function getControllerMvcSuite()
    {
        return $this->controllerMvcSuite;
    }

    /**
     * Set Controller Mvc Suite
     *
     * @param ControllerMvcSuite $controllerMvcSuite Controller Mvc Suite
     *
     * @return \Gear\Integration\Suite\ControllerMvc\ControllerMvcSuite\ControllerMvcSuite
     */
    public function setControllerMvcSuite(
        ControllerMvcSuite $controllerMvcSuite
    ) {
        $this->controllerMvcSuite = $controllerMvcSuite;
        return $this;
    }
}
