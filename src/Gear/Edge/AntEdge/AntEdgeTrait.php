<?php
namespace Gear\Edge\AntEdge;

use Gear\Edge\AntEdge\AntEdge;

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
