<?php
namespace Gear\Service\Constructor;

use Gear\Service\Constructor\SrcService;

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
            $this->srcService = $this->getServiceLocator()->get('srcConstructor');
        }
        return $this->srcService;
    }
}
