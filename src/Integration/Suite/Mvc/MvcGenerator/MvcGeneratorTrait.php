<?php
namespace Gear\Integration\Suite\Mvc\MvcGenerator;

use Gear\Integration\Suite\Mvc\MvcGenerator\MvcGeneratorFactory;

trait MvcGeneratorTrait
{
    protected $mvcGenerator;

    /**
     * Get Mvc Generator
     *
     * @return Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator
     */
    public function getMvcGenerator()
    {
        if (!isset($this->mvcGenerator)) {
            $name = 'Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator';
            $this->mvcGenerator = $this->getServiceLocator()->get($name);
        }
        return $this->mvcGenerator;
    }

    /**
     * Set Mvc Generator
     *
     * @param MvcGenerator $mvcGenerator Mvc Generator
     *
     * @return \Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator
     */
    public function setMvcGenerator(
        MvcGenerator $mvcGenerator
    ) {
        $this->mvcGenerator = $mvcGenerator;
        return $this;
    }
}
