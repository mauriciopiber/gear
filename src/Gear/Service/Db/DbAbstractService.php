<?php
namespace Gear\Service\Db;

use Gear\Service\AbstractJsonService;
use Zend\Console\ColorInterface;

abstract class DbAbstractService extends AbstractJsonService
{

    public function getAdapter()
    {
        $global = require \Gear\Service\ProjectService::getProjectFolder().'/config/autoload/global.php';
        $local  = require \Gear\Service\ProjectService::getProjectFolder().'/config/autoload/local.php';
        $config = array_merge($global['phinx'***REMOVED***, $local['phinx'***REMOVED***);

        if ($global['db'***REMOVED***['driver'***REMOVED*** == 'Pdo_Sqlite') {
            return new \Phinx\Db\Adapter\SQLiteAdapter($config);
        } elseif($global['db'***REMOVED***['driver'***REMOVED*** == 'Pdo') {
            return new \Phinx\Db\Adapter\MysqlAdapter($config);
        }


        return null;


    }

    public function table($name)
    {


        $adapter = $this->getAdapter();

        if ($adapter === null) {
            throw new \Gear\Exception\DbAdapterNotFoundException();
        }



        return new \Phinx\Db\Table(
            $name,
            array(),
            $this->getAdapter()
        );

    }

}
