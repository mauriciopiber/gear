<?php
namespace GearTest\ConstructorTest\DbTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Constructor\Db\DbServiceTrait;
use Gear\Constructor\Db\DbService;
use GearJson\Action\ActionService;
use Exception;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Module\BasicModuleStructure;

/**
 * @group fix-table
 * @group Constructor
 * @group module
 * @group module-constructor
 * @group module-constructor-db
 * @group module-constructor-db-service
 */
class DbServiceTest extends TestCase
{
    use DbServiceTrait;

    public function setUp()
    {
        $this->service = new DbService();

        $this->dbService = $this->prophesize('GearJson\Db\DbService');
        $this->service->setDbService($this->dbService->reveal());

        $this->configService = $this->prophesize('Gear\Mvc\Config\ConfigService');
        $this->service->setConfigService($this->configService->reveal());

        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $this->service->setTableService($this->tableService->reveal());


        $this->columnService = $this->prophesize('Gear\Column\ColumnService');
        $this->service->setColumnService($this->columnService->reveal());

        $this->repositoryService = $this->prophesize(RepositoryService::class);
        $this->service->setRepositoryService($this->repositoryService->reveal());

        $this->formService = $this->prophesize(FormService::class);
        $this->service->setFormService($this->formService->reveal());

        $this->filterService = $this->prophesize(FilterService::class);
        $this->service->setFilterService($this->filterService->reveal());

        $this->searchFormService = $this->prophesize(SearchService::class);
        $this->service->setSearchService($this->searchFormService->reveal());

        $this->actionService = $this->prophesize(ActionService::class);
        $this->service->setActionService($this->actionService->reveal());

        $this->entityService = $this->prophesize(EntityService::class);
        $this->service->setEntityService($this->entityService->reveal());

        $this->fixtureService = $this->prophesize(FixtureService::class);
        $this->service->setFixtureService($this->fixtureService->reveal());

        $this->feature = $this->prophesize(Feature::class);

        $this->service->setFeature($this->feature->reveal());
        $this->step = $this->prophesize(Step::class);

        $this->service->setStep($this->step->reveal());

        $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->service->setModule($this->module->reveal());


        $this->serviceService = $this->prophesize('Gear\Mvc\Service\ServiceService');
        $this->service->setServiceService($this->serviceService->reveal());

        $this->languageService = $this->prophesize('Gear\Mvc\LanguageService');
        $this->service->setLanguageService($this->languageService->reveal());

        $this->controllerService = $this->prophesize('Gear\Mvc\Controller\ControllerService');
        $this->service->setMvcController($this->controllerService->reveal());

        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');
        $this->service->setViewService($this->viewService->reveal());

    }

    /**
     * @group x1
     */
    public function testMissingTableName()
    {
        $this->expectException(Exception::class);
        $this->service->create([
            'table' => null
        ***REMOVED***);
    }


    /**
     * @group x2
     */
    public function testCreate()
    {
        $table = 'MyTable';
        $columns = [***REMOVED***;
        $user = 'all';
        $role = 'guest';
        $service = 'factories';
        $namespace = 'MyTable';
        $module = 'MyModule';

        $this->db = $this->prophesize('GearJson\Db\Db');
        $this->db->getTable()->willReturn($table)->shouldBeCalled();

        $this->module->getModuleName()->willReturn($module)->shouldBeCalled();

        $this->dbService->create($module, $table, $columns, $user, $role, $service, $namespace, false)
            ->willReturn($this->db->reveal())
            ->shouldBeCalled();

        $this->tableObject = $this->prophesize('Zend\Db\Metadata\Object\TableObject');

        $this->db->setTableObject($this->tableObject->reveal())->shouldBeCalled();

        $this->tableService->getTableObject($table)->willReturn($this->tableObject->reveal())->shouldBeCalled();
        $this->tableService->verifyTableAssociation($table, 'upload_image')->willReturn(true)->shouldBeCalled();


        $this->serviceService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->repositoryService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->formService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->filterService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->searchFormService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->controllerService->introspectFromTable($this->db->reveal())->shouldBeCalled();

        $service = $this->service->create([
            'table' => $table,
            'columns' => $columns,
            'user' => $user,
            'role' => $role,
            'namespace' => $namespace
        ***REMOVED***);


        $this->assertTrue($service);
    }

    /*
    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\Db\DbService', $this->getDbConstructor());
    }

    public function createMvc($name, $action)
    {
        $mock = $this->getMockBuilder($name)
        ->disableOriginalConstructor()
        ->setMethods([$action***REMOVED***)
        ->getMock();
        $mock->expects($this->at(0))->method($action)->willReturn(true);

        return $mock;
    }


    public function testCreateDbWithUploadImage()
    {
        $table = 'TestCreateDb';
        $columns = [***REMOVED***;
        $user = 'all';
        $role = 'admin';


        $serviceManager = new \Zend\ServiceManager\ServiceManager();

        $jsonDbService = $this->getMockBuilder('GearJson\Db\DbService')
        ->disableOriginalConstructor()
        ->setMethods(['create'***REMOVED***)
        ->getMock();

        $dbObject = $this->getMockBuilder('GearJson\Db\Db')
        ->disableOriginalConstructor()
        ->setMethods(['getTable'***REMOVED***)
        ->getMock();

        $dbObject->expects($this->any())->method('getTable')->willReturn($table);

        $jsonDbService->expects($this->at(0))->method('create')->willReturn($dbObject);


        $serviceManager->setService('GearJson\Db', $jsonDbService);

        $config = $this->getMockBuilder('Gear\Mvc\Config\ConfigService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $config->expects($this->at(0))->method('introspectFromTable')->willReturn(true);

        $serviceManager->setService('Gear\Mvc\Config\ConfigService', $config);

        $service = $this->getMockBuilder('Gear\Mvc\Service\ServiceService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $service->expects($this->at(0))->method('introspectFromTable')->willReturn(true);

        $serviceManager->setService('Gear\Mvc\Service\ServiceService', $service);

        $repository = $this->getMockBuilder('Gear\Mvc\Repository\RepositoryService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $repository->expects($this->at(0))->method('introspectFromTable')->willReturn(true);

        $serviceManager->setService('Gear\Mvc\Repository\RepositoryService', $repository);

        $form = $this->getMockBuilder('Gear\Mvc\Form\FormService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $form->expects($this->at(0))->method('introspectFromTable')->willReturn(true);

        $serviceManager->setService('Gear\Mvc\Form\FormService', $form);

        $filter = $this->getMockBuilder('Gear\Mvc\Filter\FilterService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $filter->expects($this->at(0))->method('introspectFromTable')->willReturn(true);
        $serviceManager->setService('Gear\Mvc\Filter\FilterService', $filter);


        $search = $this->getMockBuilder('Gear\Mvc\Search\SearchService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $search->expects($this->at(0))->method('introspectFromTable')->willReturn(true);
        $serviceManager->setService('Gear\Mvc\Search\SearchService', $search);

        $fixture = $this->getMockBuilder('Gear\Mvc\Fixture\FixtureService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $fixture->expects($this->at(0))->method('introspectFromTable')->willReturn(true);
        $serviceManager->setService('Gear\Mvc\Fixture\FixtureService', $fixture);

        $entity = $this->getMockBuilder('Gear\Mvc\Entity\EntityService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $entity->expects($this->at(0))->method('introspectFromTable')->willReturn(true);

        $serviceManager->setService('Gear\Mvc\Entity\EntityService', $entity);

        $language = $this->getMockBuilder('Gear\Mvc\LanguageService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $language->expects($this->at(0))->method('introspectFromTable')->willReturn(true);


        $serviceManager->setService('Gear\Mvc\LanguageService', $language);

        $controller = $this->getMockBuilder('Gear\Mvc\Controller\ControllerService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $controller->expects($this->at(0))->method('introspectFromTable')->willReturn(true);

        $serviceManager->setService('Gear\Mvc\Controller\Controller', $controller);


        $view = $this->getMockBuilder('Gear\Mvc\View\ViewService')
        ->disableOriginalConstructor()
        ->setMethods(['introspectFromTable'***REMOVED***)
        ->getMock();
        $view->expects($this->at(0))->method('introspectFromTable')->willReturn(true);

        $serviceManager->setService('Gear\Mvc\View\ViewService', $view);

        $tableColumn = $this->getMockBuilder('Gear\Table\TableService\TableService')
        ->disableOriginalConstructor()
        ->setMethods(['verifyTableAssociation', 'getTableObject'***REMOVED***)
        ->getMock();

        $tableColumn->expects($this->at(0))->method('verifyTableAssociation')->willReturn(true);

        $tableObject = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $tableColumn->expects($this->any())->method('getTableObject')->willReturn($tableObject);

        $serviceManager->setService('Gear\Table\TableService', $tableColumn);

        $basicModuleStructure = $this->getMockBuilder('Gear\Module\BasicModuleStructure')
        ->disableOriginalConstructor()
        ->setMethods(['getModuleName'***REMOVED***)
        ->getMock();

        $basicModuleStructure->expects($this->any())->method('getModuleName')->willReturn('GearModule');

        $serviceManager->setService('moduleStructure', $basicModuleStructure);

        $mockAction = $this->getMockBuilder('GearJson\Action\ActionService')
        ->disableOriginalConstructor()
        ->setMethods(['create'***REMOVED***)
        ->getMock();

        $mockAction->expects($this->at(0))->method('create')->willReturn(true);

        $serviceManager->setService('GearJson\Action', $mockAction);

        $feature = $this->prophesize('Gear\Mvc\Spec\Feature\Feature');

        $serviceManager->setService('Gear\Mvc\Spec\Feature\Feature', $feature->reveal());

        $step = $this->prophesize('Gear\Mvc\Spec\Step\Step');

        $serviceManager->setService('Gear\Mvc\Spec\Step\Step', $step->reveal());

        $dbService = new \Gear\Constructor\Db\DbService();

        $dbService->setServiceLocator($serviceManager);

        $service = $dbService->create([
            'table' => $table,
            'columns' => $columns,
            'user' => $user,
            'role' => $role
        ***REMOVED***);

        $this->assertTrue($service);

    }

    public function testDelete()
    {
        $dbService = new \Gear\Constructor\Db\DbService();

        $service = $dbService->delete();

        $this->assertTrue($service);
    }
    */
}
