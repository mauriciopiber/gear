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
use Gear\Metadata\MetadataTrait;
use Zend\Db\Metadata\Metadata;
use Gear\Metadata\TableServiceTrait;
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

use Gear\Creator\FileCreatorTrait;

abstract class AbstractJsonService extends AbstractService implements EventManagerAwareInterface
{
    use TableServiceTrait;
    use EventManagerAwareTrait;
    use FileCreatorTrait;
    use MetadataTrait;

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

    /**
     * Usado em RepositoryTest, ServiceTest, ControllerTest
     * @return \Gear\ValueObject\Structure\UnitTestValues
     */


    protected $columnDuplicated;

    public function isDuplicated($columnData, $method)
    {
        if (!isset($this->columnDuplicated)) {
            $this->columnDuplicated = [***REMOVED***;
        }

        if (
            !in_array(get_class($columnData), $this->columnDuplicated)
            || !array_key_exists($method, $this->columnDuplicated)
        ) {

            $this->columnDuplicated[$method***REMOVED*** = get_class($columnData);
            return false;

        } elseif (
            isset($this->columnDuplicated[$method***REMOVED***)
            && $this->columnDuplicated[$method***REMOVED*** != get_class($columnData)
         ) {

            return true;
        }

        return true;
    }



    public function isClass($columnData, $class)
    {
        return in_array(
            get_class($columnData),
            array($class)
        );
    }

    /**
     * @deprecated
     */
    public function getValidColumnsFromTable()
    {
        $metadata = $this->getMetadata();

        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        $primaryKeyColumn = $table->getPrimaryKeyColumns();

        unset($this->validColumns);

        foreach ($this->tableColumns as $column) {


            if (in_array($this->str('uline', $column->getName()), $primaryKeyColumn)) {

                if (!$this->usePrimaryKey) {
                    continue;
                }
            }

            if (in_array($column->getName(), \GearJson\Db\Db::excludeList())) {
                continue;
            }

            $columnConstraint = $table->getForeignKeyFromColumn($column);


            $this->validColumns[***REMOVED***  = $column;
        }
        return $this->validColumns;
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

    public function findTableObject($name)
    {
        $metadata = $this->getMetadata();
        return $metadata->getTable($this->str('uline', $name));
    }

    public function hasUniqueConstraint()
    {
        $constraints = $this->tableObject->getConstraints();

        foreach ($constraints as $constraint) {
            if ($constraint->getType() == 'UNIQUE') {
                return true;
            }
        }

        return false;
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

    public function getFixtureSize()
    {
        return array(
            'default' => 30,
            'User' => 37,
            'Role' => 32
        );
    }

    public function getFixtureSizeByTableName()
    {
        $size = $this->getFixtureSize();
        if (array_key_exists($this->tableName, $size)) {
            return $size[$this->tableName***REMOVED***;
        }
        return $size['default'***REMOVED***;
    }


    /**
     * Retorna a metadata de uma tabela do banco;
     *
     * @param String $tableName
     * @throws \Gear\Exception\TableNotFoundException
     */
    public function getTable($tableName)
    {
        $metadata = $this->getMetadata();

        try {
            $table = $metadata->getTable($tableName);
        } catch (\Exception $e) {
            throw new \Gear\Exception\TableNotFoundException();
        }

        return $table;

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
        $this->table        = new Table($metadata->getTable($this->str('uline', $this->tableName)));
        $this->primaryKey   = $this->table->getPrimaryKeyColumns();
    }

    public function getTableData()
    {
        if (isset($this->tableData)) {
            return $this->tableData;
        }

        $metadata = $this->getMetadata();

        $table = new \Gear\Metadata\Table($metadata->getTable($this->str('uline', $this->tableName)));

        $this->tableColumns = $metadata->getColumns($this->str('uline', $this->tableName));

        $primaryKey = $table->getPrimaryKey();

        if (!$primaryKey) {
            throw new \Gear\Exception\PrimaryKeyNotFoundException();
        }

        $defaultNamespace = 'Gear\\Column';

        foreach ($this->tableColumns as $column) {

            if (in_array($column->getName(), \GearJson\Db\Db::excludeList())) {
                continue;
            }

            $dataType = $this->str('class', $column->getDataType());
            $specialityName = $this->db->getColumnSpeciality($column->getName());
            $columnConstraint = $table->getConstraintForeignKeyFromColumn($column);

            //primary key
            if (in_array($column->getName(), $primaryKey->getColumns())) {
                $class = $defaultNamespace.'\\'.$dataType.'\\PrimaryKey';
                $instance = new $class($column, $primaryKey);
                //foreign key
            } elseif ($columnConstraint != null) {
                $class = $defaultNamespace.'\\'.$dataType.'\\ForeignKey';
                $instance = new $class($column, $columnConstraint);
                $instance->setModuleName($this->getModule()->getModuleName());

                //standard
            } elseif ($specialityName == null) {
                $class = $defaultNamespace.'\\'.$dataType;
                $instance = new $class($column);
                //speciality
            } else {
                $className = $this->str('class', str_replace('-', '_', $specialityName));
                $class = $defaultNamespace.'\\'.$dataType.'\\'.$className;
                $instance = new $class($column);
            }

            $instance->setServiceLocator($this->getServiceLocator());
            $instance->setModule($this->getModule());


            if ($instance instanceof UniqueInterface) {
                $uniqueConstraint = $table->getUniqueConstraintFromColumn($column);
                $instance->setUniqueConstraint($uniqueConstraint);
            }

            $this->tableData[***REMOVED***  = $instance;
        }

        return $this->tableData;
    }



    /**
     * Função usada em MVC para consultar se uma tabela está associada.
     * Aqui está usando apenas a tabela upload_image, mas deve ser possível expandir para outras tabelas.
     * Fazer o Gear usar apenas uma função para verificar dependencia.
     * Funções similares devem receber deprecated.
     */

    public function verifyUploadImageAssociation($tableName, $tableImage = 'upload_image')
    {

        $tableName = $this->str('class', $tableName);

        $metadata = $this->getMetadata();


        try {
            $imagem = $metadata->getTable('upload_image');
        } catch (\Exception $e) {
            return false;
        }


        if (isset($imagem)) {
            $constrains = $imagem->getConstraints();
            foreach ($constrains as $constraint) {
                if ($constraint->getType() == 'FOREIGN KEY') {
                    $tableNameReferenced = $constraint->getReferencedTableName();
                    if ($tableName == $this->str('class', $tableNameReferenced)) {

                        if (in_array('created_by', $constraint->getColumns())) {
                            continue;
                        }
                        if (in_array('updated_by', $constraint->getColumns())) {
                            continue;
                        }

                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function verifyUploadImageColumn($tableDb)
    {
        if ($tableDb->getColumns() == null) {
            return false;
        }


        foreach ($tableDb->getColumns() as $columnName => $specialityName) {

            if ($specialityName == 'upload-image') {
                return true;
            }
        }

        return false;

    }


    public function setTableData($tableName)
    {
        $this->tableData = $tableName;
        return $this;
    }
}
