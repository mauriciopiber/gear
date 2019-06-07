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
