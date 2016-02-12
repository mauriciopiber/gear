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
use Zend\Db\Metadata\Metadata;
use Gear\Mvc\TraitServiceTrait;
use Gear\Mvc\InterfaceServiceTrait;
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

abstract class AbstractJsonService extends AbstractService implements EventManagerAwareInterface
{
    use TableServiceTrait;
    use InterfaceServiceTrait;
    use TraitServiceTrait;
    use EventManagerAwareTrait;

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

    protected $metadata;

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

    public function getValuesForUnitTest()
    {
        $this->static = '';
        $data = $this->getTableData();
        $insertSelect = [***REMOVED***;

        $insertData   = [***REMOVED***;
        $insertSelect = [***REMOVED***;
        $insertAssert = [***REMOVED***;
        $updateData   = [***REMOVED***;
        $updateAssert = [***REMOVED***;

        foreach ($data as $i => $columnData) {

            if ($this->isClass($columnData, 'Gear\Column\Varchar\UploadImage')) {

                if (isset($this->repository) && $this->repository === true) {
                    $insertData[***REMOVED***   = $columnData->getInsertDataRepositoryTest();
                    $insertAssert[***REMOVED*** = $columnData->getInsertAssertRepositoryTest();
                    $updateData[***REMOVED***   = $columnData->getUpdateDataRepositoryTest();
                    $updateAssert[***REMOVED*** = $columnData->getUpdateAssertRepositoryTest();
                } else {
                    $insertData[***REMOVED***  = $columnData->getInsertArrayByColumn();
                    $insertAssert[***REMOVED*** = $columnData->getInsertAssertByColumn();
                    $insertSelect[***REMOVED*** = $columnData->getInsertSelectByColumn();
                    $updateData[***REMOVED***  = $columnData->getUpdateArrayByColumn();
                    $updateAssert[***REMOVED*** = $columnData->getUpdateAssertByColumn();

                    $insertAssert[***REMOVED*** = $columnData->getInsertFileExistsTest();
                    $updateAssert[***REMOVED*** = $columnData->getUpdateFileExistsTest();
                }

                $this->static .= <<<EOS

    static public \${$this->str('var-lenght', $columnData->getColumn()->getName())} = '{$columnData->getUploadDir()}';

EOS;

                continue;

            }

            if ($columnData instanceof PrimaryKey) {
                continue;
            }

            if ($columnData instanceof ForeignKey) {
                $columnData->setHelperStack([
                    'insert' => rand(1, 30),
                    'update' => rand(1, 30)
                    ***REMOVED***);
            }

            if ($columnData instanceof AbstractDateTime) {
                $timeInsert = new \DateTime('now');

                $timeInsert->add(new \DateInterval(sprintf('P%dD', rand(1, 9999))));

                $columnData->setInsertTime($timeInsert);

                $timeInsert->add(new \DateInterval('P1M'));
                $columnData->setUpdateTime($timeInsert);
            }

            if ($columnData instanceof Decimal) {
                $columnData->setReference(rand(50, 5000));
            }

            if ($columnData instanceof Int || $columnData instanceof TinyInt) {
                $columnData->setReference(rand(1, 99999));
            }


            if ($columnData instanceof Varchar) {
                $columnData->setReference(rand(50, 5000));
            }

            //Quebra necessária, os password verify não tem como serem testados!
            if ($this->isClass($columnData, 'Gear\Column\Varchar\PasswordVerify')) {

                $updateData[***REMOVED***  = $columnData->getVerifyUpdateColumn();
                $updateData[***REMOVED***  = $columnData->getVerifyVerifyUpdateColumn();
                $insertData[***REMOVED***  = $columnData->getVerifyInsertColumn();
                $insertData[***REMOVED***  = $columnData->getVerifyVerifyInsertColumn();

                continue;
            } elseif ($this->isclass($columnData, 'Gear\Column\Varchar\UniqueId')) {


                if (isset($this->repository) && $this->repository === true) {
                    $insertData[***REMOVED***  = $columnData->getInsertArrayByColumn();
                    $updateData[***REMOVED***  = $columnData->getUpdateArrayByColumn();
                }
                continue;

            }
            $insertData[***REMOVED***  = $columnData->getInsertArrayByColumn();
            $insertAssert[***REMOVED*** = $columnData->getInsertAssertByColumn();
            $insertSelect[***REMOVED*** = $columnData->getInsertSelectByColumn();

            if ($columnData instanceof AbstractDateTime) {
                $timeInsert->add(new \DateInterval('P2M'));
                $columnData->setUpdateTime($timeInsert);
            }


            $updateData[***REMOVED***  = $columnData->getUpdateArrayByColumn();
            $updateAssert[***REMOVED*** = $columnData->getUpdateAssertByColumn();

            continue;

        }

        $unitTestValues = new \Gear\Mvc\UnitTestValues();
        $unitTestValues->setInsertArray($insertData);
        $unitTestValues->setInsertSelect($insertSelect);
        $unitTestValues->setInsertAssert($insertAssert);
        $unitTestValues->setUpdateArray($updateData);
        $unitTestValues->setUpdateAssert($updateAssert);

        return $unitTestValues;
    }


    public function getSelectOneByForUnitTest()
    {
        $selectOneBy = [***REMOVED***;
        //get order
        foreach ($this->getTableData() as $columnData) {

            if (in_array(get_class($columnData), array(
                'Gear\Column\Varchar\PasswordVerify',
                'Gear\Column\Varchar\UniqueId',
            ))) {
                continue;
            }

            $baseColumn = array_merge(
                $this->getBaseArray(),
                [
                    'var' => $this->str('var', $columnData->getColumn()->getName()),
                    'class' => $this->str('class', $columnData->getColumn()->getName())
                ***REMOVED***
            );


            if ($columnData instanceof \Gear\Column\Varchar\UploadImage) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array('value' => '\''.$columnData->selectOneBy(15).'\''));
                continue;
            }

            if ($columnData instanceof PrimaryKey) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array( 'value' => '15'));
                continue;
            }

            if ($columnData instanceof PrimaryKey) {
                $selectOneBy[***REMOVED*** = array_merge($baseColumn, array( 'value' => '15'));
                continue;
            }

            if ($columnData instanceof Email) {
                $selectOneBy[***REMOVED*** = array_merge(
                    $baseColumn,
                    array('value' => sprintf('%s', $columnData->getFixtureFormat(15)))
                );
                continue;
            }


            if ($columnData instanceof Varchar || $columnData instanceof Text) {
                $selectOneBy[***REMOVED*** = array_merge(
                    $baseColumn,
                    array('value' => '\''.$this->getTestBaseMessage('15', $columnData->getColumn(), false).'\'')
                );
                continue;
            }


        }

        return $selectOneBy;
    }

    public function getOrderByForUnitTest()
    {

        $order = [***REMOVED***;
        //get order
        foreach ($this->getTableData() as $columnData) {

            if (in_array(get_class($columnData), array(
                'Gear\Column\Varchar\PasswordVerify',
                'Gear\Column\Varchar\UniqueId',
            ))) {
                continue;
            }


            $baseColumn = array_merge(
                $this->getBaseArray(),
                [
                    'var' => $this->str('var', $columnData->getColumn()->getName()),
                    'class' => $this->str('class', $columnData->getColumn()->getName()),
                    'fixtureSize' => $this->getFixtureSizeByTableName()
                ***REMOVED***
            );

            if ($columnData instanceof PrimaryKey) {

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$this->getTestBaseMessage(1, $columnData->getColumn(), false, true).'\''
                    )
                );


                if ($columnData->getColumn()->getName() == 'id_user' && $this->tableName == 'User') {
                    $value = '37';
                } elseif ($columnData->getColumn()->getName() == 'id_role' && $this->tableName == 'Role') {
                    $value =  '32';
                } elseif ($columnData->getColumn()->getName() == 'id_role' && $this->tableName == 'User') {
                    $value = '37';
                } else {
                    $value = $this->getTestBaseMessage(30, $columnData->getColumn(), false, true);
                }

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$value.'\''
                    )
                );
                continue;
            }


            if ($columnData instanceof Email) {

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => $columnData->getFixtureFormat(1)
                    )
                );

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => $columnData->getFixtureFormat(30)
                    )
                );
                continue;
            }

            if ($columnData instanceof \Gear\Column\Varchar\UploadImage) {

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$columnData->getOrderBy(1).'\''
                    )
                );

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$columnData->getOrderBy(30).'\''
                    )
                );
                continue;
            }

            if ($columnData instanceof Varchar || $columnData instanceof Text) {

/*
                var_dump($columnData->getColumn()->getName());
                var_dump($this->tableName);
 */
                if ($columnData->getColumn()->getName() == 'username' && $this->tableName == 'User') {
                    $value = '';
                } else {
                    $value = $this->getTestBaseMessage(1, $columnData->getColumn(), false, false);
                }

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'ASC',
                        'value' => '\''.$value.'\''
                    )
                );

                if ($columnData->getColumn()->getName() == 'email' && $this->tableName == 'User') {
                    $value = 'usuariogear6@gmail.com';
                } elseif ($columnData->getColumn()->getName() == 'name' && $this->tableName == 'Role') {
                    $value = 'guest';
                } elseif ($columnData->getColumn()->getName() == 'id_role' && $this->tableName == 'User') {
                    $value = 'guest';
                } else {
                    $value = $this->getTestBaseMessage(30, $columnData->getColumn(), false, false);
                }

                $order[***REMOVED*** = array_merge(
                    $baseColumn,
                    array(
                        'order' => 'DESC',
                        'value' => '\''.$value.'\''
                    )
                );
                continue;
            }
        }

        return $order;
    }


    /**
     * @deprecated
     */
    public function getTestBaseMessage($base, $column, $whitespace = false, $isPrimaryKey = false)
    {
        if ($whitespace) {
            $data = '%s %s';
        } else {
            $data = '%s%s';
        }

        $base = sprintf('%02d', $base);

        if ($isPrimaryKey) {
            $baseMessage = $base;
        } else {
            $baseMessage = sprintf($data, $base, $this->str('label', $column->getName()));
        }

        if (strlen($baseMessage) > $column->getCharacterMaximumLength() && $column->getDataType() == 'varchar') {
            $baseMessage = substr($baseMessage, 0, $column->getCharacterMaximumLength());
        }
        return $baseMessage;
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

    public function arrayToFile($file, $array)
    {
        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($array, true));
        $dataArray = str_replace('\\\\', '\\', $dataArray);
        $dataArray = implode("\n", array_map('rtrim', explode("\n", $dataArray)));
        $allData = '<?php return ' . $dataArray . ';'.PHP_EOL;
        file_put_contents($file, $allData);
        return true;
    }

    public function inject()
    {
        $lines = explode(PHP_EOL, $this->fileCode);

        $lines[count($lines)-2***REMOVED*** = $this->functions;

        $newFile = implode(PHP_EOL, $lines);

        $this->fileCode = file_put_contents($this->controllerFile, $newFile);
        return $this->fileCode;
    }

    public function moveArray(&$array, $key, $novoValor)
    {
        $antes = array_slice($array, 0, $key);

        $novoArray = [***REMOVED***;

        foreach ($antes as $item) {
            $novoArray[***REMOVED*** = $item;
        }

        $novoArray[***REMOVED*** = $novoValor;

        $depois = array_slice($array, $key);

        foreach ($depois as $item) {
            $novoArray[***REMOVED*** = $item;
        }

        $array = $novoArray;

        return $array;
    }



    public function getFunctionsNameFromFile()
    {
        $actions = [***REMOVED***;
        preg_match_all('/public function [a-zA-Z()***REMOVED****/', $this->fileCode, $matches);

        if (!empty($matches)) {
            foreach ($matches[0***REMOVED*** as $match) {
                $actionName = str_replace('public function ', '', $match);
                $actionName = str_replace('Action()', '', $actionName);
                $actionName = str_replace('Action(', '', $actionName);
                $actionName = str_replace('()', '', $actionName);
                $actionName = str_replace('(', '', $actionName);
                $actionName = trim($actionName);
                $actionName = $this->str('class', $actionName);
                $actions[***REMOVED***  = $actionName;
            }
        }

        return $actions;
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

    public function createFile()
    {
        $this->file = $this->getServiceLocator()->get('fileCreator');
    }



    //Aqui pra baxo não faz parte do FILE

    public function createInterface($location)
    {
        $this->getInterfaceService()->createInterface($this->src, $location);
        return;
    }


    public function createTrait(
        $src,
        $location,
        $name = null,
        $testLocation = null,
        $isSearchForm = false,
        $specialName = null
    ) {

        $this->getTraitService()->createTrait(
            $src,
            $location,
            $name = null,
            $testLocation = null,
            $isSearchForm = false,
            $specialName = null
        );

        return;

        if ($name === null) {
            $name = $this->className;
        }

        $serviceManager = new \Gear\Config\ServiceManager($this->getModule());
        $serviceManager->extractServiceManagerFromSrc($src);

        //convert SearchForm to Factory
        if ($src->getType() == 'SearchFactory') {
            $srcType = 'Factory';
        } else {
            $srcType = $src->getType();
        }

        $trait->setOptions(
            array(
                'module' => $this->getModule()->getModuleName(),
                'class' => $this->str('class', $name),
                'var'   => $this->str('var', $name),
                'lenght' => $this->str('var-lenght', $name),
                'serviceManager' => $serviceManager->getCallable(),
                'srcType' => $srcType,
                'srcName' => $src->getName()
            )
        );

        return $trait->render();

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

    public function getTableHeadCount()
    {
        $mapping = $this->getServiceLocator()->get('RepositoryService\MappingService');
        $mapping->setAliaseStack(array('e'));
        $mapping->getRepositoryMapping($this->db);
        return $mapping->getCountTableHead();
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

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }

    public function dbOptions()
    {
        $arrayConfig = $this->getServiceLocator()->get('config');

        return array(
            'username' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['user'***REMOVED***,
            'password' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['password'***REMOVED***,
            'database' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***
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

    public function getMetadata()
    {
        if (!$this->metadata) {
            $this->metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        }
        return $this->metadata;
    }

    public function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
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


    public function getColumnVar($column)
    {
        if (strlen($column->getName()) > 18) {
            $var = $this->str('var', substr($column->getName(), 0, 15));
        } else {
            $var = $this->str('var', $column->getName());
        }
        return $var;
    }

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

        $this->tableName    = $this->str('class', $name);
        $metadata           = $this->getMetadata();
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



    public function __construct()
    {
        $this->getEventManager()->trigger('init', $this, array());
    }

    public function getSpecialites()
    {

    }

    public function getHasDependencyImagem()
    {
        if ($this->verifyImageDependency($this->name)) {
            $this->useImageService = true;
        } else {
            $this->useImageService = false;
        }
    }

    public function phpArrayToFile($phpArray)
    {
        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($phpArray, true));
        $file =  'return ' . $dataArray . ';'.PHP_EOL;
        return $file;
    }

    public function cut($string)
    {
        return substr($string, 0, 18);
    }


    public function verifyUploadImageAssociation($tableName, $tableImage = 'upload_image')
    {
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

    public function verifyImageDependency($tableNameTo)
    {

        $metadata = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));

        try {
            $imagem = $metadata->getTable('imagem');
        } catch (\Exception $e) {
            //echo $e;
        }

        if (isset($imagem)) {
            $constrains = $imagem->getConstraints();
            foreach ($constrains as $constraint) {
                if ($constraint->getType() == 'FOREIGN KEY') {
                    $tableName = $constraint->getReferencedTableName();
                    if ($tableNameTo == $this->str('class', $tableName)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }


    public function setTableData($tableName)
    {
        $this->tableData = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    public function getSrc()
    {
        return $this->src;
    }

    public function setSrc($src)
    {
        $this->src = $src;
        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }


    public function getBaseArray()
    {
        return $this->baseArray;
    }

    public function setBaseArray($baseArray)
    {
        $this->baseArray = $baseArray;
        return $this;
    }
}
