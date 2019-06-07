<?php
namespace Gear\Table\Metadata;

trait MetadataTrait
{
    protected $metadata;

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }
}
