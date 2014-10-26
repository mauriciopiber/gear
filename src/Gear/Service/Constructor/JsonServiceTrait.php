<?php
namespace Gear\Service\Constructor;

use Gear\Service\Constructor\JsonService;

trait JsonServiceTrait
{

    protected $jsonService;

    public function setJsonService(JsonService $jsonService)
    {
        $this->jsonService = $jsonService;
        return $this;
    }

    public function getJsonService()
    {
        if (!isset($this->jsonService)) {
            $this->jsonService = $this->getServiceLocator()->get('jsonService');
        }
        return $this->jsonService;
    }
}
