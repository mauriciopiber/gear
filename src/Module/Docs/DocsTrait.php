<?php
namespace Gear\Module\Docs;

use Gear\Module\Docs\DocsFactory;

trait DocsTrait
{
    protected $docs;

    public function getDocs()
    {
        return $this->docs;
    }

    public function setDocs(
        Docs $docs
    ) {
        $this->docs = $docs;
        return $this;
    }
}
