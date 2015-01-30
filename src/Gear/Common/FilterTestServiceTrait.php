<?php
namespace Gear\Common;

trait FilterTestServiceTrait {

    protected $filterTestService;

    public function getFilterTestService()
    {
        if (!isset($this->filterTestService)) {
            $this->filterTestService = $this->getServiceLocator()->get('filterTestService');
        }
        return $this->filterTestService;
    }

    public function setFilterTestService($filterService)
    {
        $this->filterTestService = $filterService;
        return $this;
    }
}
