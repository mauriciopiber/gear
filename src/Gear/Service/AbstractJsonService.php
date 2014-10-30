<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractService;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\EventManager\EventManagerAwareInterface;

abstract class AbstractJsonService extends AbstractService implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    protected $jsonService;

    protected $jsonSchema;

    public function __construct()
    {
        $this->getEventManager()->trigger('init', $this, array());
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
        $schema = \Zend\Json\Json::decode(file_get_contents($this->getJson()), 1);


        return \Zend\Json\Json::decode(file_get_contents($this->getJson()), 1);
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
