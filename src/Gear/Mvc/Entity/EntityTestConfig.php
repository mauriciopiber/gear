<?php
namespace Gear\Mvc\Entity;

class EntityTestConfig
{
    protected $module;

    protected $className;

    protected $fieldsProviderMethod = [
        'mocks',
        'exports'
    ***REMOVED***;

    protected $fieldsMethod = [
        'params',
        'asserts'
    ***REMOVED***;

    protected $fieldsNullMethod;

    public function __construct($module, $className)
    {
        $this->module = $module;
        $this->className = $className;
    }

    public function setFieldsProviderMethod($mocks, $export)
    {
        $this->fieldsProviderMethod['mocks'***REMOVED*** = $mocks;
        $this->fieldsProviderMethod['exports'***REMOVED*** = $export;
    }

    public function setFieldsMethod($params, $asserts)
    {
        $this->fieldsMethod['params'***REMOVED*** = $params;
        $this->fieldsMethod['asserts'***REMOVED*** = $asserts;
    }

    public function setFieldsNullMethod($fieldss)
    {
        $this->fieldsNullMethod = $fieldss;
    }

    public function getFieldsProviderMethod()
    {
        return $this->fieldsProviderMethod;
    }

    public function getFieldsMethod()
    {
        return $this->fieldsMethod;
    }

    public function getFieldsNullMethod()
    {
        return $this->fieldsNullMethod;
    }

    public function setModule($module)
    {
        $this->module = $module;
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function export()
    {
        return [
            'module' => $this->getModule(),
            'className' => $this->getClassName(),
            'fieldsProviderMethod' => $this->getFieldsProviderMethod(),
            'fieldsMethod' => $this->getFieldsMethod(),
            'fieldsNullMethod' => $this->getFieldsNullMethod()
        ***REMOVED***;
    }
}
