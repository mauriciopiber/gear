<?php
namespace GearTest\ModuleTest\ControllerTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Request;
use Zend\Mvc\Router\Console\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Module\Controller\ModuleController;
use Zend\Stdlib\Parameters;
use Gear\Module\ConstructStatusObject;

/**
 * @group Module
 * @group ModuleConstruct
 * @group ModuleController
 * @group Controller
 */
class ModuleControllerTest extends TestCase
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

        $console = $this->prophesize('Zend\Console\Adapter\Posix');

        $this->controller->setConsoleAdapter($console->reveal());
    }

    public function testNotFound()
    {
        $this->routeMatch->setParam('action', 'not-found');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * @group x.m1
     */
    public function testConstructAction()
    {
        $construct = $this->prophesize('Gear\Module\ConstructService');

        $status = new ConstructStatusObject();

        $construct->construct(false, null, null)->willReturn($status)->shouldBeCalled();

        $this->controller->setConstructService($construct->reveal());

        $this->routeMatch->setParam('action', 'construct');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group x.m1
     */
    public function testConstructParamsAction()
    {
        $construct = $this->prophesize('Gear\Module\ConstructService');

        $status = new ConstructStatusObject();

        $construct->construct('Gears', 'gear-1.0.0.yml')->willReturn($status);

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

        $diagnostic->diagnostic($type, null)->willReturn(true);

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

        $diagnostic->upgrade($type, null, false)->willReturn(true);

        $this->controller->setModuleUpgrade($diagnostic->reveal());

        $this->request->setParams(new Parameters(['type' => $type***REMOVED***));

        $this->routeMatch->setParam('action', 'upgrade');
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

        $diagnostic->moduleAsProject('Gearing', '/var/www/teste', $type, 'stag.com.br', null)->willReturn(true);

        $this->controller->setModuleService($diagnostic->reveal());

        $this->request->setParams(new Parameters([
            'type' => $type,
            'module' => 'Gearing',
            'basepath' => '/var/www/teste',
            'staging' => 'stag.com.br',
        ***REMOVED***));

        $this->routeMatch->setParam('action', 'module-as-project');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


    public function testLoadModule()
    {
        $diagnostic = $this->prophesize('Gear\Module\Config\ApplicationConfig');
        $cache = $this->prophesize('Gear\Cache\CacheService');

        $diagnostic->addModuleToProject()->willReturn(true)->shouldBeCalled();
        $cache->renewFileCache()->willReturn(true)->shouldBeCalled();

        $this->controller->setApplicationConfig($diagnostic->reveal());
        $this->controller->setCacheService($cache->reveal());

        //$this->request->setParams(new Parameters(['module' => 'Gearing', 'basepath' => '/var/www/teste'***REMOVED***));

        $this->routeMatch->setParam('action', 'load');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUnloadModule()
    {
        $diagnostic = $this->prophesize('Gear\Module\Config\ApplicationConfig');
        $cache = $this->prophesize('Gear\Cache\CacheService');

        $diagnostic->unload()->willReturn(true)->shouldBeCalled();
        $cache->renewFileCache()->willReturn(true)->shouldBeCalled();

        $this->controller->setApplicationConfig($diagnostic->reveal());
        $this->controller->setCacheService($cache->reveal());

        //$this->request->setParams(new Parameters(['module' => 'Gearing', 'basepath' => '/var/www/teste'***REMOVED***));

        $this->routeMatch->setParam('action', 'unload');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
