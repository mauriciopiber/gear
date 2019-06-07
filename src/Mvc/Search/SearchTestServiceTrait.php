<?php
namespace Gear\Mvc\Search;

use Gear\Mvc\Search\SearchTestService;

trait SearchTestServiceTrait
{
    protected $searchTestService;

    public function getSearchTestService()
    {
        return $this->searchTestService;
    }

    public function setSearchTestService(SearchTestService $searchTestService)
    {
        $this->searchTestService = $searchTestService;
        return $this;
    }
}
