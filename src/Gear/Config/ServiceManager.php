<?php
namespace Gear\Config;

use Gear\Service\AbstractService;
use Gear\ValueObject\BasicModuleStructure;

class ServiceManager {

    protected $module;

    protected $servicemanager;

    protected $pattern;

    protected $callable;


    public function __construct(BasicModuleStructure $module)
    {
        $this->module = $module;
    }

    public function getCallable()
    {
        $service = $this->servicemanager[$this->pattern***REMOVED***[0***REMOVED***;

        switch ($this->pattern) {
        	case 'factories':
        	    $this->callable = $service['callable'***REMOVED***;
        	    break;
        	case 'invokables':
        	    $this->callable = sprintf('%s\%s\%s', $service['module'***REMOVED***, $service['type'***REMOVED***, $service['name'***REMOVED***);
        	    break;
        }

        return $this->callable;
    }

    public function getObject()
    {
        switch ($this->pattern) {
        	case 'factories':

        	    break;

        	case 'invokables':

        	    break;
        }

    }

    public function getArray()
    {
        return $this->servicemanager;
    }

    public function extractServiceManagerFromSrc($srcObject)
    {
        $controllers = array();

        if ($srcObject->getType() == null) {

            $callable = sprintf('%s\%s\%s', $this->module->getModuleName(), $srcObject->getNamespace(), $srcObject->getName());
            $object = sprintf('%s\%s\%sFactory', $this->module->getModuleName(), $srcObject->getNamespace(), $srcObject->getName());

            $controllers['factories'***REMOVED***[***REMOVED*** = array(
                'callable' => $callable,
                'object' => $object,
            );
        } elseif ($srcObject->getType() == 'Factory' || $srcObject->getType() == 'SearchFactory') {

            $this->pattern = 'factories';

            $typeCall   = ($srcObject->getType() == 'SearchFactory') ? 'Form\Search' : $srcObject->getType();
            $typeObject = ($srcObject->getType() == 'SearchFactory') ? 'Factory' : $srcObject->getType();

            if ($srcObject->getType() == 'Factory') {
                $nameCall = $srcObject->getName();
            } elseif ($srcObject->getType() == 'SearchFactory') {
                $nameCall = str_replace('Factory', 'Form', $srcObject->getName());
            }


            $callable = sprintf('%s\%s\%s', $this->module->getModuleName(), $typeCall, $nameCall);
            $object = sprintf('%s\%s\%s', $this->module->getModuleName(), $typeObject, $srcObject->getName());

            $controllers['factories'***REMOVED***[***REMOVED*** = array(
                'callable' => $callable,
                'object' => $object,
            );

        } else {

            $this->pattern = 'invokables';

            if ( $srcObject->getType() == 'Entity') {
                $aliase = str_replace('Entity', '', $srcObject->getName());
                $controllers['invokables'***REMOVED***[***REMOVED*** = array(
                    'module' => $this->module->getModuleName(),
                    'name' => $srcObject->getName(),
                    'type' => $srcObject->getType(),
                    'aliase' => $aliase
                );
            } else {
                $controllers['invokables'***REMOVED***[***REMOVED*** = array(
                    'module' => $this->module->getModuleName(),
                    'name' => $srcObject->getName(),
                    'type' => $srcObject->getType()
                );
            }
        }

        $this->servicemanager = $controllers;
        return $this;
    }

}
