<?php
namespace Gear\Database\Connector\DbConnector;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Update;

class DbConnector
{
    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
    public function beginTransaction()
    {
        $this->adapter->getDriver()->getConnection()->beginTransaction();
    }

    public function commit()
    {
        $this->adapter->getDriver()->getConnection()->commit();

    }

    public function rollback()
    {
        $this->adapter->getDriver()->getConnection()->rollback();

    }
    */

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function disconnect()
    {
        return $this->adapter->getDriver()->getConnection()->disconnect();
    }

    public function query($sql)
    {
        $data = $this->adapter->query($sql)->execute();
        return $data;
    }

    public function select(Select $select)
    {
        $sql = $select->getSqlString($this->adapter->getPlatform());

        $data = $this->query($sql);

        $this->disconnect();

        return $data;
    }

    public function update(Update $update)
    {
        $sql = $update->getSqlString($this->adapter->getPlatform());

        $data = $this->adapter->query($sql)->execute();

        $this->disconnect();

        return $data;
    }
}