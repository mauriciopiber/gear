<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar e deletar os componentes do arquivo json quando for necessário
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;

class JsonService extends AbstractJsonService
{

    public function getJson()
    {
        return $this->getConfig()->getModuleFolder().'/schema/module.json';
    }



    public function createModuleJson()
    {
        $indexAction = new \stdClass();
        $indexAction->action = 'index';
        $indexAction->route      = $this->str('url', $this->getConfig()->getModule()).'/index';
        $indexAction->role       = 'guest';

        $indexController = new \stdClass();
        $indexController->controller = 'IndexController';
        $indexController->invokable  = '%s\Controller\Index';
        $indexController->actions = array($indexAction);


        return array(
            $this->getConfig()->getModule() => array(
                'src' => array(),
                'page' => array(
                    $indexController
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

    public function registerJson()
    {
        $arrayToJson = $this->createModuleJson();

        $json = \Zend\Json\Json::encode($arrayToJson);

        $file = $this->writeJson($json);

        if ($file) {
            return true;
        } else {
            return false;
        }
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
