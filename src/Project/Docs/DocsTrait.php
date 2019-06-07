<?php
namespace Gear\Project\Docs;

use Gear\Project\Docs\DocsFactory;

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
