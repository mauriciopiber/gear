<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Db\Metadata\Metadata;
use Gear\Service\AbstractService;
use Gear\Table\TableService\Table;
use Gear\Table\TableService\TableTrait;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\ColumnServiceTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Creator\AppDependencyTrait;
use Gear\Util\Yaml\YamlServiceTrait;
use GearJson\Db\Db;

abstract class AbstractJsonService extends AbstractService implements EventManagerAwareInterface
{
    use YamlServiceTrait;
    //use ColumnServiceTrait;
    use TableTrait;
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
