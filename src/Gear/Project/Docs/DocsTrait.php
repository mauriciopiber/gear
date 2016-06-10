<?php
namespace Gear\Project\Docs;

use Gear\Project\Docs\DocsFactory;

trait DocsTrait
{
    protected $docs;

    public function getDocs()
    {
        if (!isset($this->docs)) {
            $name = 'Gear\Project\Docs\Docs';
            $this->docs = $this->getServiceLocator()->get($name);
        }
        return $this->docs;
    }

    public function setDocs(
        Docs $docs
    ) {
        $this->docs = $docs;
        return $this;
    }
}
