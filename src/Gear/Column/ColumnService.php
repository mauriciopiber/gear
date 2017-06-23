<?php
namespace Gear\Column;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use \Gear\Exception\PrimaryKeyNotFoundException;
use GearJson\Db\Db;
use Gear\Table\Metadata\MetadataTrait;
use Gear\Table\TableService\TableServiceTrait;
use Gear\Column\UniqueInterface;
use GearBase\Util\String\StringServiceTrait;
use Gear\Module\ModuleAwareTrait;
use Gear\Column\Exception\UndevelopedColumn;
use Gear\Column\Exception\UndevelopedColumnPart;
use Gear\Column\Exception\UnfoundColumnRender;
use Gear\Column\Int\PrimaryKey;
use Gear\Column\Int\ForeignKey;
use Gear\Column\AbstractDateTime;
use Gear\Column\Decimal\Decimal;
use Gear\Column\Integer\Integer;
use Gear\Column\TinyInt\TinyInt;
use Gear\Column\Varchar\Varchar;
use Gear\Column\Varchar\UniqueId;
use Gear\Column\Varchar\PasswordVerify;
use Gear\Column\Varchar\UploadImage;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Column\Exception\UnfoundReference;
use Zend\Db\Metadata\Object\ConstraintObject;
use Gear\Column\ColumnManager;

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
class ColumnService implements ServiceLocatorAwareInterface
{
    use FileCreatorTrait;
    use ModuleAwareTrait;
    use StringServiceTrait;
    use MetadataTrait;
    use TableServiceTrait;
    use ServiceLocatorAwareTrait;

    const NAMESPACE = 'Gear\\Column';

    const FOREIGN_KEY = '';

    const PRIMARY_KEY = '';

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
        return new ColumnManager($this->getColumns($db));
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
        if (empty($this->columns) && $db == null) {
            throw new \Exception('Missing config');
        }

        unset($this->columns);

        $metadata = $this->getMetadata();

        $this->tableName    = $this->str('class', $db->getTable());
        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));
        $this->dbColumns    = $db->getColumns();

        //var_dump($this->tableName);
        //var_dump(count($this->tableColumns));
        $this->tablePrimaryKey = $this->getTableService()->getPrimaryKey($db->getTable());

        if (!$this->tablePrimaryKey) {
            throw new PrimaryKeyNotFoundException();
        }

        foreach ($this->tableColumns as $column) {
            if ($all === false && in_array($column->getName(), $this->excludeList())) {
                if (!in_array($column->getName(), $include)) {
                    continue;
                }
            }

            $instance = $this->factory($column, $db);

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

    /**
     * Transforma uma metadata de coluna simples em Gear\Column.
     *
     * @param Zend\Db\Metadata\Object\ColumnObject $column Coluna que será transformada em Gear\Column
     * @param GearJson\Db\Db                       $db     Mvc
     *
     * @return \Gear\Column\UniqueInterface|unknown
     */
    private function factory($column, $db)
    {
        $dataType = $this->mapDataType($this->str('class', $column->getDataType()));

        $specialityName = (array_key_exists($column->getName(), $this->dbColumns))
            ? $this->dbColumns[$column->getName()***REMOVED***
            : null;

        $columnConstraint = $this->getTableService()->getConstraintForeignKeyFromColumn($db->getTable(), $column);

        //primary key
        if (in_array($column->getName(), $this->tablePrimaryKey->getColumns())) {
            $class = self::NAMESPACE.'\\'.$dataType.'\\PrimaryKey';
            $instance = new $class($column, $this->tablePrimaryKey);
            //foreign key
        } elseif ($columnConstraint != null) {
            $class = self::NAMESPACE.'\\'.$dataType.'\\ForeignKey';

            $referencedTable = $this->getTableService()->getReferencedTableValidColumnName(
                $columnConstraint->getReferencedTableName()
            );

            $instance = new $class($column, $columnConstraint, $referencedTable);
            //$instance->setModuleName($this->getModule()->getModuleName());
            //$instance->setTableService($this->getTableService());


            //standard
        } elseif ($specialityName == null) {
            $class = self::NAMESPACE.'\\'.$dataType.'\\'.$dataType;

            if (class_exists($class) === false) {
                throw new UndevelopedColumn($class);
            }

            $instance = new $class($column);

            //speciality
        } else {
            $className = $this->str('class', str_replace(' ', '', $specialityName));
            $class = self::NAMESPACE.'\\'.$dataType.'\\'.$className;
            if (class_exists($class) === false) {
                throw new UndevelopedColumn($class);
            }
            $instance = new $class($column);
        }

        //$instance->setServiceLocator($this->getServiceLocator());
        $instance->setModule($this->getModule());
        $instance->setStringService($this->getStringService());


        if ($instance instanceof UniqueInterface) {
            $uniqueConstraint = $this->getTableService()->getUniqueConstraintFromColumn($db->getTable(), $column);

            if ($uniqueConstraint instanceof ConstraintObject) {
                $instance->setUniqueConstraint($uniqueConstraint);
            }
        }

        return $instance;
    }
}
