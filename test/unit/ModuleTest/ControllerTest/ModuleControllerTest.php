<?php
namespace GearTest\ModuleTest\ControllerTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Adapter\Posix;
use Gear\Module;
use Zend\Console\Request;
use Zend\Mvc\Console\Router\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Module\Controller\ModuleController;
use Zend\Stdlib\Parameters;
use Gear\Module\ConstructStatusObject;
use Gear\Module\ModuleService;
use Gear\Cache\CacheService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Module\Diagnostic\DiagnosticService;
use Gear\Module\ConstructService;
use Gear\Module\Upgrade\ModuleUpgrade;
use Gear\Module\Config\ApplicationConfig;
use Gear\Autoload\ComposerAutoload;

/**
 * @group Module
 * @group ModuleConstruct
 * @group ModuleController
 * @group Controller
 */
class ModuleControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->module = $this->prophesize(ModuleService::class);
        $this->applicationConfig = $this->prophesize(ApplicationConfig::class);
        $this->cache = $this->prophesize(CacheService::class);
        $this->moduleUpgrade = $this->prophesize(ModuleUpgrade::class);
        $this->diagnostic = $this->prophesize(DiagnosticService::class);
        $this->construct = $this->prophesize(ConstructService::class);
        $this->console = $this->prophesize(Posix::class);

        $this->controller = new ModuleController(
            $this->module->reveal(),
            $this->diagnostic->reveal(),
            $this->moduleUpgrade->reveal(),
            $this->construct->reveal(),
            $this->applicationConfig->reveal(),
            $this->cache->reveal(),
            $this->console->reveal()
        );
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => Module::class***REMOVED***);
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);

    }

    /**
     * @group x.m1
     */
    public function testConstructAction()
    {

        $status = new ConstructStatusObject($this->console->reveal());

        $this->construct->construct(false, null, null)->willReturn($status)->shouldBeCalled();

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

        $status = new ConstructStatusObject($this->console->reveal());

        $this->construct->construct('Gears', 'gear-1.0.0.yml')->willReturn($status);

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

        $this->diagnostic->diagnostic($type, null)->willReturn(true);

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
        $this->moduleUpgrade->upgrade($type, null, false)->willReturn(true);

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

        $this->module->moduleAsProject('Gearing', '/var/www/teste', $type, 'Pbr\\Gearing')->willReturn(true);

        $this->request->setParams(new Parameters([
            'type' => $type,
            'module' => 'Gearing',
            'basepath' => '/var/www/teste',
            'namespace' => 'Pbr\\Gearing',
        ***REMOVED***));

        $this->routeMatch->setParam('action', 'module-as-project');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


    public function testLoadModule()
    {

        $this->applicationConfig->addModuleToProject()->willReturn(true)->shouldBeCalled();
        $this->cache->renewFileCache()->willReturn(true)->shouldBeCalled();

        //$this->request->setParams(new Parameters(['module' => 'Gearing', 'basepath' => '/var/www/teste'***REMOVED***));

        $this->routeMatch->setParam('action', 'load');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUnloadModule()
    {
        $this->applicationConfig->unload()->willReturn(true)->shouldBeCalled();
        $this->cache->renewFileCache()->willReturn(true)->shouldBeCalled();

        $this->routeMatch->setParam('action', 'unload');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
