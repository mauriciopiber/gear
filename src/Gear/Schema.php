<?php
namespace Gear;

use Gear\ValueObject\BasicModuleStructure;
use Zend\Db\Metadata\Metadata;
use Zend\ServiceManager\ServiceLocatorInterface;

class Schema
{
    protected $module;

    protected $name = 'schema/module.json';

    protected $serviceLocator;

    public function __construct(BasicModuleStructure $module, ServiceLocatorInterface $serviceLocator)
    {
        $this->module = $module;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Função responsável por iniciar um novo schema
     */
    public function init()
    {
        return array($this->getModule()->getModuleName() => array('db' => array(), 'src' => array(), 'controller' => array()));
    }

    public function getSpecialityArray($db, $arrayToValidate = null)
    {
        $specialityName = [***REMOVED***;
        if (isset($db)) {
            foreach ($db->getColumns() as $column => $speciality) {
                if ($arrayToValidate == null || in_array($speciality, $arrayToValidate)) {
                    $specialityName[$column***REMOVED*** = $speciality;
                }

            }
        }

        return $specialityName;
    }

    public function getSpecialityByColumnName($columnName, $tableName)
    {
        $dbs = $this->__extractObject('db');
        foreach ($dbs as $db) {
            if ($db->getTable() ==  $tableName) {
                break;
            }
            unset($db);
        }
        $specialityName = null;
        if (isset($db)) {

            if($db->getColumns()) {
                foreach ($db->getColumns() as $column => $speciality) {
                    if ($column == $columnName) {
                        $specialityName = $speciality;
                        break;
                    }
                }
            }


        }
        return $specialityName;
    }


    public function getDbByName($name)
    {
        $dbSchema         = $this->__extractObject('db');

        foreach ($dbSchema as $db) {
            if ($db->getTable() == $name) {
                return $db;
            }
        }

        return null;
    }

    public function checkSchemaAlreadySet($db, $srcSet, $controllers)
    {
        $dbSchema         = $this->__extractObject('db');
        $controllerSchema = $this->__extractObject('controller');
        $srcSchema        = $this->__extractObject('src');

        foreach ($dbSchema as $dbRow) {
            $name = $dbRow->getTable();
            if ($name == $db->getTable()) {
                throw new \Exception(sprintf('DB %s já está cadastrado no schema do módulo %s', $name, $this->getModule()->getModuleName()));
            }
        }

        foreach ($controllerSchema as $controllerRow) {
            $name = $controllerRow->getName();
            if ($name == $controllers->getName()) {
                throw new \Exception(sprintf('Controller %s já está cadastrado no schema do módulo %s', $name, $this->getModule()->getModuleName()));
            }
        }

        foreach ($srcSchema as $srcRow) {
            $name = $srcRow->getName();

            foreach ($srcSet as $src) {
                if ($name == $src->getName()) {
                    throw new \Exception(sprintf('Src %s já está cadastrado no schema do módulo %s', $name, $this->getModule()->getModuleName()));
                }
            }
        }


        return true;
    }

    public function findIntoSrc($name)
    {
        $objects = $this->__extract('src');
        $replaceLocation = null;
        foreach ($objects as $i => $v) {
            if ($v['name'***REMOVED*** == $name) {

                $replaceLocation = $i;
                break;
            }
        }

        return $replaceLocation;
    }

    public function findIntoController($name)
    {
        $objects = $this->__extract('controller');
        $replaceLocation = null;
        foreach ($objects as $i => $v) {
            if ($v['name'***REMOVED*** == $name) {

                $replaceLocation = $i;
                break;
            }
        }

        return $replaceLocation;
    }

    public function findIntoDb($name)
    {
        $objects = $this->__extract('db');
        $replaceLocation = null;
        foreach ($objects as $i => $v) {
            if ($v['table'***REMOVED*** == $name) {

                $replaceLocation = $i;
                break;
            }
        }

        return $replaceLocation;
    }




    public function getReplaceLocation($type, $name)
    {
        $replaceLocation = null;
        switch($type) {
            case 'src':
                $replaceLocation = $this->findIntoSrc($name);
                break;
            case 'controller':
                $replaceLocation = $this->findIntoController($name);
                break;
            case 'db':
                 $replaceLocation = $this->findIntoDb($name);
                break;
        }
        return $replaceLocation;
    }

    public function replaceIntoLocation($type, $location, $object)
    {
        $schema = $this->decode($this->getJsonFromFile());
        $schema[$this->getModule()->getModuleName()***REMOVED***[$type***REMOVED***[$location***REMOVED*** = $object->export();
        return $this->persistSchema($schema);
    }


    public function updateDb($db)
    {

        $location = $this->getReplaceLocation('db', $db->getTable());
        $this->replaceIntoLocation('db', $location, $db);
        //verifica o registro de db, se for diferente tp tiver mais colunas, atualizar.

        //verifica o registro de controller
        //verifica o registro de action
        //verifica o registro de src

        return true;
    }

    public function toCamelcase($word)
    {
        $filter = new \Zend\Filter\Word\UnderscoreToCamelCase();
        return $filter->filter($word);
    }

    public function hasImageDependency($dbToInsert)
    {
        $imagemTable = $this->getImageTable();

        if (!$imagemTable) {
            return false;
        }

        $constrains = $imagemTable->getConstraints();

        $imagemConstraint = false;

        if (count($constrains)>0) {
            foreach ($constrains as $constraint) {
                if ($constraint->getType() == 'FOREIGN KEY') {
                    $tableName = $constraint->getReferencedTableName();

                    if ($dbToInsert->getTable() == $this->toCamelcase($tableName)) {

                        $imagemConstraint = true;

                    }
                }
            }
        }

        return $imagemConstraint;
    }


    public function makeController($db)
    {
        $name = $db->getTable();

        $controllerName = sprintf('%sController', $name);
        $controllerService = '%s'.sprintf('\\Controller\\%s', $name);

        $controller = new \Gear\ValueObject\Controller(array(
            'name' => $controllerName,
            'object' => $controllerService
        ));

        $role = 'admin';


        $dependency = "Factory\\$name,Service\\".$name.",SearchFactory\\".$name;

        $actions = array(
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'create', 'db' => $db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'edit', 'db' => $db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'list', 'db' => $db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'delete', 'db' => $db, 'dependency' => $dependency),
            array('role' => $role, 'controller' => $controller->getName(), 'name' => 'view', 'db' => $db, 'dependency' => $dependency),
        );

        if ($this->hasImageDependency($db)) {
            $actions[***REMOVED*** = array('role' => $role, 'controller' => $controller->getName(), 'name' => 'upload-image', 'db' => $db, 'dependency' => $dependency);
        }

        //procura dependencia de imagem
        foreach ($actions as $action) {
            $action = new \Gear\ValueObject\Action($action);
            $controller->addAction($action);
        }

        return $controller;

    }

    public function makeSrc($db)
    {
        $srcToAdd = [***REMOVED***;


        $name = $db->getTable();

        $services = array(
            array('type' => 'Entity'),
            array('type' => 'Repository'),
            array('type' => 'Service', 'dependency' => 'Repository\\'.$name),
            array('type' => 'Form'),
            array('type' => 'Filter'),
            array('type' => 'Fixture'),
            array('type' => 'Factory', 'dependency' => 'Filter\\'.$name.',Form\\'.$name),
        );

        foreach ($services as $i => $v) {

            if ($v['type'***REMOVED*** == 'Entity') {
                $nameFinal = $name;
            } else {
                $nameFinal = sprintf('%s%s', $name, $v['type'***REMOVED***);
            }

            $toInsert = array_merge($v, array('name' => $nameFinal, 'db' => $db->getTable()));
            $srcTemp = new \Gear\ValueObject\Src($toInsert);
            $srcToAdd[***REMOVED*** = $srcTemp;
        }


        $searchFactory = array(
            'type' => 'SearchFactory',
            'db' => $db->getTable(),
            'name' => sprintf('%s%s', $name, 'SearchFactory')
        );

        $srcToAdd[***REMOVED*** = new \Gear\ValueObject\Src($searchFactory);

        $searchForm = array(
            'type' => 'SearchForm',
            'db' => $db->getTable(),
            'name' => sprintf('%s%s', $name, 'SearchForm')
        );
        $srcToAdd[***REMOVED*** = new \Gear\ValueObject\Src($searchForm);

        //adicionar factory de search.
        //adicionar form de search.

        return $srcToAdd;
    }

    public function appendDb(\Gear\ValueObject\Db $dbToInsert)
    {
        $imagemConstraint = $this->hasImageDependency($dbToInsert);

        $controllerToInsert = $this->makeController($dbToInsert);

        $srcToInsert = $this->makeSrc($dbToInsert);

        if ($this->checkSchemaAlreadySet($dbToInsert, $srcToInsert, $controllerToInsert)) {

            $db = $this->__extract('db');
            $db[***REMOVED*** = $dbToInsert->export();

            $controller = $this->__extract('controller');
            $controller[***REMOVED*** = $controllerToInsert->export();

            $src = $this->__extract('src');

            foreach ($srcToInsert as $srcToInsertRow) {
                $src[***REMOVED*** = $srcToInsertRow->export();
            }

            $schema = $this->decode($this->getJsonFromFile());
            $schema[$this->getModule()->getModuleName()***REMOVED***['db'***REMOVED*** = $db;
            $schema[$this->getModule()->getModuleName()***REMOVED***['controller'***REMOVED*** = $controller;
            $schema[$this->getModule()->getModuleName()***REMOVED***['src'***REMOVED*** = $src;

            return $this->persistSchema($schema);
        } else {
            return false;
        }
    }

    public function getAdapter()
    {
        return $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
    }

    public function getImageTable($tableName = 'upload_image')
    {
        $metadata = new \Zend\Db\Metadata\Metadata($this->getAdapter());
        $imagem = null;
        try {
            $imagem = $metadata->getTable($tableName);
        } catch (\Exception $e) {
            //echo $e;
        }

        return $imagem;
    }

    public function getControllerByDb(\Gear\ValueObject\Db $db)
    {

        $controllers = $this->__extractObject('controller');

        foreach ($controllers as $controller) {
            if ($controller->getName() == $db->getTable().'Controller') {
                return $controller;
            }
        }

        throw new Exception(sprintf('Controller/action não encontrado para tabela %s', $db->getTable()));
    }

    public function getSrcByDb(\Gear\ValueObject\Db $db, $type)
    {

        $srcs = $this->__extractObject('src');

        foreach ($srcs as $src) {

            if ($src->getType() == $type && (null !== $src->getDb()) && $src->getDb()->getTable() == $db->getTable()) {
                return $src;
            }
        }
        throw new \Exception(sprintf('Src não encontrado para tabela %s', $db->getTable()));

    }

    public function persistSchema($schema)
    {
        return file_put_contents($this->getModule()->getMainFolder().'/'.$this->getName(), $this->encode($schema));
    }



    public function insertDb(\Gear\ValueObject\Db $dbToInsert)
    {
        $dbs = $this->__extractObject('db');

        if (count($dbs) > 0) {
            foreach ($dbs as $i => $db) {
                $test = $db;
                if ($test->getTable() != $dbToInsert->getTable()) {
                    unset($test);
                } else {
                    break;
                }
            }
        }

        if (isset($test)) {
            $this->updateDb($dbToInsert);
        } else {
            $this->appendDb($dbToInsert);
        }

        return true;
    }


    public function __extractObject($type)
    {
        $jsonArray = $this->__extract($type);

        $objects = [***REMOVED***;

        if (count($jsonArray) > 0) {
            foreach ($jsonArray as $i => $v) {
                $class = sprintf('\Gear\ValueObject\%s', ucfirst($type));
                $objects[***REMOVED*** = new $class($v);
            }
        }
        return $objects;
    }

    public function __extract($type)
    {
        $json = $this->getJsonFromFile();
        $json = $this->decode($json);
        $data = $json[$this->getModule()->getModuleName()***REMOVED***[$type***REMOVED***;
        return $data;
    }

    public function overwrite($toOverwrite)
    {

        if ($toOverwrite instanceof \Gear\ValueObject\Controller) {
            $this->replaceController($toOverwrite);
            return true;
        }

    }

    public function replaceWithOverwrite($serviceName, $object, $place)
    {
        $decode = $this->decode($this->getJsonFromFile());
        $decode[$this->getModule()->getModuleName()***REMOVED***[$serviceName***REMOVED***[$place***REMOVED*** = $object->export();
        $this->setFileFromJson($this->encode($decode));
    }

    public function replaceController(\Gear\ValueObject\Controller $controller)
    {
        $controllers = $this->__extract('controller');
        foreach ($controllers as $i => $controllerArray) {
            $controllerToReplace = new \Gear\ValueObject\Controller($controllerArray);
            if ($controllerToReplace->getName() == $controller->getName()) {

                $this->replaceWithOverwrite('controller', $controller, $i);

                break;
            }
        }
    }


    public function getControllerByName($controllerName)
    {
        $controllers = $this->__extract('controller');

        foreach ($controllers as $controllerArray) {
            $controller = new \Gear\ValueObject\Controller($controllerArray);
            if ($controller->getName() == $controllerName) {
                break;
            } else {
                unset($controller);
            }
        }
        return (isset($controller)) ? $controller : null;
    }


    public function getJsonFromFile()
    {
        return file_get_contents($this->getJson());
    }

    public function setFileFromJson($json)
    {
        $data = file_put_contents($this->getJson(), $json);
        return $data;
    }

    public function insertSrc($singleJson)
    {
        return $this->insertController($this->decode($this->getJsonFromFile()), $singleJson, 'src');
    }

    public function addController($controller)
    {
        $json = \Zend\Json\Json::decode($this->getJsonFromFile(), 1);
        return $this->insertController($json, $controller, 'controller');
    }

    public function insertController($json, $singleJson, $context = 'controller')
    {

        $module = $this->getModule()->getModuleName();

        $controllers = $json[$this->getModule()->getModuleName()***REMOVED***[$context***REMOVED***;

        if (!is_array($controllers)) {
            throw new \Gear\Exception\JsonMalformedException();
        }

        $update = false;

        if (count($controllers) > 0) {
            foreach ($controllers as $i => $v) {
                if ($v['name'***REMOVED*** == $singleJson['name'***REMOVED***) {

                    if (isset($singleJson['type'***REMOVED***)) {
                        if ($v['type'***REMOVED*** == $singleJson['type'***REMOVED***) {
                            $update = $i;
                            break;
                        } else {
                            continue;
                        }
                    } else {
                        $update = $i;
                        break;
                    }
                }
            }
        }

        if (!$update) {

            $newController = array_merge($controllers, array($singleJson));
            $json[$this->getModule()->getModuleName()***REMOVED***[$context***REMOVED*** = $newController;
        } else {
            //do update stuff
        }


        $this->setFileFromJson($this->encode($json));

        return $json;
    }



    public function getJson()
    {
        return $this->getModule()->getMainFolder() . '/'.$this->getName();
    }

    public function encode($json)
    {
        return \Zend\Json\Json::encode($json, 1);
    }

    public function decode($json)
    {
        return \Zend\Json\Json::decode($json, 1);
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }
}
