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
 * @group ProjectController
 * @group Controller
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
     * @covers \Gear\Project\Controller\ProjectController::diagnosticsAction
     * @group Diagnostic
     * @dataProvider getTypes
     */
    public function testDiagnosticAction($type)
    {
        $diagnostic = $this->prophesize('Gear\Project\Diagnostic\DiagnosticService');

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
        $diagnostic = $this->prophesize('Gear\Project\Upgrade\ProjectUpgrade');

        $diagnostic->upgrade($type, false)->willReturn(true);

        $this->controller->setProjectUpgrade($diagnostic->reveal());

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


    /**
     * @group con1
     */
    public function testCreateConfig()
    {
        $dbname = 'my_database';
        $host = 'my-site.com.dev';
        $environment = 'development';
        $username = 'root';
        $password = 'secretist';

        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $diagnostic->setUpConfig($dbname, $username, $password, $host, $environment)->willReturn(true);

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters([
            'dbname' => $dbname,
            'host' => $host,
            'environment' => $environment,
            'username' => $username,
            'password' => $password
        ***REMOVED***));

        $this->routeMatch->setParam('action', 'config');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testCreateGlobal()
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $dbname = 'my_database';
        $host = 'my-site.com.dev';
        $environment = 'development';

        $diagnostic->setUpGlobal($dbname, $host, $environment)->willReturn(true);

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters(['dbname' => $dbname, 'host' => $host, 'environment' => $environment***REMOVED***));

        $this->routeMatch->setParam('action', 'global');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testCreateEnvironment()
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $env = 'development';

        $diagnostic->setUpEnvironment($env)->willReturn(true)->shouldBeCalled();

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters([
            'env' => $env
        ***REMOVED***));

        $this->routeMatch->setParam('action', 'environment');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testCreateLocal()
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $username = 'root';
        $password = 'secretist';

        $diagnostic->setUpLocal($username, $password)->willReturn(true);

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters([
            'username' => $username,
            'password' => $password
        ***REMOVED***));

        $this->routeMatch->setParam('action', 'local');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testGit()
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $diagnostic->git()->willReturn(true)->shouldBeCalled();

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters());

        $this->routeMatch->setParam('action', 'git');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testNfs()
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $diagnostic->nfs()->willReturn(true)->shouldBeCalled();

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters());

        $this->routeMatch->setParam('action', 'nfs');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


    /**
     * @group con1
     */
    public function testVirtualHost()
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $diagnostic->virtualHost()->willReturn(true)->shouldBeCalled();

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters());

        $this->routeMatch->setParam('action', 'virtual-host');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testFixture()
    {
        $diagnostic = $this->prophesize('Gear\Mvc\Fixture\FixtureService');

        $diagnostic->importProject()->willReturn(true)->shouldBeCalled();

        $this->controller->setFixtureService($diagnostic->reveal());

        $this->request->setParams(new Parameters());

        $this->routeMatch->setParam('action', 'fixture');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testDelete()
    {
        $diagnostic = $this->prophesize('Gear\Project\ProjectService');

        $diagnostic->delete()->willReturn(true)->shouldBeCalled();

        $this->controller->setProjectService($diagnostic->reveal());

        $this->request->setParams(new Parameters());

        $this->routeMatch->setParam('action', 'delete');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @group con1
     */
    public function testCacheRenew()
    {
        $diagnostic = $this->prophesize('Gear\Cache\CacheService');

        $diagnostic->renewCache()->willReturn(true)->shouldBeCalled();

        $this->controller->setCacheService($diagnostic->reveal());

        $this->request->setParams(new Parameters());

        $this->routeMatch->setParam('action', 'renew-cache');
        $this->controller->dispatch($this->request);
        $response = $this->controller->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }


}