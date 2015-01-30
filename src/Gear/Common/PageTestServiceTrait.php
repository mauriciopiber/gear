<?php
namespace Gear\Common;

trait PageTestServiceTrait {

    protected $pageTestService;

    public function getPageTestService()
    {
        if (!isset($this->pageTestService)) {
            $this->pageTestService = $this->getServiceLocator()->get('pageTestService');
        }
        return $this->pageTestService;
    }

    public function setPageTestService($pageTestService)
    {
        $this->pageTestService = $pageTestService;
        return $this;
    }
}
