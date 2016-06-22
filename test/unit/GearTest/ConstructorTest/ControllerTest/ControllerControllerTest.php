<?php
namespace GearTest\ConstructorTest\ControllerTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;
use Zend\Console\Request;
use Zend\Mvc\Router\Console\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Constructor\Controller\ControllerController;
use Zend\Stdlib\Parameters;

/**
 * @group Constructor
 */
class ProjectControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        parent::setUp();

        $controllerService = $this->prophesize('Gear\Constructor\Controller\ControllerService');


        $this->controller = new ControllerController($controllerService->reveal());
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => 'Gear\Constructor\Controller'***REMOVED***);
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($this->bootstrap->getServiceLocator());
    }

    public function testNotFound()
    {
        $this->routeMatch->setParam('action', 'not-found');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testCreateConsoleControllerWeb()
    {
        $controllerService = $this->prophesize('Gear\Constructor\Controller\ControllerService');
        $controllerService->createController([
            'name' => 'name',
            'service' => 'service',
            'namespace' => 'namespace',
            'object' => 'object',
            'db' => 'db',
            'columns' => 'columns',
            'type' => 'type',
            'extends' => 'extends',
        ***REMOVED***)->willReturn(true)->shouldBeCalled();

        $this->controller->setControllerConstructor($controllerService->reveal());
        //$this->controller->set($diagnostic->reveal());

        $this->request->setParams(new Parameters([
            'name' => 'name',
            'service' => 'service',
            'namespace' => 'namespace',
            'object' => 'object',
            'db' => 'db',
            'columns' => 'columns',
            'type' => 'type',
            'extends' => 'extends',
        ***REMOVED***));

        $this->routeMatch->setParam('action', 'create');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}