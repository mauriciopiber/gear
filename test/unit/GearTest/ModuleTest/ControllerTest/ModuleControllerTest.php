<?php
namespace GearTest\ModuleTest\ControllerTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;
use Zend\Console\Request;
use Zend\Mvc\Router\Console\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Module\Controller\ModuleController;
use Zend\Stdlib\Parameters;

/**
 * @group Module
 * @group ModuleConstruct
 * @group Controller
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

        $construct->construct(false, null, null)->willReturn(true);

        $this->controller->setConstructService($construct->reveal());

        $this->routeMatch->setParam('action', 'construct');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testConstructParamsAction()
    {
        $construct = $this->prophesize('Gear\Module\ConstructService');

        $construct->construct('Gears', '/var/www/my-folder', 'gear-1.0.0.yml')->willReturn(true);

        $this->controller->setConstructService($construct->reveal());

        $this->routeMatch->setParam('action', 'construct');

        $this->request->setParams(new Parameters(['module' => 'Gears', 'basepath' => '/var/www/my-folder', 'file' => 'gear-1.0.0.yml'***REMOVED***));
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function getTypes()
    {
        return [['web'***REMOVED***, ['cli'***REMOVED******REMOVED***;
    }

    /**
     * @covers \Gear\Module\Controller\ModuleController::diagnosticAction
     * @group Diagnostic
     * @dataProvider getTypes
     */
    public function testDiagnosticAction($type)
    {
        $diagnostic = $this->prophesize('Gear\Module\Diagnostic\DiagnosticService');

        $diagnostic->diagnostic($type)->willReturn(true);

        $this->controller->setDiagnosticService($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type***REMOVED***));

        $this->routeMatch->setParam('action', 'diagnostic');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @covers \Gear\Module\Controller\ModuleController::upgradeAction
     * @group Upgrade
     * @dataProvider getTypes
     */
    public function testUpgradeModule($type)
    {
        $diagnostic = $this->prophesize('Gear\Module\Upgrade\ModuleUpgrade');

        $diagnostic->upgrade($type)->willReturn(true);

        $this->controller->setModuleUpgrade($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type***REMOVED***));

        $this->routeMatch->setParam('action', 'upgrade');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


    /**
     * @covers \Gear\Module\Controller\ModuleController::createAction
     * @group Create
     * @dataProvider getTypes
     */
    public function testCreateModule($type)
    {
        $diagnostic = $this->prophesize('Gear\Module\ModuleService');

        $diagnostic->create($type)->willReturn(true);

        $this->controller->setModuleService($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type***REMOVED***));

        $this->routeMatch->setParam('action', 'create');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group Create
     * @dataProvider getTypes
     */
    public function testCreateModuleAsProject($type)
    {
        $diagnostic = $this->prophesize('Gear\Module\ModuleService');

        $diagnostic->moduleAsProject($type, 'Gearing', '/var/www/teste')->willReturn(true);

        $this->controller->setModuleService($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type, 'module' => 'Gearing', 'basepath' => '/var/www/teste'***REMOVED***));

        $this->routeMatch->setParam('action', 'module-as-project');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
