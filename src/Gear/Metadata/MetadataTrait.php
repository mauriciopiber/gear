<?php
namespace Gear\Metadata;

trait MetadataTrait
{
    protected $metadata;

    public function getMetadata()
    {
        if (!isset($this->metadata)) {
            $this->metadata = $this->getServiceLocator()->get('Gear\Factory\Metadata');
        }
        return $this->metadata;
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }
}
