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
        if (!isset($this->dbConstructor)) {
            $this->dbConstructor = $this->getServiceLocator()->get('Gear\Module\Constructor\Db');
        }
        return $this->dbConstructor;
    }
}
