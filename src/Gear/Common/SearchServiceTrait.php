<?php
namespace Gear\Common;

trait SearchServiceTrait {

    protected $searchService;

    public function getSearchService()
    {
        if (!isset($this->searchService)) {
            $this->searchService = $this->getServiceLocator()->get('Gear\Service\Mvc\SearchService');
        }
        return $this->searchService;
    }

    public function setSearchService($searchService)
    {
        $this->searchService = $searchService;
        return $this;
    }

}
