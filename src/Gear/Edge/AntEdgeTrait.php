<?php
namespace Gear\Edge;

use Gear\Edge\AntEdgeFactory;

trait AntEdgeTrait
{
    protected $antEdge;

    public function getAntEdge()
    {
        if (!isset($this->antEdge)) {
            $name = 'Gear\Edge\AntEdge';
            $this->antEdge = $this->getServiceLocator()->get($name);
        }
        return $this->antEdge;
    }

    public function setAntEdge(
        AntEdge $antEdge
    ) {
        $this->antEdge = $antEdge;
        return $this;
    }
}
