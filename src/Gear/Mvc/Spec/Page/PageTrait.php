<?php
namespace Gear\Mvc\Spec\Page;

use Gear\Mvc\Spec\Page\PageFactory;

trait PageTrait
{
    protected $page;

    public function getPage()
    {
        if (!isset($this->page)) {
            $name = 'Gear\Mvc\Spec\Page\Page';
            $this->page = $this->getServiceLocator()->get($name);
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
