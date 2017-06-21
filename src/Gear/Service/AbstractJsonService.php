<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Column\Int\PrimaryKey;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Creator\AppDependencyTrait;
use Gear\Util\Yaml\YamlServiceTrait;
use GearJson\Db\Db;
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
use Gear\Creator\Template\TemplateServiceTrait;
use Gear\Module\ModuleAwareTrait;
use GearBase\RequestTrait;

abstract class AbstractJsonService implements
    ServiceLocatorAwareInterface,
    FileServiceAwareInterface,
    StringServiceAwareInterface,
    DirServiceAwareInterface,
    ArrayServiceAwareInterface,
    ModuleAwareInterface,
    EventManagerAwareInterface
{
    use RequestTrait;

    use ModuleAwareTrait;

    use ServiceLocatorAwareTrait;

    use ArrayServiceTrait;

    use StringServiceTrait;

    use DirServiceTrait;

    use FileServiceTrait;

    use TemplateServiceTrait;

    protected $adapter;

    protected $options;

    use YamlServiceTrait;
    //use ColumnServiceTrait;
    use TableServiceTrait;
    use EventManagerAwareTrait;
    use FileCreatorTrait;
    use MetadataTrait;

    protected $module;

    protected $useImageService;

    protected $className;

    protected $name;

    protected $tableName;

    protected $tableColumns;

    protected $tableData;

    //aqui pra cima é antigo
    protected $file;

    protected $src;

    protected $db;

    protected $controller;

    protected $action;

    protected $validColumns;
    protected $usePrimaryKey;
    protected $baseArray;
    protected $primaryKey;

    protected $columnStack;

    protected $columnDuplicated;


    public function getAdapter()
    {
        return $this->adapter;
    }

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }


    public function setBaseDir($dir)
    {
        $this->dir = $dir;
        return $this;
    }

    public function getBaseDir()
    {
        if (empty($this->dir)) {
            $this->dir = \GearBase\Module::getProjectFolder();
        }
        return $this->dir;
    }
}
