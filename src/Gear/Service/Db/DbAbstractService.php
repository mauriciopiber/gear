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

        return new \Phinx\Db\Adapter\MysqlAdapter(
            array_merge($global['phinx'***REMOVED***, $local['phinx'***REMOVED***)
        );
    }

    public function table($name)
    {

        return new \Phinx\Db\Table(
            $name,
            array(),
            $this->getAdapter()
        );

    }

}
