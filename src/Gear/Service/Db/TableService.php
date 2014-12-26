<?php
namespace Gear\Service\Db;

use Gear\Service\AbstractJsonService;
use Zend\Console\ColorInterface;

class TableService extends AbstractJsonService
{
    public function createColumn($table, $column, $type, $limit = null, $null = true)
    {

        $global = require \Gear\Service\ProjectService::getProjectFolder().'/config/autoload/global.php';
        $local  = require \Gear\Service\ProjectService::getProjectFolder().'/config/autoload/local.php';

        $tableObject = new \Phinx\Db\Table(
            $table,
            array(),
            new \Phinx\Db\Adapter\MysqlAdapter(
                array_merge($global['phinx'***REMOVED***, $local['phinx'***REMOVED***)
            )
        );
        $tableObject->addColumn($column, $type, array('limit' => $limit, 'null' => $null));
        $tableObject->update();

        echo 'createcolumn'."\n";

    }

}
