<?php
namespace Gear\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Attribute extends AbstractHelper
{

    protected $serviceLocator;

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator($stringService)
    {
        $this->serviceLocator = $stringService;
        return $this;
    }


    public function __invoke($dependencies)
    {
        return '';
    }
}
