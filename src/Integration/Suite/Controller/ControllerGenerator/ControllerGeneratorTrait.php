<?php
namespace Gear\Integration\Suite\Controller\ControllerGenerator;

use Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGeneratorFactory;

trait ControllerGeneratorTrait
{
    protected $controllerGenerator;

    /**
     * Get Controller Generator
     *
     * @return Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator
     */
    public function getControllerGenerator()
    {
        if (!isset($this->controllerGenerator)) {
            $name = 'Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator';
            $this->controllerGenerator = $this->getServiceLocator()->get($name);
        }
        return $this->controllerGenerator;
    }

    /**
     * Set Controller Generator
     *
     * @param ControllerGenerator $controllerGenerator Controller Generator
     *
     * @return \Gear\Integration\Suite\Controller\ControllerGenerator\ControllerGenerator
     */
    public function setControllerGenerator(
        ControllerGenerator $controllerGenerator
    ) {
        $this->controllerGenerator = $controllerGenerator;
        return $this;
    }
}
