<?php
namespace Gear\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Str extends AbstractHelper
{
    protected $strService;
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

    public function getStrService()
    {
        if (!isset($this->strService)) {
            $this->strService = $this->getServiceLocator()->get('stringService');
        }
        return $this->strService;
    }

    public function __invoke($type, $str)
    {
        return $this->getStrService()->str($type, $str);
    }
}
