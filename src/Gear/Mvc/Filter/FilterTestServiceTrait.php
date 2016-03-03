<?php
namespace Gear\Mvc\Filter;

use Gear\Mvc\Filter\FilterTestService;

trait FilterTestServiceTrait
{
    protected $filterTestService;

    public function getFilterTestService()
    {
        if (!isset($this->filterTestService)) {
            $this->filterTestService = $this->getServiceLocator()->get('Gear\Mvc\Filter\FilterTestService');
        }
        return $this->filterTestService;
    }

    public function setFilterTestService(FilterTestService $filterService)
    {
        $this->filterTestService = $filterService;
        return $this;
    }
}
