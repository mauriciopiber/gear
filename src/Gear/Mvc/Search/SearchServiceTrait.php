<?php
namespace Gear\Mvc\Search;

use Gear\Mvc\Search\SearchService;

trait SearchServiceTrait
{
    protected $searchService;

    public function getSearchService()
    {
        if (!isset($this->searchService)) {
            $this->searchService = $this->getServiceLocator()->get('Gear\Mvc\Search\SearchService');
        }
        return $this->searchService;
    }

    public function setSearchService(SearchService $searchService)
    {
        $this->searchService = $searchService;
        return $this;
    }
}
