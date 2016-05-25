<?php
namespace Gear\Constructor\Db;

use Gear\Constructor\Db\DbService;

trait DbServiceTrait
{
    protected $dbConstructor;

    public function setDbConstructor(DbService $dbConstructor)
    {
        $this->dbConstructor = $dbConstructor;
        return $this;
    }

    public function getDbConstructor()
    {
        if (!isset($this->dbConstructor)) {
            $this->dbConstructor = $this->getConstructorLocator()->get('Gear\Module\Constructor\Db');
        }
        return $this->dbConstructor;
    }
}
