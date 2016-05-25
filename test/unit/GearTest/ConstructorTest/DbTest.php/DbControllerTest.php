<?php
namespace GearTest\ConstructorTest\DbTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;
use Zend\Mvc\Router\RouteMatch;

/*
 * Feature: Cadastro de Controller no Módulo.
 *   Devemos manipular os arquivos Controller de acordo com o input no sistema.
 */
/**
 * @group module
 * @group module-constructor
 * @group module-constructor-db
 * @group module-constructor-db-controller
 */
class DbControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        $this->bootstrap = new \GearBaseTest\ZendServiceLocator();
        $this->setApplicationConfig(
            include \GearBase\Module::getProjectFolder().'/config/application.config.php'
        );

        parent::setUp();
    }

    public function testControllerManager()
    {
        $this->assertInstanceOf(
            'Gear\Constructor\Db\DbController',
            $this->getApplication()->getServiceManager()->get('ControllerManager')->get('Gear\Module\Constructor\Db')
        );
    }

    public function testTrait()
    {
        $dbService =  $this->getMockBuilder('Gear\Constructor\Db\DbService')
        ->disableOriginalConstructor()
        ->setMethods(null)
        ->getMock();

        $db = new \Gear\Constructor\Db\DbController();

        $db->setDbConstructor($dbService);

        $this->assertEquals($dbService, $db->getDbConstructor());
    }

    public function testCreateDb()
    {
        $db = new \Gear\Constructor\Db\DbController();

        $serviceManager = new \Zend\ServiceManager\ServiceManager();

        $dbService = $this->getMockBuilder('Gear\Constructor\Db\DbService')
            ->disableOriginalConstructor()
            ->setMethods(['create'***REMOVED***)
            ->getMock();

        $dbService->expects($this->at(0))->method('create')->willReturn(true);


        $serviceManager->setService('Gear\Module\Constructor\Db', $dbService);

        $db->setServiceLocator($serviceManager);

        $request = new \Zend\Console\Request();

        // Configurar Parâmetros de Despacho
        $db->getEvent()->setRouteMatch(new RouteMatch([
            'action' => 'create',
        ***REMOVED***));

        $action = $db->dispatch($request);

        $this->assertInstanceOf('Zend\View\Model\ConsoleModel', $action);
    }

    public function testDeleteDb()
    {
        $db = new \Gear\Constructor\Db\DbController();

        $serviceManager = new \Zend\ServiceManager\ServiceManager();

        $dbService =  $emMock = $this->getMockBuilder('Gear\Constructor\Db\DbService')
            ->disableOriginalConstructor()
            ->setMethods(['delete'***REMOVED***)
            ->getMock();

        $dbService->expects($this->at(0))->method('delete')->willReturn(true);


        $serviceManager->setService('Gear\Module\Constructor\Db', $dbService);

        $db->setServiceLocator($serviceManager);


        $action = $db->deleteAction();

        $this->assertInstanceOf('Zend\View\Model\ConsoleModel', $action);
    }

}
