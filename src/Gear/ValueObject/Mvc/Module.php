<?php
namespace Gear\ValueObject\Mvc;

class Module
{

    protected $src;

    protected $namespace;

    protected $controller;

    protected $factory;

    protected $service;

    protected $repository;

    protected $entity;

    protected $valueObject;

    protected $inputFilter;

    protected $form;

    protected $config;

    protected $tests;

    protected $build;

    protected $view;

    protected $autoloadClassmap;

    protected $module;

    protected $moduleConfig;

    public function getSrc()
    {
        return $this->src;
    }

    public function setSrc($src)
    {
        $this->src = $src;
        return $this;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    public function getFactory()
    {
        return $this->factory;
    }

    public function setFactory($factory)
    {
        $this->factory = $factory;
        return $this;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
        return $this;
    }

    public function getValueObject()
    {
        return $this->valueObject;
    }

    public function setValueObject($valueObject)
    {
        $this->valueObject = $valueObject;
        return $this;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }

    public function setInputFilter($inputFilter)
    {
        $this->inputFilter = $inputFilter;
        return $this;
    }

    public function getForm()
    {
        return $this->form;
    }

    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function getTests()
    {
        return $this->tests;
    }

    public function setTests($tests)
    {
        $this->tests = $tests;
        return $this;
    }

    public function getView()
    {
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function getBuild()
    {
        return $this->build;
    }

    public function setBuild($build)
    {
        $this->build = $build;
        return $this;
    }

    public function getAutoloadClassmap()
    {
        return $this->autoloadClassmap;
    }

    public function setAutoloadClassmap($autoloadClassmap)
    {
        $this->autoloadClassmap = $autoloadClassmap;
        return $this;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    public function getModuleConfig()
    {
        return $this->moduleConfig;
    }

    public function setModuleConfig($moduleConfig)
    {
        $this->moduleConfig = $moduleConfig;
        return $this;
    }
}
