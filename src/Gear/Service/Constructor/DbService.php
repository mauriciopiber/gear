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

            die();
            if (!$json) {
                return false;
            }

            $db->setTableObject($table);


            $this->getEntityService()->introspectFromTable($table);
            $this->getEntityTestService()->introspectFromTable($table);

            $this->getRepositoryService()->introspectFromTable($table);
            $this->getRepositoryTestService()->introspectFromTable($table);

            //11

            $this->getServiceTestService()->introspectFromTable($db);
            $this->getServiceService()->introspectFromTable($db);

            $this->getFormTestService()->introspectFromTable($table);

            $this->getFilterService()->introspectFromTable($table);
            $this->getFormService()->introspectFromTable($table);
            $this->getFactoryService()->introspectFromTable($table);

            $this->getControllerTestService()->introspectFromTable($table);
            $this->getControllerService()->introspectFromTable($table);

            $this->getConfigService()->introspectFromTable($table);

            $this->getViewService()->introspectFromTable($table);

            $this->getPageTestService()->introspectFromTable($table);

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


    public function getViewService()
    {
        if (! isset($this->viewService)) {
            $this->viewService = $this->getServiceLocator()->get('viewService');
        }
        return $this->viewService;
    }

    public function setViewService($viewService)
    {
        $this->viewService = $viewService;
        return $this;
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
        if (!isset($this->filterService)) {
            $this->filterService = $this->getServiceLocator()->get('filterService');
        }
        return $this->filterService;
    }

    public function setFilterService($filterService)
    {
        $this->filterService = $filterService;
        return $this;
    }



    public function getFormService()
    {
        if (!isset($this->formService)) {
            $this->formService = $this->getServiceLocator()->get('formService');
        }
        return $this->formService;
    }

    public function setFormService($formService)
    {
        $this->formService = $formService;
        return $this;
    }

    public function getFormTestService()
    {
        if (!isset($this->formTestService)) {
            $this->formTestService = $this->getServiceLocator()->get('formTestService');
        }
        return $this->formTestService;
    }

    public function setFormTestService($formTestService)
    {
        $this->formTestService = $formTestService;
        return $this;
    }

    public function getFactoryService()
    {
        if (!isset($this->factoryService)) {
            $this->factoryService = $this->getServiceLocator()->get('factoryService');
        }
        return $this->factoryService;
    }

    public function setFactoryService($factoryService)
    {
        $this->factoryService = $factoryService;
        return $this;
    }


    public function getControllerService()
    {
        if (!isset($this->controllerService)) {
            $this->controllerService = $this->getServiceLocator()->get('controllerService');
        }
        return $this->controllerService;
    }

    public function setControllerService($controllerService)
    {
        $this->controllerService = $controllerService;
        return $this;
    }

    public function getControllerTestService()
    {
        if (!isset($this->controllerTestService)) {
            $this->controllerTestService = $this->getServiceLocator()->get('controllerTestService');
        }
        return $this->controllerTestService;
    }

    public function setControllerTestService($controllerTestService)
    {
        $this->controllerTestService = $controllerTestService;
        return $this;
    }

    public function getConfigService()
    {
        if (!isset($this->configService)) {
            $this->configService = $this->getServiceLocator()->get('configService');
        }
        return $this->configService;
    }

    public function setConfigService($configService)
    {
        $this->configService = $configService;
        return $this;
    }

    public function getLanguageService()
    {
        if (!isset($this->languageService)) {
            $this->languageService = $this->getServiceLocator()->get('languageService');
        }
        return $this->languageService;
    }

    public function setLanguageService($languageService)
    {
        $this->languageService = $languageService;
        return $this;
    }

    public function getPageTestService()
    {
        if (!isset($this->pageTestService)) {
            $this->pageTestService = $this->getServiceLocator()->get('pageTestService');
        }
        return $this->pageTestService;
    }

    public function setPageTestService($pageTestService)
    {
        $this->pageTestService = $pageTestService;
        return $this;
    }

    public function getAcceptanceTestService()
    {
        if (!isset($this->acceptanceTestService)) {
            $this->acceptanceTestService = $this->getServiceLocator()->get('acceptanceTestService');
        }
        return $this->acceptanceTestService;
    }

    public function setAcceptanceTestService($acceptanceTestService)
    {
        $this->acceptanceTestService = $acceptanceTestService;
        return $this;
    }

    public function getFunctionalTestService()
    {
        if (!isset($this->functionalTestService)) {
            $this->functionalTestService = $this->getServiceLocator()->get('functionalTestService');
        }
        return $this->functionalTestService;
    }

    public function setFunctionalTestService($functionalTestService)
    {
        $this->functionalTestService = $functionalTestService;
        return $this;
    }
}
