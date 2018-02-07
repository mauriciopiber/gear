<?php
namespace Gear\Util\Vector;

use Gear\Util\Vector\ArrayService;

trait ArrayServiceTrait
{
    protected $arrayService;

    public function getArrayService()
    {
        if (!isset($this->arrayService)) {
            $serviceName = 'Gear\Util\Vector\ArrayService';
            $this->arrayService = $this->getServiceLocator()->get($serviceName);
        }
        return $this->arrayService;
    }

    public function setArrayService(
        ArrayService $arrayService
    ) {
        $this->arrayService = $arrayService;
        return $this;
    }
}
