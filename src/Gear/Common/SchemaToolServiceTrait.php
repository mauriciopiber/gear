<?php
namespace Gear\Common;

use Gear\Service\Mvc\SchemaToolService;

trait SchemaToolServiceTrait {

    protected $schemaToolService;

    public function getSchemaToolService()
    {
        if (!isset($this->schemaToolService)) {
            $this->schemaToolService = $this->getServiceLocator()->get('Gear\Service\Db\SchemaTool');
        }
        return $this->schemaToolService;
    }

    public function setSchemaToolService(SchemaToolService $schemaToolService)
    {
        $this->schemaToolService = $schemaToolService;
        return $this;
    }
}
