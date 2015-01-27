<?php
namespace Gear\Common;

trait FilterServiceTrait {

    protected $filterService;

    public function getFilterService()
    {
        if (!isset($this->filterService)) {
            $this->filterService = $this->getServiceLocator()->get('filterService');
        }
        return $this->filterService;
    }

    public function setFilterService($filterService)
    {
        $this->filterService = $filterService;
        return $this;
    }

}
