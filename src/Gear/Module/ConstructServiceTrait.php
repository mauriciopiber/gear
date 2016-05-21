<?php
namespace Gear\Module;

use Gear\Module\ConstructService;

trait ConstructServiceTrait
{
    protected $constructService;

    public function getConstructService()
    {
        if (!isset($this->constructService)) {
            $this->constructService = $this->getServiceLocator()->get('Gear\Module\Construct');
        }
        return $this->constructService;
    }

    public function setConstructService(ConstructService $constructService)
    {
        $this->constructService = $constructService;
        return $this;
    }
}
