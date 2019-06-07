<?php
namespace Gear\Database\Connector\DbConnector;

use Gear\Database\Connector\DbConnector;

trait DbConnectorTrait
{
    protected $dbConnector;

    public function getDbConnector()
    {
        return $this->dbConnector;
    }

    public function setDbConnector(
        DbConnector $dbConnector
    ) {
            $this->dbConnector = $dbConnector;
            return $this;
    }
}
