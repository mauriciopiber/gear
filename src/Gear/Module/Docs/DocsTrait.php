<?php
namespace Gear\Module\Docs;

use Gear\Module\Docs\DocsFactory;

trait DocsTrait
{
    protected $docs;

    public function getDocs()
    {
        if (!isset($this->docs)) {
            $name = 'Gear\Module\Docs\Docs';
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
