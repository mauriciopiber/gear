<?php
namespace GearTest\UtilTest\PromptTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Prompt\ConsolePromptFactory;
use Zend\Console\Request;
use Interop\Container\ContainerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Console\Router\RouteMatch;
use Zend\Mvc\Application;

/**
 * @group Gear
 * @group ConsolePrompt
 */
class ConsolePromptFactoryTest extends TestCase
{
    public function testCreateFactory()
    {
        $this->routeMatch = $this->prophesize(RouteMatch::class);

        $this->container    = $this->prophesize(ContainerInterface::class);

        $this->routeMatch->getParam('force')->willReturn(true)->shouldBeCalled();

        $this->mvcEvent = $this->prophesize(MvcEvent::class);
        $this->mvcEvent->getRouteMatch()->willReturn($this->routeMatch->reveal())->shouldBeCalled();
        $this->application = $this->prophesize(Application::class);
        $this->application->getMvcEvent()->willReturn($this->mvcEvent->reveal())->shouldBeCalled();
        $this->container->get('Application')
          ->willReturn($this->application)
          ->shouldBeCalled();


        //$this->container->get('Request')->willReturn($request->reveal())->shouldBeCalled();

        $factory = new ConsolePromptFactory();

        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf('Gear\Util\Prompt\ConsolePrompt', $instance);
    }
}
