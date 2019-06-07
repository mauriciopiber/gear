<?php
namespace GearTest\ProjectTest\ControllerTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Request;
use Zend\Mvc\Router\Console\RouteMatch;
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

    public function testNotFound()
    {
        $this->routeMatch->setParam('action', 'not-found');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testProjectDump()
    {
        $backup = $this->prophesize('Gear\Database\BackupService');

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
        $phinx = $this->prophesize('Gear\Database\Phinx\PhinxService');

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
        $backup = $this->prophesize('Gear\Database\BackupService');

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
        $backup = $this->prophesize('Gear\Database\BackupService');

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
        $backup = $this->prophesize('Gear\Database\BackupService');

        $backup->moduleLoad()->willReturn(true);

        $this->controller->setBackupService($backup->reveal());

        $this->request->setParams(new Parameters([***REMOVED***));

        $this->routeMatch->setParam('action', 'module-load');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}