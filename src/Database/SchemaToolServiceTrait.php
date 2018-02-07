<?php
namespace Gear\Database;

use Gear\Database\SchemaToolService;

trait SchemaToolServiceTrait
{
    protected $schemaToolService;

    public function getSchemaToolService()
    {
        if (!isset($this->schemaToolService)) {
            $this->schemaToolService = $this->getServiceLocator()->get('Gear\Database\SchemaTool');
        }
        return $this->schemaToolService;
    }

    public function setSchemaToolService(SchemaToolService $schemaToolService)
    {
        $this->schemaToolService = $schemaToolService;
        return $this;
    }
}
