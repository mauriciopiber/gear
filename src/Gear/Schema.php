<?php
namespace Gear;

use Gear\ValueObject\Config\Config;
use Zend\Db\Metadata\Metadata;
use Zend\ServiceManager\ServiceLocatorInterface;

class Schema
{
    protected $config;

    protected $name = 'schema/module.json';

    protected $serviceLocator;

    public function __construct(Config $config, ServiceLocatorInterface $serviceLocator)
    {
        $this->config = $config;
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Função responsável por iniciar um novo schema
     */
    public function init()
    {
        return array($this->getConfig()->getModule() => array('db' => array(), 'src' => array(), 'controller' => array()));
    }

    public function extractColumnsFromTable($db)
    {

        /* $metadata = new \Zend\Db\Metadata\Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));


        $columns = $metadata->getColumns($db->getTableUnderscore());

        foreach ($columns as $i => $column) {


            $column = new \Gear\ValueObject\Column();

        }
 */





        return $db;

    }

    public function checkSchemaAlreadySet($db, $srcSet, $controllers)
    {
        $dbSchema         = $this->__extractObject('db');
        $controllerSchema = $this->__extractObject('controller');
        $srcSchema        = $this->__extractObject('src');

        foreach ($dbSchema as $dbRow) {
            $name = $dbRow->getTable();
            if ($name == $db->getTable()) {
                throw new \Exception(sprintf('DB %s já está cadastrado no schema do módulo %s', $name, $this->getConfig()->getModule()));
            }
        }

        foreach ($controllerSchema as $controllerRow) {
            $name = $controllerRow->getName();
            if ($name == $controllers->getName()) {
                throw new \Exception(sprintf('Controller %s já está cadastrado no schema do módulo %s', $name, $this->getConfig()->getModule()));
            }
        }

        foreach ($srcSchema as $srcRow) {
            $name = $srcRow->getName();

            foreach ($srcSet as $src) {
                if ($name == $src->getName()) {
                    throw new \Exception(sprintf('Src %s já está cadastrado no schema do módulo %s', $name, $this->getConfig()->getModule()));
                }
            }
        }

        return true;
    }

    public function appendDb(\Gear\ValueObject\Db $dbToInsert)
    {
        $controllerToInsert = $dbToInsert->makeController();

        $srcToInsert = $dbToInsert->makeSrc();

        $dbToInsert = $this->extractColumnsFromTable($dbToInsert);


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
            $schema[$this->getConfig()->getModule()***REMOVED***['db'***REMOVED*** = $db;
            $schema[$this->getConfig()->getModule()***REMOVED***['controller'***REMOVED*** = $controller;
            $schema[$this->getConfig()->getModule()***REMOVED***['src'***REMOVED*** = $src;



            return $this->persistSchema($schema);
        } else {
            return false;
        }
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
            if ($src->getType() == $type && $src->getDb() == $db->getTable()) {
                return $src;
            }
        }
        throw new Exception(sprintf('Src não encontrado para tabela %s', $db->getTable()));

    }

    public function persistSchema($schema)
    {
        return file_put_contents($this->getConfig()->getModuleFolder().'/'.$this->getName(), $this->encode($schema));
    }


    public function insertDb(\Gear\ValueObject\Db $dbToInsert)
    {

        $dbs = $this->__extractObject('db');

        if (count($dbs) > 0) {
            foreach ($dbs as $i => $db) {

                $test = $db;

                if ($test->getTable() != $dbToInsert->getTable()) {
                    unset($test);
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

    public function updateDb($db)
    {
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
        $data = $json[$this->getConfig()->getModule()***REMOVED***[$type***REMOVED***;
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
        $decode[$this->getConfig()->getModule()***REMOVED***[$serviceName***REMOVED***[$place***REMOVED*** = $object->export();
        $this->setFileFromJson($this->encode($decode));
    }

    public function replaceController(\Gear\ValueObject\Controller $controller)
    {
        $controllers = $this->__extract('controller');
        foreach($controllers as $i => $controllerArray) {
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

        foreach($controllers as $controllerArray) {
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
        //var_dump($json);
        //var_dump($data);
        return $data;

    }



    public function getJson()
    {
        return $this->getConfig()->getModuleFolder() . '/'.$this->getName();
    }

    public function encode($json)
    {
        return \Zend\Json\Json::encode($json, 1);
    }

    public function decode($json)
    {
        return \Zend\Json\Json::decode($json, 1);
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
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
