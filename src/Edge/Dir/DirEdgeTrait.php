<?php
namespace Gear\Edge\Dir;

use Gear\Edge\Dir\DirEdgeFactory;

trait DirEdgeTrait
{
    protected $dirEdge;

    public function getDirEdge()
    {
        return $this->dirEdge;
    }

    public function setDirEdge(
        DirEdge $dirEdge
    ) {
        $this->dirEdge = $dirEdge;
        return $this;
    }
}
