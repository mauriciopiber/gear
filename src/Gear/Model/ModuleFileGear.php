<?php

namespace Gear\Model;

/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class ModuleFileGear extends MakeGear implements  \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    protected $serviceLocator;
    public $config;

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->sm = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->sm;
    }

    public function generate()
    {
        $moduleGear = new \Gear\Model\ModuleGear();
        $moduleGear->setConfig($this->getConfig());
        $moduleGear->makeModuleFile('yml');
    }

}
