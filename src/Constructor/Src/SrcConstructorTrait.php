<?php
namespace Gear\Constructor\Src;

use Gear\Constructor\Src\SrcConstructor;

trait SrcConstructorTrait
{
    protected $srcConstructor;

    public function setSrcConstructor(SrcConstructor $srcConstructor)
    {
        $this->srcConstructor = $srcConstructor;
        return $this;
    }

    public function getSrcConstructor()
    {
        return $this->srcConstructor;
    }
}
