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
use Gear\Column\Int;
use Gear\Column\ColumnServiceTrait;
use Gear\Creator\FileCreatorTrait;
use Gear\Creator\ControllerDependencyTrait;
use Gear\Creator\AppDependencyTrait;
use Gear\Creator\SrcDependencyTrait;
use Gear\Util\Yaml\YamlServiceTrait;
use GearJson\Db\Db;

abstract class AbstractJsonService extends AbstractService implements EventManagerAwareInterface
{
    use YamlServiceTrait;
    use ControllerDependencyTrait;
    use AppDependencyTrait;
    use SrcDependencyTrait;
    use ColumnServiceTrait;
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

    public function isNullable(Db $db)
    {
        if ($this->getTableService()->isNullable($db)) {
            return true;
        }

        return false;
    }

    public function isClass($columnData, $class)
    {
        return in_array(
            get_class($columnData),
            array($class)
        );
    }

    public function basicOptions()
    {
        return array(
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'moduleVar' => $this->str('var', $this->getModule()->getModuleName()),
            'class' => $this->tableName,
            'classUrl' => $this->str('url', $this->tableName),
            'classLabel' => $this->str('label', $this->tableName),
            'classVar' => $this->str('var', $this->tableName),
            'classUnderline' => $this->str('uline', $this->tableName),
            'created' => new \DateTime('now')
        );
    }

    public function loadTable(\GearJson\Db\Db $table)
    {
        $this->db           = $table;
        $this->tableName    = $this->str('class', $this->db->getTable());
        $this->metadata     = $this->getMetadata();
        $this->tableColumns = $this->metadata->getColumns($this->str('uline', $this->tableName));
        $this->primaryKey   = $this->getTableService()->getPrimaryKeyColumns($this->db->getTable());
    }

    public function getTableData()
    {
        $this->tableData = $this->getColumnService()->getColumns($this->db);
        return $this->tableData;
    }
}
