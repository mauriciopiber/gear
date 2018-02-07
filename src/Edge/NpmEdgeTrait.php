<?php
namespace Gear\Edge;

use Gear\Edge\NpmEdgeFactory;

trait NpmEdgeTrait
{
    protected $npmEdge;

    public function getNpmEdge()
    {
        if (!isset($this->npmEdge)) {
            $name = 'Gear\Edge\NpmEdge';
            $this->npmEdge = $this->getServiceLocator()->get($name);
        }
        return $this->npmEdge;
    }

    public function setNpmEdge(
        NpmEdge $npmEdge
    ) {
        $this->npmEdge = $npmEdge;
        return $this;
    }
}
