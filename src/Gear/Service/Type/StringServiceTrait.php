<?php
namespace Gear\Service\Type;

use Gear\Service\Type\StringService;

trait StringServiceTrait {

    protected $stringService;

    public function getStringService()
    {
        if (!isset($this->stringService)) {
            $this->stringService = $this->getServiceLocator()->get('stringService');
        }
        return $this->stringService;
    }

    public function setStringService(StringService $stringService)
    {
        $this->stringService = $stringService;
        return $this;
    }
}
