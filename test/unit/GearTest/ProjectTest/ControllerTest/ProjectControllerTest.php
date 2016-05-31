<?php
namespace GearTest\ProjectTest\ControllerTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;
use Zend\Console\Request;
use Zend\Mvc\Router\Console\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Project\Controller\ProjectController;
use Zend\Stdlib\Parameters;

/**
 * @group Project
 * @group ProjectConstruct
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

    public function getTypes()
    {
        return [['web'***REMOVED***, ['cli'***REMOVED******REMOVED***;
    }


    public function testNotFound()
    {
        $this->routeMatch->setParam('action', 'not-found');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }


    /**
     * @covers \Gear\Project\Controller\ProjectController::diagnosticAction
     * @group Diagnostic
     * @dataProvider getTypes
     */
    public function testDiagnosticAction($type)
    {
        $diagnostic = $this->prophesize('Gear\Project\DiagnosticService');

        $diagnostic->diagnostic($type)->willReturn(true);

        $this->controller->setDiagnosticService($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type***REMOVED***));

        $this->routeMatch->setParam('action', 'diagnostics');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @covers \Gear\Project\Controller\ProjectController::upgradeAction
     * @group Upgrade
     * @dataProvider getTypes
     */
    public function testUpgradeProject($type)
    {
        $diagnostic = $this->prophesize('Gear\Project\Upgrade');

        $diagnostic->upgrade($type)->willReturn(true);

        $this->controller->setUpgrade($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type***REMOVED***));

        $this->routeMatch->setParam('action', 'upgrade');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


    /**
     * @covers \Gear\Project\Controller\ProjectController::createAction
     * @group Create
     * @dataProvider getTypes
     */
    public function testCreateProject($type)
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $diagnostic->create($type)->willReturn(true);

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type***REMOVED***));

        $this->routeMatch->setParam('action', 'create');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

}