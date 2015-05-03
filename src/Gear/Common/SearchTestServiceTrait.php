<?php
namespace Gear\Common;

trait SearchTestServiceTrait {

    protected $searchTestService;

    public function getSearchTestService()
    {
        if (!isset($this->searchTestService)) {
            $this->searchTestService = $this->getServiceLocator()->get('searchTestService');
        }
        return $this->searchTestService;
    }

    public function setSearchTestService($searchTestService)
    {
        $this->searchTestService = $searchTestService;
        return $this;
    }
}
