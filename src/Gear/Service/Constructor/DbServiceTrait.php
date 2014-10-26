<?php
namespace Gear\Service\Constructor;

use Gear\Service\Constructor\DbService;

trait DbServiceTrait
{
    protected $dbService;

    public function setDbService(DbService $dbService)
    {
        $this->dbService = $dbService;
        return $this;
    }

    public function getDbService()
    {
        if (!isset($this->dbService)) {
            $this->dbService = $this->getServiceLocator()->get('dbConstructor');
        }
        return $this->dbService;
    }
}
