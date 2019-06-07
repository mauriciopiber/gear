<?php
namespace Gear\Mvc\Spec\Page;

use Gear\Mvc\Spec\Page\Page;

trait PageTrait
{
    protected $page;

    public function getPage()
    {
        return $this->page;
    }

    public function setPage(
        Page $page
    ) {
        $this->page = $page;
        return $this;
    }
}
