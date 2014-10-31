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

    public function createStdClass()
    {
        $stdClass = new \stdClass;
        $stdClass->name = __CLASS__;
        return new $stdClass;

    }

    public function create($tableName)
    {
        var_dump($tableName);die();
        $metadata = new Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));

        $table = $metadata->getTable($tableName);

        $this->pushDbIntoSchema($table);
        /**
         * Src
        */
        $this->getEntityService()->createFromTable($table);
        /*   $this->getEntityTestService()->createFromTable($table);

        $this->getRepositoryTestService()->createFromTable($table);
        $this->getRepositoryService()->createFromTable($table);

        $this->getServiceTestService()->createFromTable($table);
        $this->getServiceService()->createFromTable($table);

        $this->getFilterTestService()->createFromTable($table);
        $this->getFilterService()->createFromTable($table);

        $this->getFormTestService()->createFromTable($table);
        $this->getFormService()->createFromTable($table);

        $this->getFactoryTestService()->createFromTable($table);
        $this->getFactoryService()->createFromTable($table);
        /**
        * Page
        */

        /*       $this->getControllerTestService()->createFromTable($table);
         $this->getControllerService()->createFromTable($table);

        $this->getViewController()->createFromTableFactory($table, 'add');
        $this->getViewController()->createFromTableFactory($table, 'edit');
        $this->getViewController()->createFromTableFactory($table, 'list');
        $this->getViewController()->createFromTableFactory($table, 'edit');
        $this->getViewController()->createFromTableFactory($table, 'del');

        $this->getConfig()->merge();

        $this->getPageTestService()->createPageFromTableByTemplate($table, 'add');
        $this->getPageTestService()->createPageFromTableByTemplate($table, 'edit');
        $this->getPageTestService()->createPageFromTableByTemplate($table, 'list');
        $this->getPageTestService()->createPageFromTableByTemplate($table, 'del');

        $this->getAcceptanceTestService()->createFromTable($table);
        $this->getFunctionalTestService()->createFromTable($table); */

        return true;
    }


    public function createMetadata()
    {
        $metadata = new Metadata($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        $this->getEntityService()->createFromMetadata();
        foreach ($metadata->getTables() as $table) {
            $this->getEntityService()->createFromTable($table);
        }
    }

    public function jsonDbModel()
    {




        //  return
        array(
            'db' => array(
                array('tableName' => $columns)
            ),
            'src' => array(),
            'page' => array(),
        );
    }

    public function pushDbIntoSchema($table)
    {
        var_dump(get_class($table));
        var_dump(get_class_methods($table));

        foreach ($table->getColumns() as $column) {
            var_dump($column->getName());
        }

        foreach ($table->getConstraints() as $constraint) {
            var_dump($constraint->getName());
        }
        die();
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
        return $this->repositoryService;
    }

    public function setRepositoryService($repositoryService)
    {
        $this->repositoryService = $repositoryService;
        return $this;
    }

    public function getRepositoryTestService()
    {
        return $this->repositoryTestService;
    }

    public function setRepositoryTestService($repositoryTestService)
    {
        $this->repositoryTestService = $repositoryTestService;
        return $this;
    }

    public function getServiceService()
    {
        return $this->serviceService;
    }

    public function setServiceService($serviceService)
    {
        $this->serviceService = $serviceService;
        return $this;
    }

    public function getServiceTestService()
    {
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
