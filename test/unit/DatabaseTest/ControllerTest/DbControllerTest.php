<?php
namespace GearTest\DatabaseTest\ControllerTest;

use PHPUnit\Framework\TestCase;
use Gear\Database\Phinx\PhinxService;
use Gear\Database\BackupService;
use Zend\Console\Request;
use Zend\Mvc\Console\Router\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Database\Controller\DbController;
use Zend\Stdlib\Parameters;

/**
 * @group Database
 * @group DbController
 * @group Controller
 */
class DbControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->controller = new DbController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => 'Gear\Db'***REMOVED***);
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
    }

    public function testProjectDump()
    {
        $backup = $this->prophesize(BackupService::class);

        $backup->projectDump()->willReturn(true);

        $this->controller->setBackupService($backup->reveal());

        $this->request->setParams(new Parameters([***REMOVED***));

        $this->routeMatch->setParam('action', 'project-dump');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


    public function testCreateMigration()
    {
        $phinx = $this->prophesize(PhinxService::class);

        $phinx->createMigration(null, null)->willReturn(true);

        $this->controller->setPhinxService($phinx->reveal());

        $this->request->setParams(new Parameters([***REMOVED***));

        $this->routeMatch->setParam('action', 'create-migration');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


    public function testProjectLoad()
    {
        $backup = $this->prophesize(BackupService::class);

        $backup->projectLoad()->willReturn(true);

        $this->controller->setBackupService($backup->reveal());

        $this->request->setParams(new Parameters([***REMOVED***));

        $this->routeMatch->setParam('action', 'project-load');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testModuleDump()
    {
        $backup = $this->prophesize(BackupService::class);

        $backup->moduleDump()->willReturn(true);

        $this->controller->setBackupService($backup->reveal());

        $this->request->setParams(new Parameters([***REMOVED***));

        $this->routeMatch->setParam('action', 'module-dump');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testModuleLoad()
    {
        $backup = $this->prophesize(BackupService::class);

        $backup->moduleLoad()->willReturn(true);

        $this->controller->setBackupService($backup->reveal());

        $this->request->setParams(new Parameters([***REMOVED***));

        $this->routeMatch->setParam('action', 'module-load');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
