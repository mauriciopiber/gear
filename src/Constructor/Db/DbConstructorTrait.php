<?php
namespace Gear\Constructor\Db;

use Gear\Constructor\Db\DbConstructor;

trait DbConstructorTrait
{
    protected $dbConstructor;

    public function setDbConstructor(DbConstructor $dbConstructor)
    {
        $this->dbConstructor = $dbConstructor;
        return $this;
    }

    public function getDbConstructor()
    {
        return $this->dbConstructor;
    }
}
