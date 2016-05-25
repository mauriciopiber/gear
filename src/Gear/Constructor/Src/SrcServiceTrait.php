<?php
namespace Gear\Constructor\Src;

use Gear\Constructor\Src\SrcService;

trait SrcServiceTrait
{
    protected $srcConstructor;

    public function setSrcConstructor(SrcService $srcConstructor)
    {
        $this->srcConstructor = $srcConstructor;
        return $this;
    }

    public function getSrcConstructor()
    {
        if (!isset($this->srcConstructor)) {
            $this->srcConstructor = $this->getConstructorLocator()->get('Gear\Module\Constructor\Src');
        }
        return $this->srcConstructor;
    }
}
