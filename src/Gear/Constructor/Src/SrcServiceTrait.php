<?php
namespace Gear\Constructor\Src;

use Gear\Constructor\Src\SrcService;

trait SrcServiceTrait
{
    protected $srcService;

    public function setSrcService(SrcService $srcService)
    {
        $this->srcService = $srcService;
        return $this;
    }

    public function getSrcService()
    {
        if (!isset($this->srcService)) {
            $this->srcService = $this->getServiceLocator()->get('Gear\Module\Constructor\Src');
        }
        return $this->srcService;
    }
}
