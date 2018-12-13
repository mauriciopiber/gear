<?php
namespace Gear\Mvc\Spec\Page;

use Gear\Mvc\Spec\Page\Page;

trait PageTrait
{
    protected $page;

    public function getPage()
    {
        if (!isset($this->page)) {
            $this->page = $this->getServiceLocator()->get(Page::class);
        }
        return $this->page;
    }

    public function setPage(
        Page $page
    ) {
        $this->page = $page;
        return $this;
    }
}
