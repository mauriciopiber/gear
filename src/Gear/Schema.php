<?php
namespace Gear;

use Gear\ValueObject\Config\Config;

class Schema
{
    protected $config;

    protected $name = 'schema/module.json';

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Função responsável por iniciar um novo schema
     */
    public function init()
    {
        return array($this->getConfig()->getModule() => array('db' => array(), 'src' => array(), 'controller' => array()));
    }

    public function appendDb(\Gear\ValueObject\Db $dbToInsert)
    {
        $db = $this->__extract('db');

        $db[***REMOVED*** = $dbToInsert->export();

        $schema = $this->decode($this->getJsonFromFile());

        $schema[$this->getConfig()->getModule()***REMOVED***['db'***REMOVED*** = $db;

        $this->persistSchema($schema);
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

    public function __extractObject($type)
    {
        $jsonArray = $this->__extract($type);
        $objects = [***REMOVED***;

        if (count($jsonArray) > 0) {
            foreach ($jsonArray as $i => $v) {
                $class = sprintf('\Gear\ValueObject\%s', strtoupper($type));
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

}
