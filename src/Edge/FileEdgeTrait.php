<?php
namespace Gear\Edge;

use Gear\Edge\FileEdgeFactory;

trait FileEdgeTrait
{
    protected $fileEdge;

    public function getFileEdge()
    {
        if (!isset($this->fileEdge)) {
            $name = 'Gear\Edge\FileEdge';
            $this->fileEdge = $this->getServiceLocator()->get($name);
        }
        return $this->fileEdge;
    }

    public function setFileEdge(
        FileEdge $fileEdge
    ) {
        $this->fileEdge = $fileEdge;
        return $this;
    }
}
