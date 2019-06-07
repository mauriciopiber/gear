<?php
namespace Gear\Edge\File;

use Gear\Edge\File\FileEdgeFactory;

trait FileEdgeTrait
{
    protected $fileEdge;

    public function getFileEdge()
    {
        return $this->fileEdge;
    }

    public function setFileEdge(
        FileEdge $fileEdge
    ) {
        $this->fileEdge = $fileEdge;
        return $this;
    }
}
