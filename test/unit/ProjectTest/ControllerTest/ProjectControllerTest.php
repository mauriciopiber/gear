<?php
namespace GearTest\ProjectTest\ControllerTest;

use PHPUnit\Framework\TestCase;
use Zend\Console\Request;
use Zend\Mvc\Console\Router\RouteMatch;
use Zend\Mvc\MvcEvent;
use Gear\Project\Controller\ProjectController;
use Zend\Stdlib\Parameters;

/**
 * @group Project
 * @group ProjectConstruct
 * @group ProjectController
 * @group Controller
 */
class ProjectControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->controller = new ProjectController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(['controller' => 'Gear\Project'***REMOVED***);
        $this->event      = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
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