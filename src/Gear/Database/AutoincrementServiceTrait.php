<?php
namespace Gear\Database;

trait AutoincrementServiceTrait {

    protected $autoincrementService;

    public function setAutoincrementService($autoincrementService)
    {
        $this->autoincrementService = $autoincrementService;
    }

    public function getAutoincrementService()
    {
        if (!isset($this->autoincrementService)) {
            $this->autoincrementService = $this->getServiceLocator()->get('autoincrementService');
        }
        return $this->autoincrementService;
    }
}
