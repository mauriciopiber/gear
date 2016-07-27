<?php
namespace MyModuleTest\ControllerTest;

use MyModuleTest\ControllerTest\AbstractControllerTestCase;
use MyModule\Controller\IndexController;
use Zend\Http\Request;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;

/**
 * @group Controller
 */
class IndexControllerTest extends AbstractControllerTestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    public function setUp()
    {
        parent::setUp();

        $this->controller = new IndexController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'IndexController'));
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
    }

    public function testIndexAction()
    {
        $this->routeMatch->setParam('action', 'index');
        $result = $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
    }
}
