<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar e deletar os componentes do arquivo json quando for necessário
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Gear\ValueObject\Controller;
use Gear\ValueObject\Action;

class JsonService extends AbstractJsonService
{
    public function createNewSrcJson()
    {
        $factory = new \stdClass();
        $factory->name = 'myNewfactory';
        $factory->type = 'Factory';
    }

    public function findControllerKey($haystack, $needle)
    {
        $find = false;

        foreach ($haystack as $i => $controller) {


            if ($controller['name'***REMOVED*** == $needle) {

                $find = $i;
                break;
            }
        }

        return $find;

    }

    public function insertAction($json, $singleJson)
    {

        $controllers = $json[$this->getConfig()->getModule()***REMOVED***['controller'***REMOVED***;

        $key = $this->findControllerKey($controllers, $singleJson['controller'***REMOVED***);

        $actions = $controllers[$key***REMOVED***['actions'***REMOVED***;

        if ($actions == null) {
            $actions = $singleJson;

            $controllers[$key***REMOVED***['actions'***REMOVED*** = array($actions);

            $json[$this->getConfig()->getModule()***REMOVED***['controller'***REMOVED*** = $controllers;
        } else {
            $actions = array_merge(array($singleJson), $actions);
            $controllers[$key***REMOVED***['actions'***REMOVED*** = $actions;
            $json[$this->getConfig()->getModule()***REMOVED***['controller'***REMOVED*** = $controllers;
        }
        return $json;
    }

    public function insertController($json, $singleJson)
    {
        $controllers = $json[$this->getConfig()->getModule()***REMOVED***['controller'***REMOVED***;

        $update = false;

        foreach ($controllers as $i => $v) {
            if ($v['name'***REMOVED*** == $singleJson['name'***REMOVED***) {
                $update = $i;
                break;

            }
        }
        if (!$update) {
            $newController = array_merge($controllers, array($singleJson));
        } else {
            //do update stuff
        }

        $json[$this->getConfig()->getModule()***REMOVED***['controller'***REMOVED*** = $newController;

        return $json;
    }

    public function insertIntoJson($json, $dataToInsert)
    {
        $singleJson = $dataToInsert->export();

        $jsonToReturn = null;

        if ($dataToInsert instanceof Controller) {
            $jsonToReturn = $this->insertController($json, $singleJson);
        } elseif($dataToInsert instanceof Action) {
            $jsonToReturn = $this->insertAction($json, $singleJson);
        }


        return $jsonToReturn;
    }

    public function loadFromFile($location)
    {

        if (is_file($location)) {
            return file_get_contents($location);
        }

        return null;

    }

    public function isValid()
    {
        return true;
    }

    public function createNewPageJson()
    {

        $page = new \stdClass();
        $page->controllerName = '';
        $page->serviceManager = '';
        //$page

    }

    public function createNewDbJson()
    {

    }

    public function decode($data)
    {
        return \Zend\Json\Json::decode($data, 1);
    }

    public function encode($data)
    {
        return \Zend\Json\Json::encode($data, 1);
        //return \Zend\Json\Json::encode($data);
    }

    public function registerJson()
    {
        $arrayToJson = $this->createNewModuleJson();

        $json = \Zend\Json\Json::encode($arrayToJson);

        $file = $this->writeJson($json);

        if ($file) {
            return true;
        } else {
            return false;
        }
    }


    public function getActionZero()
    {
        return array(
        	'name' => 'index',
            'route' => $this->str('url', $this->getConfig()->getModule()).'/index',
            'role' => 'guest'
        );
    }

    public function getControllerZero($actions = array())
    {
        return array(
        	'name' => 'IndexController',
            'object' => 'Controller\Index',
            'actions' => $actions
        );

    }


    public function setPage($page)
    {
        $indexController = new \stdClass();
        $indexController->name = $page->getName();
        $indexController->object  =  $page->getService()->getObject();
        $indexController->actions = $page->getActions();

        return $indexController;
    }

    public function createNewModuleJson()
    {
        $index = $this->getControllerZero(array($this->getActionZero()));

        return array(
            $this->getConfig()->getModule() => array(
                'src' => array(),
                'controller' => array(
                    $index
                ),
                'db' => array()
            )
        );
    }

    public function writeJson($json)
    {
        return $this->getFileService()->mkJson(
            $this->getConfig()->getModuleFolder().'/schema/',
            'module',
            $json
        );
    }

    public function dump($type = 'array')
    {
        $file = $this->getJson();

        if ($type == 'array') {
            return print_r(\Zend\Json\Json::decode(file_get_contents($file)), true);
        } elseif ($type == 'json') {
            return file_get_contents($file);
        } else {
            return '0';
        }
    }
}
