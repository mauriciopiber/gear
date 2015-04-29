<?php
namespace GearTest\ServiceTest;

use GearTest\AbstractTestCase;
use Zend\Console\Request;
use Zend\View\HelperPluginManager;

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


    public function mockDb()
    {
        // mock db
        $this->columns = array(
            'column_datetime_pt_br' => "datetime-pt-br",
            'column_date_pt_br' => "date-pt-br",
            'column_decimal_pt_br' => "money-pt-br",
            'column_int_checkbox' => "checkbox",
            'column_tinyint_checkbox' => "checkbox",
            'column_varchar_email' => "email",
            'column_varchar_password_verify' => "password-verify",
            'column_varchar_upload_image' => "upload-image",
            'column_varchar_unique_id' => "unique-id"
        );

        $this->db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getColumns', 'getTable', 'getUser'));
        $this->db->expects($this->any())->method('getColumns')->willReturn($this->columns);
        $this->db->expects($this->any())->method('getTable')->willReturn('Columns');
        $this->db->expects($this->any())->method('getUser')->willReturn('all');

        // mock src
        $this->src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getType', 'getName', 'getDb', 'getDependency', 'hasDependency'));
        $this->src->expects($this->any())->method('getDb')->willReturn($this->db);

        $this->schema = $this->getMockSingleClass('Gear\Schema', array('getSpecialityArray', 'getSrcByDb', 'getControllerByDb'));
        $this->schema->expects($this->any())->method('getSrcByDb')->willReturn($this->src);
        $this->schema->expects($this->any())->method('getSpecialityArray')->willReturn($this->columns);



        $this->file = $this->getServiceLocator()->get('fileCreator');

        $str = new \Gear\View\Helper\Str();
        $str->setServiceLocator($this->getServiceLocator());

        $helpers = new HelperPluginManager();
        $helpers->setService('str', $str);

        $this->file->getTemplateService()->getRenderer()->setHelperPluginManager($helpers);

    }


    public function getMockTableByArray(array $options)
    {
        if (!$options['tableName'***REMOVED*** || count($options['columns'***REMOVED***) <= 0) {
            return false;
        }

        $allColumns = [***REMOVED***;
        $allConstraints = [***REMOVED***;


        foreach ($options['columns'***REMOVED*** as $columnName => $columnOptions) {
            $mockColumns = $this->getMockSingleClass(
                'Zend\Db\Metadata\Object\ColumnObject',
                array('getName', 'getTableName', 'getDataType')
            );

            $mockColumns->expects($this->any())->method('getName')->willReturn($columnName);
            $mockColumns->expects($this->any())->method('getTableName')->willReturn($options['tableName'***REMOVED***);
            $mockColumns->expects($this->any())->method('getDataType')->willReturn($columnOptions['dataType'***REMOVED***);

            if (isset($columnOptions['constraints'***REMOVED***) && count($columnOptions['constraints'***REMOVED***)>0) {
                $mockConstraint = $this->getMockSingleClass(
                    'Zend\Db\Metadata\Object\ConstraintObject',
                    array('getType', 'getColumns')
                );
                $mockConstraint->expects($this->any())->method('getType')->willReturn($columnOptions['constraints'***REMOVED***['type'***REMOVED***);
                $mockConstraint->expects($this->any())->method('getColumns')->willReturn(array($columnName));

                $allConstraints[***REMOVED*** = $mockConstraint;
            }
            $allColumns[***REMOVED*** = $mockColumns;

        }

        $tableMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\TableObject', array('getColumns', 'getConstraints', 'getName'));

        $tableMock->expects($this->any())
        ->method('getName')
        ->willReturn($options['tableName'***REMOVED***);

        $tableMock->expects($this->any())
        ->method('getColumns')
        ->willReturn($allColumns);

        $tableMock->expects($this->any())
        ->method('getConstraints')
        ->willReturn($allConstraints);

        return $tableMock;
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

    public function getMockColumns()
    {
        $integerMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            array('getName', 'getTableName', 'getDataType')
        );

        $integerMock->expects($this->any())->method('getName')->willReturn('id_piber');
        $integerMock->expects($this->any())->method('getTableName')->willReturn('piber');
        $integerMock->expects($this->any())->method('getDataType')->willReturn('int');


        $varcharMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            array('getName', 'getTableName', 'getDataType')
        );

        $varcharMock->expects($this->any())->method('getName')->willReturn('varchar_piber');
        $varcharMock->expects($this->any())->method('getTableName')->willReturn('piber');
        $varcharMock->expects($this->any())->method('getDataType')->willReturn('varchar');


        $datetimeMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            array('getName', 'getTableName', 'getDataType')
        );

        $datetimeMock->expects($this->any())->method('getName')->willReturn('datetime_piber');
        $datetimeMock->expects($this->any())->method('getTableName')->willReturn('piber');
        $datetimeMock->expects($this->any())->method('getDataType')->willReturn('datetime');

        $createdMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            array('getName', 'getTableName', 'getDataType')
        );

        $createdMock->expects($this->any())->method('getName')->willReturn('created');
        $createdMock->expects($this->any())->method('getTableName')->willReturn('piber');
        $createdMock->expects($this->any())->method('getDataType')->willReturn('datetime');

        $createdByMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            array('getName', 'getTableName', 'getDataType')
        );


        $createdByMock->expects($this->any())->method('getName')->willReturn('created_by');
        $createdByMock->expects($this->any())->method('getTableName')->willReturn('piber');
        $createdByMock->expects($this->any())->method('getDataType')->willReturn('int');

        $updatedMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            array('getName', 'getTableName', 'getDataType')
        );

        $updatedMock->expects($this->any())->method('getName')->willReturn('updated');
        $updatedMock->expects($this->any())->method('getTableName')->willReturn('piber');
        $updatedMock->expects($this->any())->method('getDataType')->willReturn('datetime');

        $updatedByMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            array('getName', 'getTableName', 'getDataType')
        );


        $updatedByMock->expects($this->any())->method('getName')->willReturn('updated_by');
        $updatedByMock->expects($this->any())->method('getTableName')->willReturn('piber');
        $updatedByMock->expects($this->any())->method('getDataType')->willReturn('int');

        return array($integerMock, $varcharMock, $datetimeMock, $createdMock, $createdByMock, $updatedMock, $updatedByMock);
    }

    public function mockTable()
    {
        $tableMock = $this->getMockSingleClass('Zend\Db\Metadata\Object\TableObject', array('getColumns', 'getConstraints', 'getName'));

        $tableMock->expects($this->any())
        ->method('getName')
        ->willReturn('Piber');

        $tableMock->expects($this->any())
        ->method('getColumns')
        ->willReturn(
            $this->getMockColumns()
        );

        $primaryKeyConstraintMock = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            array('getType', 'getColumns')
        );

        $primaryKeyConstraintMock->expects($this->any())->method('getType')->willReturn('PRIMARY KEY');
        $primaryKeyConstraintMock->expects($this->any())->method('getColumns')->willReturn(array('id_piber'));

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