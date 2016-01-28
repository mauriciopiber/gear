<?php
namespace Gear\Service\Constructor;

use Gear\Service\Constructor\PageService;

trait PageServiceTrait
{
    protected $pageService;

    public function setPageService(PageService $pageService)
    {
        $this->pageService = $pageService;
        return $this;
    }

    public function getPageService()
    {
        if (!isset($this->pageService)) {
            $this->pageService = $this->getServiceLocator()->get('pageConstructor');
        }
        return $this->pageService;
    }
}
