<?php
namespace Gear\Mvc\Filter;

use Gear\Mvc\Filter\FilterService;

trait FilterServiceTrait
{
    protected $filterService;

    public function getFilterService()
    {
        return $this->filterService;
    }

    public function setFilterService(FilterService $filterService)
    {
        $this->filterService = $filterService;
        return $this;
    }
}
