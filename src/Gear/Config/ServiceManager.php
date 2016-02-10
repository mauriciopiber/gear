<?php
namespace Gear\Config;

use Gear\Service\AbstractService;
use Gear\Module\BasicModuleStructure;

class ServiceManager {

    protected $module;

    protected $servicemanager;

    protected $pattern;

    protected $callable;

    public function getPattern()
    {
        return $this->pattern;
    }


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
                return sprintf(
                    '%s\%s\%s',
                    $this->module->getModuleName(),
                    $this->type,
                    $this->name
                );
                break;
        }

    }

    public function getArray()
    {
        return $this->servicemanager;
    }

    public function extractServiceManagerFromSrc($src)
    {
        $controllers = array();

        if ($src->getType() == null) {

            $callable = sprintf('%s\%s\%s', $this->module->getModuleName(), $src->getNamespace(), $src->getName());
            $object = sprintf('%s\%s\%sFactory', $this->module->getModuleName(), $src->getNamespace(), $src->getName());

            $controllers['factories'***REMOVED***[***REMOVED*** = array(
                'callable' => $callable,
                'object' => $object,
            );
        } elseif ($src->getType() == 'Factory' || $src->getType() == 'SearchFactory') {

            $this->pattern = 'factories';

            $typeCall   = ($src->getType() == 'SearchFactory') ? 'Form\Search' : $src->getType();
            $typeObject = ($src->getType() == 'SearchFactory') ? 'Factory' : $src->getType();

            if ($src->getType() == 'Factory') {
                $nameCall = $src->getName();
            } elseif ($src->getType() == 'SearchFactory') {
                $nameCall = str_replace('Factory', 'Form', $src->getName());
            }


            $callable = sprintf('%s\%s\%s', $this->module->getModuleName(), $typeCall, $nameCall);
            $object = sprintf('%s\%s\%s', $this->module->getModuleName(), $typeObject, $src->getName());

            $controllers['factories'***REMOVED***[***REMOVED*** = array(
                'callable' => $callable,
                'object' => $object,
            );

        } else {

            $this->pattern = 'invokables';

            $this->type = !empty($src->getNamespace()) ? $src->getNamespace() : $src->getType();

            if ( $src->getType() == 'Entity') {
                $this->name = str_replace('Entity', '', $src->getName());
            } else {
                $this->name = $src->getName();
            }

           $controllers['invokables'***REMOVED***[***REMOVED*** = array(
                'module' => $this->module->getModuleName(),
                'name' => $this->name,
                'type' => $this->type,
            );
        }

        $this->servicemanager = $controllers;
        return $this;
    }

    public function getService()
    {
       var_dump($this->getCallable());

    }

}
