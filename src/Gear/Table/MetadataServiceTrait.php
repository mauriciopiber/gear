<?php
namespace Gear\Table;

use Gear\Table\MetadataService;

trait MetadataServiceTrait
{
    protected $metadataService;

    public function getMetadataService()
    {
        if (!isset($this->metadataService)) {
            $name = 'Gear\Table\MetadataService';
            $this->metadataService = $this->getServiceLocator()->get($name);
        }
        return $this->metadataService;
    }

    public function setMetadataService(
        MetadataService $metadataService
    ) {
        $this->metadataService = $metadataService;
        return $this;
    }
}
