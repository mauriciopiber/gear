<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar e deletar os componentes do arquivo json quando for necessário
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractService;

class JsonService extends AbstractService
{

    public function getJson()
    {
        return $this->getConfig()->getModuleFolder().'/schema/module.json';
    }

    public function insertIntoJson($factory)
    {

        var_dump($factory);
    }

    public function addSrc()
    {

    }

    public function createModuleJson()
    {
        return array(
            $this->getConfig()->getModule() => array(
                'src' => array(),
                'page' => array(
                    array(
                        'controller' => 'IndexController',
                        'action' => 'indexAction'
                    )
                ),
                'db' => array()
            )
        );
    }


    public function writeJson()
    {
        $arrayToJson = $this->createModuleJson();

        $json = \Zend\Json\Json::encode($arrayToJson);

        $file = $this->getFileService()->mkJson(
            $this->getConfig()->getModuleFolder().'/schema/',
            'module',
            $json
        );

        if ($file) {
            return true;
        } else {
            return false;
        }
    }

    public function dump($type = 'array')
    {
        $file = $this->getJson();

        if($type == 'array') {
            return print_r(\Zend\Json\Json::decode(file_get_contents($file)),true);
        } elseif ($type == 'json') {
            return file_get_contents($file);
        } else {
            return '0';
        }
    }
}
