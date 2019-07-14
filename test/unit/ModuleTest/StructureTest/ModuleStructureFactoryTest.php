<?php
namespace Gear\Test\ModuleTest\StructureTest;

use PHPUnit\Framework\TestCase;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureFactory;
use Interop\Container\ContainerInterface;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Util\File\FileService;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Console\Router\RouteMatch;

//use Gear\Util\

class BasicModuleStructureFactoryTest extends TestCase
{
    public function setUp() : void
    {
        $this->container = $this->prophesize(ContainerInterface::class);

        $this->container->get(StringService::class)
          ->willReturn($this->prophesize(StringService::class)->reveal())
          ->shouldBeCalled();
        $this->container->get(DirService::class)
          ->willReturn($this->prophesize(DirService::class)->reveal())
          ->shouldBeCalled();
        $this->container->get(FileService::class)
          ->willReturn($this->prophesize(FileService::class)->reveal())
          ->shouldBeCalled();

        $this->routeMatch = $this->prophesize(RouteMatch::class);
    }

    public function testRunCreateModule()
    {
        $this->routeMatch->getParam('module')->willReturn('FakeModule')->shouldBeCalled();
        $this->routeMatch->getParam('action')->willReturn('module-as-project')->shouldBeCalled();
        $this->routeMatch->getParam('namespace')->willReturn('Pbr\\FakeModule')->shouldBeCalled();
        $this->routeMatch->getParam('type', null)->willReturn('api')->shouldBeCalled();
        $this->routeMatch->getParam('basepath')->willReturn('/var/www/mybase')->shouldBeCalled();

        $this->mvcEvent = $this->prophesize(MvcEvent::class);
        $this->mvcEvent->getRouteMatch()->willReturn($this->routeMatch->reveal())->shouldBeCalled();
        $this->application = $this->prophesize(Application::class);
        $this->application->getMvcEvent()->willReturn($this->mvcEvent->reveal())->shouldBeCalled();
        $this->container->get('Application')
          ->willReturn($this->application)
          ->shouldBeCalled();

        $factory = new ModuleStructureFactory();
        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf(ModuleStructure::class, $instance);

        $this->assertEquals('FakeModule', $instance->getModuleName());

    }

    public function testRunConstructor()
    {
        $this->routeMatch->getParam('module')->willReturn('FakeModule')->shouldBeCalled();
        $this->routeMatch->getParam('action')->willReturn('create-controller')->shouldBeCalled();
        $this->routeMatch->getParam('type', null)->willReturn('api')->shouldBeCalled();
        $this->routeMatch->getParam('basepath')->willReturn('/var/www/mybase')->shouldBeCalled();

        $this->mvcEvent = $this->prophesize(MvcEvent::class);
        $this->mvcEvent->getRouteMatch()->willReturn($this->routeMatch->reveal())->shouldBeCalled();
        $this->application = $this->prophesize(Application::class);
        $this->application->getMvcEvent()->willReturn($this->mvcEvent->reveal())->shouldBeCalled();
        $this->container->get('Application')
          ->willReturn($this->application)
          ->shouldBeCalled();

        $factory = new ModuleStructureFactory();
        $instance = $factory->__invoke($this->container->reveal(), null, null);

        $this->assertInstanceOf(ModuleStructure::class, $instance);

        $this->assertEquals('FakeModule', $instance->getModuleName());
    }

}
