<?php
namespace GearTest\ModuleTest\ControllerTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;
use Zend\Console\Request;
use Zend\Mvc\Router\Console\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Module\Controller\ModuleController;

/**
 * @group Module
 * @group Performance
 */
class ModuleControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->controller = new ModuleController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => 'Gear\Module'***REMOVED***);
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->bootstrap->getServiceLocator());
    }

    public function createModuleConstructMock()
    {
        $mockConstruct = $this->getMockSingleClass('Gear\Module\ConstructService', ['construct'***REMOVED***);
        $mockConstruct->expects($this->any())->method('construct')->willReturn(true);
        return $mockConstruct;
    }

    public function createMvcEventMock()
    {
        //$mock = $this->getMockSingleClass('get')

        $mock = $this->getMockSingleClass('Zend\Http\Request', ['getParam'***REMOVED***);
        $mock->expects($this->at(0))->method('getParam')->willReturn('Gearing');
        $mock->expects($this->at(0))->method('getParam')->willReturn('/var/www/gear-basic');
        return $mock;
    }

    /*
    public function testConstructModule()
    {

        $moduleController = new \Gear\Module\Controller\ModuleController();
        $moduleController->setConstructService($this->createModuleConstructMock());index

        $moduleController->setMvcEvent($this->createMvcEventMock());


        $true = $moduleController->constructAction();

        $this->assertInstanceOf(\Zend\View\Model\ConsoleModel::class, $true);
    }
    */

    public function testNotFound()
    {
        $this->routeMatch->setParam('action', 'not-found');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testConstructAction()
    {
        $construct = $this->prophesize('Gear\Module\ConstructService');

        $construct->construct(false, null)->willReturn(true);

        $this->controller->setConstructService($construct->reveal());

        $this->routeMatch->setParam('action', 'construct');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
