<?php
namespace Gear\Database;

use Gear\Database\SchemaToolService;

trait SchemaToolServiceTrait
{
    protected $schemaToolService;

    public function getSchemaToolService()
    {
        return $this->schemaToolService;
    }

    public function setSchemaToolService(SchemaToolService $schemaToolService)
    {
        $this->schemaToolService = $schemaToolService;
        return $this;
    }
}
