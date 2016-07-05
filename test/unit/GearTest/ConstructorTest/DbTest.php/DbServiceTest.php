<?php
namespace GearTest\ConstructorTest\DbTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Db\DbServiceTrait;

/**
 * @group Constructor
 * @group module
 * @group module-constructor
 * @group module-constructor-db
 * @group module-constructor-db-service
 */
class DbServiceTest extends AbstractTestCase
{
    use DbServiceTrait;

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

    /**
     * @group vamoooo
     */
    public function testCreate()
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

        $controller = $this->getMockBuilder('Gear\Mvc\Controller\Controller')
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

        $tableColumn = $this->getMockBuilder('Gear\Table\TableService')
        ->disableOriginalConstructor()
        ->setMethods(['verifyTableAssociation', 'getTableObject'***REMOVED***)
        ->getMock();

        $tableColumn->expects($this->at(0))->method('verifyTableAssociation')->willReturn(false);

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

        $feature = $this->prophesize('Gear\Mvc\Spec\Feature\Feature');

        $serviceManager->setService('Gear\Mvc\Spec\Feature\Feature', $feature->reveal());


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

        $controller = $this->getMockBuilder('Gear\Mvc\Controller\Controller')
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

        $tableColumn = $this->getMockBuilder('Gear\Table\TableService')
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
}
