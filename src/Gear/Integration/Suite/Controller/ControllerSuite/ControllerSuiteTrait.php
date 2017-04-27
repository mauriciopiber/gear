<?php
namespace Gear\Integration\Suite\Controller\ControllerSuite;

use Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuiteFactory;

trait ControllerSuiteTrait
{
    protected $controllerSuite;

    /**
     * Get Controller Suite
     *
     * @return Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite
     */
    public function getControllerSuite()
    {
        if (!isset($this->controllerSuite)) {
            $name = 'Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite';
            $this->controllerSuite = $this->getServiceLocator()->get($name);
        }
        return $this->controllerSuite;
    }

    /**
     * Set Controller Suite
     *
     * @param ControllerSuite $controllerSuite Controller Suite
     *
     * @return \Gear\Integration\Suite\Controller\ControllerSuite\ControllerSuite
     */
    public function setControllerSuite(
        ControllerSuite $controllerSuite
    ) {
        $this->controllerSuite = $controllerSuite;
        return $this;
    }
}
