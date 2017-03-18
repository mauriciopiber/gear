<?php
namespace Gear\Database\Connector\PhinxConnector;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Update;
use Phinx\Db\Table;

class PhinxConnector
{
    public function __construct()
    {
        $global = require \GearBase\Module::getProjectFolder().'/config/autoload/global.php';
        $local  = require \GearBase\Module::getProjectFolder().'/config/autoload/local.php';
        $config = array_merge($global['phinx'***REMOVED***, $local['phinx'***REMOVED***);

        $adapter = new \Phinx\Db\Adapter\MysqlAdapter($config);

        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function getTable($name)
    {
        $table = new Table(
            $name,
            array(),
            $this->adapter
        );

        $this->disconnect();

        return $table;
    }

    public function disconnect()
    {
        return $this->adapter->disconnect();
    }
}