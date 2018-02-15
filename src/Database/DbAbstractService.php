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
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use GearBase\RequestTrait;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Database\Connector\DbConnector\DbConnectorTrait;

abstract class DbAbstractService implements
    ServiceLocatorAwareInterface,
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ArrayServiceAwareInterface,
    ModuleStructureInterface
{
    use DbConnectorTrait;

    use MetadataTrait;

    use RequestTrait;

    use ModuleStructureTrait;

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
            /**
            $global = require $this->getProjectFolder().'/config/autoload/global.php';

            $global = array_merge(array('default_migration_table' => 'migrations'), $global);

            $local  = require $this->getProjectFolder().'/config/autoload/local.php';
            */
            $this->schema = new \Zend\Db\Metadata\Metadata($this->getDbConnector()->getAdapter());
        }

        return $this->schema;
    }
}
