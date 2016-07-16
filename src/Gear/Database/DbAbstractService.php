<?php
namespace Gear\Database;

use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use GearBase\Util\File\FileServiceTrait;
use GearBase\Util\File\FileServiceAwareInterface;
use GearBase\Util\Dir\DirServiceTrait;
use GearBase\Util\Dir\DirServiceAwareInterface;
use GearBase\Util\String\StringServiceAwareInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Util\Vector\ArrayServiceAwareInterface;
use Gear\Module\ModuleAwareInterface;
use Gear\Module\ModuleAwareTrait;
use GearBase\RequestTrait;
use Gear\Table\Metadata\MetadataTrait;

abstract class DbAbstractService implements
    ServiceLocatorAwareInterface,
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ArrayServiceAwareInterface,
    ModuleAwareInterface
{
    use MetadataTrait;

    use RequestTrait;

    use ModuleAwareTrait;

    use ServiceLocatorAwareTrait;

    use ArrayServiceTrait;

    use StringServiceTrait;

    use DirServiceTrait;

    use FileServiceTrait;

    protected $schema;

    public function getProjectFolder()
    {
        $module = $this->getModule()->getMainFolder();

        if (empty($module)) {
            return \GearBase\Module::getProjectFolder();
        }
        return $module;
    }

    public function getSchema()
    {
        if (!isset($this->schema)) {
            $global = require $this->getProjectFolder().'/config/autoload/global.php';

            $global = array_merge(array('default_migration_table' => 'migrations'), $global);

            $local  = require $this->getProjectFolder().'/config/autoload/local.php';

            $schema = new \Zend\Db\Metadata\Metadata(
                new \Zend\Db\Adapter\Adapter(array_merge($global['db'***REMOVED***, $local['db'***REMOVED***))
            );

            $this->schema = $schema;
        }

        return $this->schema;
    }

    public function getAdapter()
    {
        $global = require $this->getProjectFolder().'/config/autoload/global.php';
        $local  = require $this->getProjectFolder().'/config/autoload/local.php';
        $config = array_merge($global['phinx'***REMOVED***, $local['phinx'***REMOVED***);

        if ($global['db'***REMOVED***['driver'***REMOVED*** == 'Pdo_Sqlite') {
            return new \Phinx\Db\Adapter\SQLiteAdapter($config);
        } elseif ($global['db'***REMOVED***['driver'***REMOVED*** == 'Pdo') {
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
