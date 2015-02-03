<?php
namespace GearTest\ServiceTest;

use GearTest\AbstractTestCase;
use Zend\Console\Request;

abstract class AbstractServiceTest extends AbstractTestCase
{
    protected $structure;

    protected $config;

    protected $moduleService;

    protected $templateService;

    const MODULE = 'TestModule';
    /**
     * Set up config for boilerplate module, to use to test files and configs on gear
     * should be removed on tearDown.
     */
    public function setUp()
    {
        parent::setUp();

        $this->bootstrap = new \GearTest\Bootstrap();
        $this->setServiceLocator($this->bootstrap->getServiceManager());
        $this->bootstrap->getServiceManager()->setAllowOverride(true);

        $this->mockConfig();
        $this->mockStructure();
        $this->mockTemplateService();

        $this->mockRequest();
        $this->mockModuleService();

        $this->bootstrap->getServiceManager()->setAllowOverride(false);

    }


    public function mockAllServices(&$service, $filterNot = array())
    {
        $name = 'instrospectFromTable';

        $classes = array(
            'setEntityService' => 'Gear\Service\Mvc\EntityService',
            'setRepositoryService' => 'Gear\Service\Mvc\RepositoryService',
            'setServiceService' => 'Gear\Service\Mvc\ServiceService',
            'setServiceTestService' => 'Gear\Service\Test\ServiceTestService',
            'setFormService' => 'Gear\Service\Mvc\FormService',
            'setFactoryService' => 'Gear\Service\Mvc\FactoryService',
            'setFilterService' => 'Gear\Service\Mvc\FilterService',
            'setFormTestService' => 'Gear\Service\Test\FormTestService',
            'setSearchService' => 'Gear\Service\Mvc\SearchService',
            'setControllerService' => 'Gear\Service\Mvc\ControllerService',
            'setControllerTestService' => 'Gear\Service\Test\ControllerTestService',
            'setConfigService' => 'Gear\Service\Mvc\ConfigService',
            'setViewService' => 'Gear\Service\Mvc\ViewService',
            'setLanguageService' => 'Gear\Service\LanguageService',
            'setPageTestService' => 'Gear\Service\Test\PageTestService',
            'setFixtureService' => 'Gear\Service\Mvc\FixtureService',
        );

        foreach ($classes as $method => $name) {

            if (in_array($method, $filterNot)) {
                continue;
            }

            $mock = $this->getMockSingleClass($name, array('introspectFromTable'));
            $mock->expects($this->any())
            ->method('introspectFromTable')
            ->willReturn(true);
            $service->$method($mock);
        }
    }

    public function mockTable()
    {
        $tableMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\TableObject', array('getColumns', 'getConstraints', 'getName'));

        $tableMock->expects($this->any())
        ->method('getName')
        ->willReturn('Piber');

        $integerMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ColumnObject');

        $varcharMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ColumnObject');

        $datetimeMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ColumnObject');

        $createdMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ColumnObject');

        $createdByMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ColumnObject');

        $updatedMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ColumnObject');

        $updatedByMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ColumnObject');

        $tableMock->expects($this->any())
        ->method('getColumns')
        ->willReturn(
            array($integerMock, $varcharMock, $datetimeMock, $createdMock, $createdByMock, $updatedMock, $updatedByMock)
        );

        $primaryKeyConstraintMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ConstraintObject');

        $createdByConstraintMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ConstraintObject');

        $updatedByConstraintMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\ConstraintObject');

        $tableMock->expects($this->any())
        ->method('getConstraints')
        ->willReturn(array($primaryKeyConstraintMock, $createdByConstraintMock, $updatedByConstraintMock));

        return $tableMock;
    }



    public function fixSchema()
    {
        $gearService = $this->getServiceLocator()->get('Gear\Schema');

        $gearService->setName('schema/module.json');
        $gearService->setConfig($this->config);

        $this->gearService = $gearService;
    }

    public function tearDown()
    {

        if (isset($this->structure) && is_dir($this->structure->getMainFolder())) {
            $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
            $dirService->rmDir($this->structure->getMainFolder());
        }
        unset($this->config);
        unset($this->moduleService);
        unset($this->service);
        unset($this->templateService);
        unset($this->structure);
        unset($this->bootstrap);
        unset($this->request);

        parent::tearDown();
    }


    public function createMockModule()
    {
        $this->moduleService->setRequest($this->request);
        $this->moduleService->setModule($this->structure);
        $jsonService = $this->getServiceLocator()->get('jsonService');
        $jsonService->setConfig($this->config);
        $jsonService->setModule($this->structure);
        $this->moduleService->setJsonService($jsonService);
        $this->moduleService->createLight();
    }

    public function unloadModule()
    {
        $this->moduleService->unregisterModule();
    }


    public function mockConfig()
    {
        $this->config = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->setMethods(array('getModule'))->getMock();
        $this->config->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TestModule'));

        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('moduleConfig', $this->config);
    }


    public function mockStructure()
    {

        $this->structure = new \Gear\ValueObject\BasicModuleStructure();
        $this->structure->setConfig($this->config);
        $this->structure->prepare();
        $this->structure->setDirService($this->bootstrap->getServiceLocator()->get('dirService'));
        $this->structure->setStringService($this->bootstrap->getServiceLocator()->get('stringService'));
        $this->bootstrap->getServiceManager()->setAllowOverride(true);
        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('moduleStructure', $this->structure);
    }

    public function mockTemplateService()
    {
        $this->templateService = new \Gear\Service\TemplateService();

        $resolver = $this->bootstrap
        ->getServiceManager()
        ->get('Zend\View\Resolver\TemplatePathStack');

        $renderer = new \Zend\View\Renderer\PhpRenderer();
        $renderer->setResolver($resolver);

        $renderer->getHelperPluginManager()->setFactory('arrayToYml', function () {
            return new \Gear\View\Helper\ArrayToYml();
        });

        $this->templateService->setRenderer($renderer);

        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('templateService', $this->templateService);

        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('Gear\Service\Template', $this->templateService);
    }

    public function mockModuleService()
    {
        unset($this->moduleService);
        $this->moduleService = $this->getServiceLocator()->get('moduleService');
        $this->moduleService->setRequest($this->request);
        $this->moduleService->setConfig($this->config);
        $this->moduleService->setModule($this->structure);
    }

    public function mockRequest($params = array())
    {
        $this->params = new \Zend\Stdlib\Parameters();

        if (count($params)>0) {
            foreach ($params as $name => $value) {
                $this->params->set($name, $value);
            }
        }

        $this->request    = new Request();
        $this->request->setParams($this->params);
    }
}