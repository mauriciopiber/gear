<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractService;

abstract class AbstractJsonService extends AbstractService
{
    protected $jsonService;

    protected $jsonSchema;



    public function updateServiceManager()
    {
        $json = \Zend\Json\Json::decode(file_get_contents($this->getJson()));

        $module = &$json->{$this->getConfig()->getModule()};

        if (is_array($module->src)) {

            if (count($module->src)>0) {

                $this->createFileFromTemplate(
                    'template/config/servicemanager',
                    array(
                        'module' => $this->getConfig()->getModule(),
                        'factories' => $module->src
                    ),
                    'servicemanager.config.php',
                    $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
                );

            }
        }
    }


    public function createModuleJson(array $src = array(), $page = array(), $db = array())
    {
        return array(
            $this->getConfig()->getModule() => array(
                'src' => $src,
                'page' => $page,
                'db' => $db
            )
        );
    }

    /**
     * A grande questão! Como o json é resolvido ao trabalhar com o PHP? ele fica com stdClass ou precisa ser convertido?
     *
     */
    public function saveJsonBySrc($src)
    {
        $json = $this->getJson();

        $getOldFile = file_get_contents($json);

        $toArray = \Zend\Json\Json::decode($getOldFile);

        $module = &$toArray->{$this->getConfig()->getModule()};

        if (is_array($module->src)) {

            if (count($module->src)>0) {

                foreach ($module->src as $i => $srcItem) {
                    if ($srcItem->name == $src->getName()) {
                        return sprintf('%s as already set for %s'."\n", $src->getName(), $this->getConfig()->getModule());
                    }
                }
            }

            $std = new \stdClass();
            $std->name = $this->str('class', $src->getName());
            $std->type = $this->str('class', $src->getType());
            $module->src[***REMOVED*** = $std;
            //$module->src[$std***REMOVED***;
        }

        $moduleJson = $this->createModuleJson($module->src, $module->page, $module->db);

        $toArray = \Zend\Json\Json::encode($moduleJson);

        $file = $this->getFileService()->mkJson(
            $this->getConfig()->getModuleFolder().'/schema/',
            'module',
            $toArray
        );

        return  sprintf('%s for %s created', $src->getName(), $this->getConfig()->getModule())."\n";
    }

    public function findControllerArray($page)
    {
        $module = $this->getConfig()->getModule();

        $pages = &$this->getJsonSchema()->$module->page;

        $tempController = null;

        /** @var $tempId Acts like a catcher of the id in array to replace if controller already exists */
        $tempId = null;

        foreach ($pages as $id => $controller) {
            if (
            $controller->controller == $page['controller'***REMOVED***
            || $controller->invokable == $page['invokable'***REMOVED***
            ) {
                $tempController = &$controller;
                $tempId = $id;
                break;
            }
            continue;
        }

        return array($tempController,$tempId);
    }

    public function getSchema()
    {
        return \Zend\Json\Json::decode(file_get_contents($this->getJson()));
    }

    public function getJson()
    {
        return $this->getConfig()->getModuleFolder().'/schema/module.json';
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

}
