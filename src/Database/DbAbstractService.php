<?php
namespace Gear\Database;

use Gear\Util\File\FileServiceTrait;
use Gear\Util\File\FileServiceAwareInterface;
use Gear\Util\Dir\DirServiceTrait;
use Gear\Util\Dir\DirServiceAwareInterface;
use Gear\Util\String\StringServiceAwareInterface;
use Gear\Util\String\StringServiceTrait;
use Gear\Util\Vector\ArrayServiceTrait;
use Gear\Util\Vector\ArrayServiceAwareInterface;
use Gear\Module\Structure\ModuleStructureInterface;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Database\Connector\DbConnector\DbConnectorTrait;

abstract class DbAbstractService implements
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ArrayServiceAwareInterface,
    ModuleStructureInterface
{
    use DbConnectorTrait;

    use MetadataTrait;

    use ModuleStructureTrait;


    use ArrayServiceTrait;

    use StringServiceTrait;

    use DirServiceTrait;

    use FileServiceTrait;

    protected $schema;

    protected $request;

    public function getRequest()
    {
        if (!isset($this->request)) {
            $this->request = $this->get('application')->getMvcEvent()->getRequest();
        }
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

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
