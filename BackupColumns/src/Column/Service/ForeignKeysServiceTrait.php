<?php
namespace Column\Service;

use Column\Service\ForeignKeysService;

trait ForeignKeysServiceTrait
{
    protected $foreignKeysService;

    public function getForeignKeysService()
    {
        if (!isset($this->foreignKeysService)) {
            $serviceName = 'Column\Service\ForeignKeysService';
            $this->foreignKeysService = $this->getServiceLocator()->get($serviceName);
        }
        return $this->foreignKeysService;
    }

    public function setForeignKeysService(ForeignKeysService $foreignKeysService)
    {
        $this->foreignKeysService = $foreignKeysService;
        return $this;
    }
}
