<?php
namespace Gear\Common;

use Gear\Service\Type\StringService;

trait StringServiceTrait {

    protected $stringService;

    public function getStringService()
    {
        if (!isset($this->stringService)) {
            $this->stringService = $this->getServiceLocator()->get('Gear\Service\Type\String');
        }
        return $this->stringService;
    }

    public function setStringService(StringService $stringService)
    {
        $this->stringService = $stringService;
        return $this;
    }
}
