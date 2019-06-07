<?php
namespace Gear\Edge\Npm;

use Gear\Edge\Npm\NpmEdgeFactory;

trait NpmEdgeTrait
{
    protected $npmEdge;

    public function getNpmEdge()
    {
        return $this->npmEdge;
    }

    public function setNpmEdge(
        NpmEdge $npmEdge
    ) {
        $this->npmEdge = $npmEdge;
        return $this;
    }
}
