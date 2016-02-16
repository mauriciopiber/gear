<?php
namespace Gear\Constructor\Db;

use Gear\Constructor\Db\DbService;

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
            $this->dbService = $this->getServiceLocator()->get('Gear\Module\Constructor\Db');
        }
        return $this->dbService;
    }
}
