<?php
namespace GearTest\ProjectTest\ControllerTest;

use GearTest\ControllerTest\AbstractConsoleControllerTestCase;
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
class DbControllerTest extends AbstractConsoleControllerTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->controller = new DbController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => 'Gear\Db'***REMOVED***);
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