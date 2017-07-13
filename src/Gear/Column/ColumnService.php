<?php
namespace Gear\Column;

use Gear\Exception\PrimaryKeyNotFoundException;
use Gear\Column\ColumnManager;
use Gear\Column\Int\ForeignKey;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Integer\Integer;
use Gear\Column\UniqueInterface;
use Gear\Module\ModuleAwareTrait;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Table\TableService\TableServiceTrait;
use GearBase\Util\String\StringServiceTrait;
use GearJson\Db\Db;
use Zend\Db\Metadata\Object\ColumnObject;
use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 *
 * Classe que trabalha com as colunas para exibir os valores para o Mvc.
 *
 * @category   Column
 * @package    Gear
 * @subpackage Column
 * @author     Mauricio Piber Fão <mauriciopiber@gmail.com>
 * @copyright  2014-2016 Mauricio Piber Fão
 * @license    GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @version    Release: 1.0.0
 * @link       https://bitbucket.org/mauriciopiber/gear
 */
class ColumnService
{
    use ModuleAwareTrait;
    use StringServiceTrait;
    use TableServiceTrait;

    public function __construct($module, $tableService, $stringService)
    {
        $this->module = $module;
        $this->stringService = $stringService;
        $this->tableService = $tableService;
    }

    const NAMESPACE = 'Gear\\Column';

    const BASE = '%s\\%s\\%s';

    const FOREIGN_KEY = 'ForeignKey';

    const PRIMARY_KEY = 'PrimaryKey';

    protected $columns = [***REMOVED***;


    public function excludeList()
    {
        return [
            'created',
            'updated',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'id_lixeira'
        ***REMOVED***;
    }

    public function getColumnManager(Db $db)
    {
        return new ColumnManager($this->getColumns($db), $this->getExcludedColumns($db));
    }

    public function getExcludedColumns(Db $db)
    {
        if ($db == null) {
            throw new \Exception('Missing config');
        }

        unset($this->columns);
        $this->columns = [***REMOVED***;

        $this->db =         $db;
        $this->tableName    = $this->str('class', $this->db->getTable());
        $this->tableColumns = $this->getTableService()->getColumns($this->db->getTable());
        $this->dbColumns    = $this->db->getColumns();

        //var_dump($this->tableName);
        //var_dump(count($this->tableColumns));
        $this->tablePrimaryKey = $this->getTableService()->getPrimaryKey($this->db->getTable());

        if (!$this->tablePrimaryKey) {
            throw new PrimaryKeyNotFoundException();
        }

        foreach ($this->tableColumns as $column) {
            if (in_array($column->getName(), $this->excludeList()) === false) {
                    continue;
            }

            $instance = $this->factory($column, $this->db);
            $this->columns[***REMOVED***  = $instance;
        }

        return $this->columns;
    }

    /**
     * Extrai todos Gear\Column de um GearJson\Db\Db.
     *
     * @param Db $db Mvc
     *
     * @throws \Gear\Exception\PrimaryKeyNotFoundException
     *
     * @return array
     */
    public function getColumns(Db $db = null, $all = false, array $include = [***REMOVED***)
    {
        if ($db == null) {
            throw new \Exception('Missing config');
        }

        unset($this->columns);
        $this->columns = [***REMOVED***;

        $this->db =         $db;
        $this->tableName    = $this->str('class', $this->db->getTable());
        $this->tableColumns = $this->getTableService()->getColumns($this->db->getTable());
        $this->dbColumns    = $this->db->getColumns();

        //var_dump($this->tableName);
        //var_dump(count($this->tableColumns));
        $this->tablePrimaryKey = $this->getTableService()->getPrimaryKey($this->db->getTable());

        if (!$this->tablePrimaryKey) {
            throw new PrimaryKeyNotFoundException();
        }

        foreach ($this->tableColumns as $column) {
            if ($all === false && in_array($column->getName(), $this->excludeList())) {
                if (!in_array($column->getName(), $include)) {
                    continue;
                }
            }

            $instance = $this->factory($column, $this->db);

            $this->columns[***REMOVED***  = $instance;
        }

        return $this->columns;
    }

    public function mapDataType($match)
    {
        switch ($match) {
            case 'int':
            case 'Int':
                $word = 'Integer';
                break;

            case 'tinytext':
            case 'tinyText':
            case 'TinyText':
                $word = 'Text';
                break;
            default:
                $word = $match;
        }

        return $this->str('class', $word);
    }

    public function isPrimaryKey(ColumnObject $column)
    {
        return in_array($column->getName(), $this->tablePrimaryKey->getColumns());

    }

    /**
     * Transforma uma metadata de coluna simples em Gear\Column.
     *
     * @param Zend\Db\Metadata\Object\ColumnObject $column Coluna que será transformada em Gear\Column
     * @param GearJson\Db\Db                       $db     Mvc
     *
     * @return \Gear\Column\UniqueInterface|unknown
     */
    private function factory($column)
    {

        $dataType = $this->mapDataType($this->str('class', $column->getDataType()));

        //primary key
        if ($this->isPrimaryKey($column)) {
            $className = sprintf(self::BASE, self::NAMESPACE, $dataType, self::PRIMARY_KEY);

            $instance = new $className($column, $this->tablePrimaryKey);

            return $this->addDependency($instance, $column);
            //foreign key
        }

        $columnConstraint = $this->getTableService()->getConstraintForeignKeyFromColumn($this->db->getTable(), $column);

        if ($columnConstraint != null) {
            $class = sprintf(self::BASE, self::NAMESPACE, $dataType, self::FOREIGN_KEY);

            $referencedTable = $this->getTableService()->getReferencedTableValidColumnName(
                $columnConstraint->getReferencedTableName()
            );

            $instance = new $class($column, $columnConstraint, $referencedTable);

            return $this->addDependency($instance, $column);
            //standard
        }

        $specialityName = (array_key_exists($column->getName(), $this->dbColumns))
            ? $this->dbColumns[$column->getName()***REMOVED***
            : null;

        if ($specialityName !== null) {

            $className = $this->str('class', str_replace(' ', '', $specialityName));

            $class = sprintf(self::BASE, self::NAMESPACE, $dataType, $className);

            if (class_exists($class) === false) {
                throw new UndevelopedColumn($class);
            }

            $instance = new $class($column);

            return $this->addDependency($instance, $column);
        }

        $class = sprintf(self::BASE, self::NAMESPACE, $dataType, $dataType);


        if (class_exists($class) === false) {
            throw new UndevelopedColumn($class);
        }

        $instance = new $class($column);

            //speciality
        return $this->addDependency($instance, $column);

        //$instance->setServiceLocator($this->getServiceLocator());

    }

    public function addDependency($instance, $column)
    {
        $instance->setModule($this->getModule());
        $instance->setStringService($this->getStringService());


        if ($instance instanceof UniqueInterface) {
            $uniqueConstraint = $this->getTableService()
                ->getUniqueConstraintFromColumn($this->db->getTable(), $column);

            if ($uniqueConstraint instanceof ConstraintObject) {
                $instance->setUniqueConstraint($uniqueConstraint);
            }
        }

        return $instance;
    }
}
