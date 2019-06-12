<?php
namespace GearTest\ConstructorTest\ControllerTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Request;
use Zend\Mvc\Console\Router\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Constructor\Controller\ControllerController;
use Zend\Stdlib\Parameters;
use Gear\Constructor\Controller\ControllerConstructor;

/**
 * @group Constructor
 */
class ControllerControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $controllerService = $this->prophesize(ControllerConstructor::class);


        $this->controller = new ControllerController($controllerService->reveal());
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => 'Gear\Constructor\Controller'***REMOVED***);
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
    }


    public function testCreateConsoleControllerWeb()
    {
        $controllerService = $this->prophesize(ControllerConstructor::class);
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
