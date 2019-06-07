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
