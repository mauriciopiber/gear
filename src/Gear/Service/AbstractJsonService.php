<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\Column\UniqueInterface;
use Gear\Service\AbstractService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;
use Gear\Metadata\Table;

abstract class AbstractJsonService extends AbstractService implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    protected $jsonService;

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

    public function createFile()
    {
        $this->file = $this->getServiceLocator()->get('fileCreator');
    }



    //Aqui pra baxo não faz parte do FILE



    public function createTrait($src, $location, $name = null)
    {
        if ($name === null) {
            $name = $this->className;
        }

        $trait = $this->getServiceLocator()->get('fileCreator');
        $trait->setTemplate('template/src/trait.phtml');
        $trait->setFileName($name.'Trait.php');
        $trait->setLocation($location);

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
        $mapping->getRepositoryMapping();
        return $mapping->getCountTableHead();
    }


    public function fixtureDatabase(&$file, $numberReference = 999)
    {
        $dbColumns = $this->getTableData();

        foreach ($dbColumns as $i => $column) {
            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                continue;
            }

            if ($column instanceof \Gear\Service\Column\AbstractDateTime || $column instanceof \Gear\Service\Column\Decimal) {
                $fixtureHaveInDatabase[***REMOVED*** = array(
                    'name' => $this->str('uline', $column->getColumn()->getName()),
                    'value' => $column->getFixtureDefaultDb($numberReference)
                );
                continue;
            }

            $fixtureHaveInDatabase[***REMOVED*** = array(
                'name' => $this->str('uline', $column->getColumn()->getName()),
                'value' => $column->getFixtureDefault($numberReference)
            );
        }
        $file->addChildView(
            array(
                'template' => 'template/test/acceptance/fixture.phtml',
                'config'   => array('fixture' => $fixtureHaveInDatabase),
                'placeholder' => 'fixtureHaveInDatabase'
            )
        );
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
            'dbUser' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['user'***REMOVED***,
            'dbPass' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['password'***REMOVED***,
            'dbName' => $arrayConfig['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***['dbname'***REMOVED***
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
        if (!isset($this->metadata)) {
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
            'User' => 31,
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

    public function loadTable($table)
    {
        if ($table instanceof \Gear\ValueObject\Db) {
            $name = $table->getTable();
            $this->db = $table;
        } elseif ($table instanceof \Gear\ValueObject\Src) {
            $name = $table->getName();
            $this->src = $table;
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




        $defaultNamespace = 'Gear\\Service\\Column';

        foreach ($this->tableColumns as $column) {

            if (in_array($column->getName(), \Gear\ValueObject\Db::excludeList())) {
                continue;
            }

            $dataType = $this->str('class', $column->getDataType());
            $specialityName = $this->db->getColumnSpeciality($column->getName());
            $columnConstraint = $table->getConstraintForeignKeyFromColumn($column);

            //primary key
            if(in_array($column->getName(), $primaryKey->getColumns())) {
                $class = $defaultNamespace.'\\'.$dataType.'\\PrimaryKey';
                $instance = new $class($column, $primaryKey);
                //foreign key
            } elseif($columnConstraint != null) {
                $class = $defaultNamespace.'\\'.$dataType.'\\ForeignKey';
                $instance = new $class($column, $columnConstraint);
                $instance->setModuleName($this->getConfig()->getModule());

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


            if ($instance instanceof UniqueInterface) {
                $uniqueConstraint = $table->getUniqueConstraintFromColumn($column);
                $instance->setUniqueConstraint($uniqueConstraint);
            }

            $this->tableData[$column->getName()***REMOVED***  = $instance;
        }

/*
        if (isset($this->db)) {
            foreach ($this->db->getColumns() as $column => $speciality) {

                if (strpos($speciality, '1-n') !== false) {

                    $className = str_replace(array('1-n{', '}'), array('', ''), $speciality);

                    $class = $defaultNamespace.'\\Association\\OneToMany\\'.$this->str('class', $className);

                    var_dump($class);

                }
            }
        }
 */
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

    public function setInstance($instance)
    {
        $this->instance = $instance;
        return $this;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function verifyUploadImageAssociation($tableName, $tableImage = 'upload_image')
    {
        $metadata = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));


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



    public function getSchema()
    {
        return \Zend\Json\Json::decode(file_get_contents($this->getJson()), 1);
    }

    public function getJson()
    {
        return $this->getModule()->getSchemaFolder();
    }

    public function setJsonService(\Gear\Service\Constructor\JsonService $jsonService)
    {
        if (!isset($this->jsonService)) {
            $this->jsonService = $jsonService;
        }

        return $this;
    }

    public function getJsonService()
    {
        if (!isset($this->jsonService)) {
            $this->jsonService = $this->getServiceLocator()->get('jsonService');
        }

        return $this->jsonService;
    }

    public function setJsonSchema($json) {
        $this->jsonSchema = $json;
        return $this;
    }

    public function getJsonSchema()
    {
        if (!isset($this->json)) {
            $this->json = $this->getSchema();
        }
        return $this->json;
    }

	public function getGearSchema()
	{
	    if (!isset($this->gearSchema)) {
	        $this->gearSchema = $this->getServiceLocator()->get('Gear\Schema');
	    }
		return $this->gearSchema;
	}

	public function setGearSchema($gearSchema)
	{
		$this->gearSchema = $gearSchema;
		return $this;
	}

	public function getTableName() {
		return $this->tableName;
	}

	public function setTableName($tableName) {
		$this->tableName = $tableName;
		return $this;
	}

	public function getFile() {
		return $this->file;
	}

	public function setFile($file) {
		$this->file = $file;
		return $this;
	}




}
