<?php
namespace GearTest\ProjectTest\ControllerTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;
use Zend\Console\Request;
use Zend\Mvc\Router\Console\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Project\Controller\ProjectController;
use Zend\Stdlib\Parameters;

/**
 * @group Module
 * @group ModuleConstruct
 */
class ProjectControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->controller = new ProjectController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => 'Gear\Project'***REMOVED***);
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

}