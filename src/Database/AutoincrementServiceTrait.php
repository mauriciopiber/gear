<?php
namespace Gear\Database;

trait AutoincrementServiceTrait
{
    protected $autoincrementService;

    public function setAutoincrementService($autoincrementService)
    {
        $this->autoincrementService = $autoincrementService;
    }

    public function getAutoincrementService()
    {
        return $this->autoincrementService;
    }
}
