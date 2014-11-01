<?php
namespace Gear\Service\Constructor;

use Gear\Service\AbstractJsonService;
use Zend\Db\Metadata\Metadata;

class DbService extends AbstractJsonService
{
    protected $entityService;

    protected $entityTestService;

    protected $repositoryService;

    protected $repositoryTestService;

    protected $serviceService;

    protected $serviceTestService;

    protected $filterService;

    protected $filterTestService;

    protected $formService;

    protected $formTestService;

    protected $factoryService;

    protected $factoryTestService;

    protected $controllerService;

    protected $controllerTestService;

    protected $configService;

    protected $languageService;

    protected $viewService;

    protected $pageTestService;

    protected $acceptanceTestService;

    protected $functionalTestService;



    public function isValid($data)
    {
        return true;
    }

    public function create($data)
    {
        if ($this->isValid($data)) {

            $db = new \Gear\ValueObject\Db($data);

            $metadata = new Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
            $table = $metadata->getTable($db->getTableUnderscore());

            if (!$table) {
                return false;
            }

            $json = $this->getGearSchema()->insertDb($db);

            if (!$json) {
                return false;
            }


            $this->getEntityService()->introspectFromTable($table);
            $this->getEntityTestService()->introspectFromTable($table);

            $this->getRepositoryService()->introspectFromTable($table);
            $this->getRepositoryTestService()->introspectFromTable($table);

            $this->getServiceTestService()->introspectFromTable($table);
            $this->getServiceService()->introspectFromTable($table);

            $this->getFormTestService()->introspectFromTable($table);

            $this->getFilterService()->introspectFromTable($table);
            $this->getFormService()->introspectFromTable($table);
            $this->getFactoryService()->introspectFromTable($table);

            $this->getControllerTestService()->introspectFromTable($table);
            $this->getControllerService()->introspectFromTable($table);

            $this->getViewController()->introspectFromTable($table);

            $this->getConfig()->merge();

            $this->getPageTestService()->introspectFromTable();

            $this->getAcceptanceTestService()->introspectFromTable($table);
            $this->getFunctionalTestService()->introspectFromTable($table);

            return true;
        } else {
            return false;
        }

    }


    public function createMetadata()
    {
        $metadata = new Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        $this->getEntityService()->createFromMetadata();
        foreach ($metadata->getTables() as $table) {
            $this->getEntityService()->createFromTable($table);
        }
    }



    public function getEntityService()
    {
        if (! isset($this->entityService)) {
            $this->entityService = $this->getServiceLocator()->get('entityService');
        }
        return $this->entityService;
    }

    public function setEntityService($entityService)
    {
        $this->entityService = $entityService;
        return $this;
    }

    public function getEntityTestService()
    {
        if (! isset($this->entityTestService)) {
            $this->entityTestService = $this->getServiceLocator()->get('entityTestService');
        }
        return $this->entityTestService;
    }

    public function setEntityTestService($entityTestService)
    {
        $this->entityTestService = $entityTestService;
        return $this;
    }

    public function getRepositoryService()
    {
        if (!isset($this->repositoryService)) {
            $this->repositoryService = $this->getServiceLocator()->get('repositoryService');
        }
        return $this->repositoryService;
    }

    public function setRepositoryService($repositoryService)
    {
        $this->repositoryService = $repositoryService;
        return $this;
    }

    public function getRepositoryTestService()
    {
        if (!isset($this->repositoryTestService)) {
            $this->repositoryTestService = $this->getServiceLocator()->get('repositoryTestService');
        }
        return $this->repositoryTestService;
    }

    public function setRepositoryTestService($repositoryTestService)
    {
        $this->repositoryTestService = $repositoryTestService;
        return $this;
    }

    public function getServiceService()
    {
        if (!isset($this->serviceService)) {
            $this->serviceService = $this->getServiceLocator()->get('serviceService');
        }
        return $this->serviceService;
    }

    public function setServiceService($serviceService)
    {
        $this->serviceService = $serviceService;
        return $this;
    }

    public function getServiceTestService()
    {
        if (!isset($this->serviceTestService)) {
            $this->serviceTestService = $this->getServiceLocator()->get('serviceTestService');
        }
        return $this->serviceTestService;
    }

    public function setServiceTestService($serviceTestService)
    {
        $this->serviceTestService = $serviceTestService;
        return $this;
    }

    public function getFilterService()
    {
        return $this->filterService;
    }

    public function setFilterService($filterService)
    {
        $this->filterService = $filterService;
        return $this;
    }

    public function getFilterTestService()
    {
        return $this->filterTestService;
    }

    public function setFilterTestService($filterTestService)
    {
        $this->filterTestService = $filterTestService;
        return $this;
    }

    public function getFormService()
    {
        return $this->formService;
    }

    public function setFormService($formService)
    {
        $this->formService = $formService;
        return $this;
    }

    public function getFormTestService()
    {
        return $this->formTestService;
    }

    public function setFormTestService($formTestService)
    {
        $this->formTestService = $formTestService;
        return $this;
    }

    public function getFactoryService()
    {
        return $this->factoryService;
    }

    public function setFactoryService($factoryService)
    {
        $this->factoryService = $factoryService;
        return $this;
    }

    public function getFactoryTestService()
    {
        return $this->factoryTestService;
    }

    public function setFactoryTestService($factoryTestService)
    {
        $this->factoryTestService = $factoryTestService;
        return $this;
    }

    public function getControllerService()
    {
        return $this->controllerService;
    }

    public function setControllerService($controllerService)
    {
        $this->controllerService = $controllerService;
        return $this;
    }

    public function getControllerTestService()
    {
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTestService)
    {
        $this->controllerTestService = $controllerTestService;
        return $this;
    }

    public function getConfigService()
    {
        return $this->configService;
    }

    public function setConfigService($configService)
    {
        $this->configService = $configService;
        return $this;
    }

    public function getLanguageService()
    {
        return $this->languageService;
    }

    public function setLanguageService($languageService)
    {
        $this->languageService = $languageService;
        return $this;
    }

    public function getPageTestService()
    {
        return $this->pageTestService;
    }

    public function setPageTestService($pageTestService)
    {
        $this->pageTestService = $pageTestService;
        return $this;
    }

    public function getAcceptanceTestService()
    {
        return $this->acceptanceTestService;
    }

    public function setAcceptanceTestService($acceptanceTestService)
    {
        $this->acceptanceTestService = $acceptanceTestService;
        return $this;
    }

    public function getFunctionalTestService()
    {
        return $this->functionalTestService;
    }

    public function setFunctionalTestService($functionalTestService)
    {
        $this->functionalTestService = $functionalTestService;
        return $this;
    }
}
