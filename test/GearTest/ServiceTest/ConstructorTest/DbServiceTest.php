<?php
namespace GearTest\ServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;

class DbServiceTest extends AbstractServiceTest
{
    public function setUp()
    {
        parent::setUp();
        $this->service = $this->getServiceLocator()->get('dbService');
    }

    /**
     * @group createModule
     */
    public function testCreateDbFromTable()
    {
        $this->moduleService->create();


        $this->mockRequest(
            array(
                'table' => 'Piber',
                'columns' => ''
            )
        );

        $this->service->setRequest($this->request);


        $mockMetadata = $this->getMockSingleClass('Zend\Db\Metadata\Metadata', array('getTable'));
        $mockMetadata->expects($this->any())
        ->method('getTable')
        ->willReturn($this->mockTable());
        $this->service->setMetadata($mockMetadata);

        $this->mockAllServices();

        $this->fixSchema();
        $this->service->setGearSchema($this->gearService);
        $this->service->create();

        $json = \Zend\Json\Json::decode($this->service->getGearSchema()->getJsonFromFile(), 1);

        $this->assertArrayHasKey('src', $json[$this->config->getModule()***REMOVED***);
        $this->assertArrayHasKey('controller', $json[$this->config->getModule()***REMOVED***);
        $this->assertArrayHasKey('db', $json[$this->config->getModule()***REMOVED***);

        $db = $json[$this->config->getModule()***REMOVED***['db'***REMOVED***;


        $this->assertEquals($db[0***REMOVED***['table'***REMOVED***, 'Piber');
        $this->assertEquals($db[0***REMOVED***['user'***REMOVED***, 'all');
        $this->assertEquals($db[0***REMOVED***['columns'***REMOVED***, null);

        $src = $json[$this->config->getModule()***REMOVED***['src'***REMOVED***;

        $controller = $json[$this->config->getModule()***REMOVED***['controller'***REMOVED***;
        $this->assertEquals($controller[0***REMOVED***['name'***REMOVED***, 'IndexController');
        $this->assertEquals($controller[0***REMOVED***['object'***REMOVED***, '%s\Controller\Index');


        $this->assertEquals($controller[1***REMOVED***['name'***REMOVED***, 'PiberController');
        $this->assertEquals($controller[1***REMOVED***['object'***REMOVED***, '%s\Controller\Piber');
        $this->assertEquals($controller[1***REMOVED***['service'***REMOVED***, 'invokables');

        $actions = $controller[1***REMOVED***['actions'***REMOVED***;

        $this->assertEquals($actions[0***REMOVED***['name'***REMOVED***, 'Create');

        $this->assertEquals($actions[1***REMOVED***['name'***REMOVED***, 'Edit');

        $this->assertEquals($actions[2***REMOVED***['name'***REMOVED***, 'List');

        $this->assertEquals($actions[3***REMOVED***['name'***REMOVED***, 'Delete');

        $this->assertEquals($actions[4***REMOVED***['name'***REMOVED***, 'View');

        $this->assertSrcs($src);

        $this->unloadModule();
    }

    public function assertSrcs($src)
    {
        $this->assertEquals($src[0***REMOVED***['name'***REMOVED***, 'Piber');
        $this->assertEquals($src[0***REMOVED***['type'***REMOVED***, 'Entity');
        $this->assertEquals($src[0***REMOVED***['dependency'***REMOVED***, array());
        $this->assertEquals($src[0***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[1***REMOVED***['name'***REMOVED***, 'PiberRepository');
        $this->assertEquals($src[1***REMOVED***['type'***REMOVED***, 'Repository');
        $this->assertEquals($src[1***REMOVED***['dependency'***REMOVED***, array());
        $this->assertEquals($src[1***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[2***REMOVED***['name'***REMOVED***, 'PiberService');
        $this->assertEquals($src[2***REMOVED***['type'***REMOVED***, 'Service');
        $this->assertEquals($src[2***REMOVED***['dependency'***REMOVED***, array('Repository\Piber'));
        $this->assertEquals($src[2***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[3***REMOVED***['name'***REMOVED***, 'PiberForm');
        $this->assertEquals($src[3***REMOVED***['type'***REMOVED***, 'Form');
        $this->assertEquals($src[3***REMOVED***['dependency'***REMOVED***, array());
        $this->assertEquals($src[3***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[4***REMOVED***['name'***REMOVED***, 'PiberFilter');
        $this->assertEquals($src[4***REMOVED***['type'***REMOVED***, 'Filter');
        $this->assertEquals($src[4***REMOVED***['dependency'***REMOVED***, array());
        $this->assertEquals($src[4***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[5***REMOVED***['name'***REMOVED***, 'PiberFixture');
        $this->assertEquals($src[5***REMOVED***['type'***REMOVED***, 'Fixture');
        $this->assertEquals($src[5***REMOVED***['dependency'***REMOVED***, array());
        $this->assertEquals($src[5***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[6***REMOVED***['name'***REMOVED***, 'PiberFactory');
        $this->assertEquals($src[6***REMOVED***['type'***REMOVED***, 'Factory');
        $this->assertEquals($src[6***REMOVED***['dependency'***REMOVED***, array('Filter\\Piber', 'Form\\Piber'));
        $this->assertEquals($src[6***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[7***REMOVED***['name'***REMOVED***, 'PiberSearchFactory');
        $this->assertEquals($src[7***REMOVED***['type'***REMOVED***, 'SearchFactory');
        $this->assertEquals($src[7***REMOVED***['dependency'***REMOVED***, array());
        $this->assertEquals($src[7***REMOVED***['db'***REMOVED***, 'Piber');

        $this->assertEquals($src[8***REMOVED***['name'***REMOVED***, 'PiberSearchForm');
        $this->assertEquals($src[8***REMOVED***['type'***REMOVED***, 'SearchForm');
        $this->assertEquals($src[8***REMOVED***['dependency'***REMOVED***, array());
        $this->assertEquals($src[8***REMOVED***['db'***REMOVED***, 'Piber');

    }

    public function mockAllServices()
    {

        $name = 'instrospectFromTable';

        $classes = array(
        	'setEntityService' => 'Gear\Service\Mvc\EntityService',
            'setRepositoryService' => 'Gear\Service\Mvc\RepositoryService',
            'setServiceService' => 'Gear\Service\Mvc\ServiceService',
            'setServiceTestService' => 'Gear\Service\Test\ServiceTestService',
            'setFormService' => 'Gear\Service\Mvc\FormService',
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
            $mock = $this->getMockSingleClass($name, array('introspectFromTable'));
            $mock->expects($this->any())
            ->method('introspectFromTable')
            ->willReturn(true);
            $this->service->$method($mock);
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



}
