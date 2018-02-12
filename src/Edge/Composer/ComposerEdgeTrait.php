<?php
namespace Gear\Edge\Composer;

use Gear\Edge\Composer\ComposerEdgeFactory;

trait ComposerEdgeTrait
{
    protected $composerEdge;

    public function getComposerEdge()
    {
        if (!isset($this->composerEdge)) {
            $name = 'Gear\Edge\Composer\ComposerEdge';
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
