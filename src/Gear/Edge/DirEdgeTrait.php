<?php
namespace Gear\Edge;

use Gear\Edge\DirEdgeFactory;

trait DirEdgeTrait
{
    protected $dirEdge;

    public function getDirEdge()
    {
        if (!isset($this->dirEdge)) {
            $name = 'Gear\Edge\DirEdge';
            $this->dirEdge = $this->getServiceLocator()->get($name);
        }
        return $this->dirEdge;
    }

    public function setDirEdge(
        DirEdge $dirEdge
    ) {
        $this->dirEdge = $dirEdge;
        return $this;
    }
}
