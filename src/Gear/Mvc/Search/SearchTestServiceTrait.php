<?php
namespace Gear\Mvc\Search;

use Gear\Mvc\Search\SearchTestService;

trait SearchTestServiceTrait {

    protected $searchTestService;

    public function getSearchTestService()
    {
        if (!isset($this->searchTestService)) {
            $this->searchTestService = $this->getServiceLocator()->get('searchTestService');
        }
        return $this->searchTestService;
    }

    public function setSearchTestService(SearchTestService $searchTestService)
    {
        $this->searchTestService = $searchTestService;
        return $this;
    }
}
