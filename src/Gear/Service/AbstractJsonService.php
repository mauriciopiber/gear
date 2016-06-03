<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Column\UniqueInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Gear\Metadata\Table;
use Gear\Table\TableServiceTrait;
use Gear\Metadata\MetadataTrait;
use Zend\Db\Metadata\Metadata;
use Gear\Metadata\TableTrait;
use Gear\Service\AbstractService;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Int\ForeignKey;
use Gear\Column\Date;
use Gear\Column\Datetime;
use Gear\Column\Time;
use Gear\Column\AbstractDateTime;
use Gear\Column\Decimal;
use Gear\Column\Int;
use Gear\Column\TinyInt;
use Gear\Column\Varchar;
use Gear\Column\Text;
use Gear\Column\Varchar\Email;
use Gear\Column\Varchar\UploadImage;
use Gear\Column\ColumnServiceTrait;
use Gear\Creator\FileCreatorTrait;
use Gear\Creator\ControllerDependencyTrait;
use Gear\Creator\AppDependencyTrait;
use Gear\Creator\SrcDependencyTrait;
use GearJson\Db\Db;
use Gear\Util\Yaml\YamlServiceTrait;

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

    protected $baseDir;

    protected $module;

    protected $jsonSchema;

    protected $gearSchema;

    protected $specialites;

    protected $useImageService;

    protected $className;

    protected $name;

    protected $tableName;

    protected $tableColumns;

    protected $tableData;

    protected $instance;


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

    public function preFixture()
    {
        $this->preFixture = '';

        foreach ($this->getTableData() as $column) {
            if (method_exists($column, 'getPreFixture')) {

                $number = rand(1, 4000545);

                $this->preFixture .= $column->getPreFixture($number);
            }
        }
    }


    public function fixtureDatabase($numberReference = 999)
    {
        $this->fixture = '';
        $dbColumns = $this->getTableData();

        foreach ($dbColumns as $i => $column) {
            if ($column instanceof \Gear\Column\Int\PrimaryKey) {
                continue;
            }
            $this->fixture .= $column->getFixture($numberReference);
        }

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

    public function loadTable($table)
    {
        if ($table instanceof \GearJson\Db\Db) {
            $name = $table->getTable();
            $this->db = $table;
        } elseif ($table instanceof \GearJson\Src\Src) {
            $name = $table->getName();
            $this->src = $table;
            $this->srcName = $name;
            $this->db = $table->getDb();
        } elseif ($table instanceof \Zend\Db\Metadata\Object\TableObject) {
            $name = $table->getName();
        }

        $metadata           = $this->getMetadata();

        $this->tableName    = $this->str('class', $name);
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));
        $this->table        = $this->getTable();

        $this->primaryKey   = $this->getTableService()->getPrimaryKeyColumns($this->db->getTable());
        //$this->primaryKey   = $this->table->getPrimaryKeyColumns();
    }

    public function getTableData()
    {
        if (isset($this->tableData)) {
            return $this->tableData;
        }

        $this->tableData = $this->getColumnService()->getColumns($this->db);
        return $this->tableData;
    }
}
