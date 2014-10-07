<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service\Constructor;

use Gear\Service\AbstractService;
use Gear\Service\Constructor\JsonService;

abstract class AbstractJsonService extends AbstractService
{
    protected $jsonService;

    public function getJson()
    {
        return $this->getConfig()->getModuleFolder().'/schema/module.json';
    }

    public function setJsonService(JsonService $jsonService)
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
}
