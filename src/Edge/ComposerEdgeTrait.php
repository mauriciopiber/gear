<?php
namespace Gear\Edge;

use Gear\Edge\ComposerEdgeFactory;

trait ComposerEdgeTrait
{
    protected $composerEdge;

    public function getComposerEdge()
    {
        if (!isset($this->composerEdge)) {
            $name = 'Gear\Edge\ComposerEdge';
            $this->composerEdge = $this->getServiceLocator()->get($name);
        }
        return $this->composerEdge;
    }

    public function setComposerEdge(
        ComposerEdge $composerEdge
    ) {
        $this->composerEdge = $composerEdge;
        return $this;
    }
}
