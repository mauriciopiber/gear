<?php
namespace Gear\Integration\Suite\Src\SrcGenerator;

use Gear\Integration\Suite\Src\SrcGenerator\SrcGeneratorFactory;

trait SrcGeneratorTrait
{
    protected $srcGenerator;

    /**
     * Get Src Generator
     *
     * @return Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator
     */
    public function getSrcGenerator()
    {
        if (!isset($this->srcGenerator)) {
            $name = 'Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator';
            $this->srcGenerator = $this->getServiceLocator()->get($name);
        }
        return $this->srcGenerator;
    }

    /**
     * Set Src Generator
     *
     * @param SrcGenerator $srcGenerator Src Generator
     *
     * @return \Gear\Integration\Suite\Src\SrcGenerator\SrcGenerator
     */
    public function setSrcGenerator(
        SrcGenerator $srcGenerator
    ) {
        $this->srcGenerator = $srcGenerator;
        return $this;
    }
}
