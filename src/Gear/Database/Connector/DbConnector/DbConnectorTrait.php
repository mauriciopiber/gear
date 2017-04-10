<?php
namespace Gear\Database\Connector\DbConnector;

use Gear\Database\Connector\DbConnector;

trait DbConnectorTrait
{
    protected $dbConnector;

    public function getDbConnector()
    {
        if (!isset($this->dbConnector)) {
            $name = 'Gear\Database\DbConnector';
            $this->dbConnector = $this->getServiceLocator()->get($name);
        }
        return $this->dbConnector;
    }

    public function setDbConnector(
        DbConnector $dbConnector
    ) {
            $this->dbConnector = $dbConnector;
            return $this;
    }
}
