<?php
namespace GearTest\ConstructorTest\DbTest;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Constructor\Db\DbServiceFactory;
use Gear\Constructor\Db\DbService;
use Gear\Column\ColumnService;
use Gear\Table\TableService;
use GearJson\Action\ActionService;
use GearJson\Db\DbService;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Controller\ControllerService;
use Gear\Mvc\Controller\ControllerTestService;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\ViewViewService;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Module\BasicModuleStructure;

/**
 * @group Gear
 * @group DbService
 * @group Factory
 */
class DbServiceFactoryTest extends TestCase
{
    public function testDbServiceFactory()
    {
        $this->serviceLocator = $this->prophesize(ServiceLocatorInterface::class);

        $this->serviceLocator->get(ColumnService::class)
            ->willReturn($this->prophesize(ColumnService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(TableService::class)
            ->willReturn($this->prophesize(TableService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ActionService::class)
            ->willReturn($this->prophesize(ActionService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(DbService::class)
            ->willReturn($this->prophesize(DbService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(Feature::class)
            ->willReturn($this->prophesize(Feature::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(Step::class)
            ->willReturn($this->prophesize(Step::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(EntityService::class)
            ->willReturn($this->prophesize(EntityService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(SearchService::class)
            ->willReturn($this->prophesize(SearchService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FixtureService::class)
            ->willReturn($this->prophesize(FixtureService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FilterService::class)
            ->willReturn($this->prophesize(FilterService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(FormService::class)
            ->willReturn($this->prophesize(FormService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ControllerService::class)
            ->willReturn($this->prophesize(ControllerService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ControllerTestService::class)
            ->willReturn($this->prophesize(ControllerTestService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ConfigService::class)
            ->willReturn($this->prophesize(ConfigService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(LanguageService::class)
            ->willReturn($this->prophesize(LanguageService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ViewViewService::class)
            ->willReturn($this->prophesize(ViewViewService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(RepositoryService::class)
            ->willReturn($this->prophesize(RepositoryService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(ServiceService::class)
            ->willReturn($this->prophesize(ServiceService::class)->reveal())
            ->shouldBeCalled();

        $this->serviceLocator->get(BasicModuleStructure::class)
            ->willReturn($this->prophesize(BasicModuleStructure::class)->reveal())
            ->shouldBeCalled();

        $factory = new DbServiceFactory();

        $instance = $factory->createService($this->serviceLocator->reveal());

        $this->assertInstanceOf(DbService::class, $instance);
    }
}
