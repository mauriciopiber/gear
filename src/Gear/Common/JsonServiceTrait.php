<?php
namespace Gear\Common;

use Gear\Service\Constructor\JsonService;

trait JsonServiceTrait {

    protected $jsonService;

    public function getJsonService()
    {
        if (!isset($this->jsonService)) {
            $this->jsonService = $this->getServiceLocator()->get('Gear\Service\Constructor\Json');
        }
        return $this->jsonService;
    }

    public function setJsonService(JsonService $jsonService)
    {
        $this->jsonService = $jsonService;
        return $this;
    }
}
