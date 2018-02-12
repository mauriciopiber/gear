<?php
namespace Gear\Edge\Dir;

use Gear\Edge\Dir\DirEdgeFactory;

trait DirEdgeTrait
{
    protected $dirEdge;

    public function getDirEdge()
    {
        if (!isset($this->dirEdge)) {
            $name = 'Gear\Edge\Dir\DirEdge';
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
