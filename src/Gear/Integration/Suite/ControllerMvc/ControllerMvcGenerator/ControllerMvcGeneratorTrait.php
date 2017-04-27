<?php
namespace Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator;

use Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGeneratorFactory;

trait ControllerMvcGeneratorTrait
{
    protected $controllerMvcGenerator;

    /**
     * Get Controller Mvc Generator
     *
     * @return Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator
     */
    public function getControllerMvcGenerator()
    {
        if (!isset($this->controllerMvcGenerator)) {
            $name = 'Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator';
            $this->controllerMvcGenerator = $this->getServiceLocator()->get($name);
        }
        return $this->controllerMvcGenerator;
    }

    /**
     * Set Controller Mvc Generator
     *
     * @param ControllerMvcGenerator $controllerMvc Controller Mvc Generator
     *
     * @return \Gear\Integration\Suite\ControllerMvc\ControllerMvcGenerator\ControllerMvcGenerator
     */
    public function setControllerMvcGenerator(
        ControllerMvcGenerator $controllerMvc
    ) {
        $this->controllerMvcGenerator = $controllerMvc;
        return $this;
    }
}
