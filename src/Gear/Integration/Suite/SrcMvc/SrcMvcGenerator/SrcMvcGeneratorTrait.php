<?php
namespace Gear\Integration\Suite\SrcMvc\SrcMvcGenerator;

use Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGeneratorFactory;

trait SrcMvcGeneratorTrait
{
    protected $srcMvcGenerator;

    /**
     * Get Src Mvc Generator
     *
     * @return Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator
     */
    public function getSrcMvcGenerator()
    {
        if (!isset($this->srcMvcGenerator)) {
            $name = 'Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator';
            $this->srcMvcGenerator = $this->getServiceLocator()->get($name);
        }
        return $this->srcMvcGenerator;
    }

    /**
     * Set Src Mvc Generator
     *
     * @param SrcMvcGenerator $srcMvcGenerator Src Mvc Generator
     *
     * @return \Gear\Integration\Suite\SrcMvc\SrcMvcGenerator\SrcMvcGenerator
     */
    public function setSrcMvcGenerator(
        SrcMvcGenerator $srcMvcGenerator
    ) {
        $this->srcMvcGenerator = $srcMvcGenerator;
        return $this;
    }
}
