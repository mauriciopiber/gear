<?php
namespace GearTest\ConstructorTest\SrcTest;

use Gear\Column\ColumnManager;
use Gear\Column\ColumnService;
use Gear\Console\ConsoleValidation\ConsoleValidationStatus;
use Gear\Constructor\Src\Exception\SrcTypeNotFoundException;
use Gear\Constructor\Src\SrcConstructor;
use Gear\Module\ConstructStatusObject;
use Gear\Module\Structure\ModuleStructure;
use Gear\Mvc\Config\ServiceManager;
use Gear\Mvc\ControllerPlugin\ControllerPluginService;
use Gear\Mvc\ControllerPlugin\ControllerPluginTestService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Entity\EntityTestService;
use Gear\Mvc\Factory\FactoryService;
use Gear\Mvc\Factory\FactoryTestService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Filter\FilterTestService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Form\FormTestService;
use Gear\Mvc\InterfaceService;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Repository\RepositoryTestService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Service\ServiceTestService;
use Gear\Mvc\TraitService;
use Gear\Mvc\TraitTestService;
use Gear\Mvc\ValueObject\ValueObjectService;
use Gear\Mvc\ValueObject\ValueObjectTestService;
use Gear\Mvc\ViewHelper\ViewHelperService;
use Gear\Mvc\ViewHelper\ViewHelperTestService;
use Gear\Schema\Db\Db;
use Gear\Schema\Src\Src;
use Gear\Schema\Src\SrcSchema;
use Gear\Table\TableService\TableService;
use PHPUnit\Framework\TestCase;
use Zend\Db\Metadata\Object\TableObject;

/**
 * @group module
 */
class SrcConstructorTest extends TestCase
{

    public function setUp() : void
    {
        $this->module = $this->prophesize(ModuleStructure::class);
        //$this->service->setSrcConstructor($schema);
        //$this->service->setRepositoryService($repository);
        //$this->service->setServiceManager($config);
        $this->schema = $this->prophesize(SrcSchema::class);
        $this->serviceService = $this->prophesize(ServiceService::class);
        $this->serviceTestService = $this->prophesize(ServiceTestService::class);
        $this->serviceManager = $this->prophesize(ServiceManager::class);
        $this->factory = $this->prophesize(FactoryService::class);
        $this->factoryTest = $this->prophesize(FactoryTestService::class);
        $this->trait = $this->prophesize(TraitService::class);
        $this->traitTest = $this->prophesize(TraitTestService::class);
        $this->tableService = $this->prophesize(TableService::class);
        $this->columnService = $this->prophesize(ColumnService::class);
        $this->repositoryService = $this->prophesize(RepositoryService::class);
        $this->repositoryTestService = $this->prophesize(RepositoryTestService::class);
        $this->formService = $this->prophesize(FormService::class);
        $this->formTestService = $this->prophesize(FormTestService::class);
        $this->filterService = $this->prophesize(FilterService::class);
        $this->filterTestService = $this->prophesize(FilterTestService::class);
        $this->controllerPluginService = $this->prophesize(ControllerPluginService::class);
        $this->controllerPluginTestService = $this->prophesize(ControllerPluginTestService::class);
        $this->viewHelperService = $this->prophesize(ViewHelperService::class);
        $this->viewHelperTestService = $this->prophesize(ViewHelperTestService::class);
        $this->entityService = $this->prophesize(EntityService::class);
        $this->entityTestService = $this->prophesize(EntityTestService::class);
        $this->fixtureService = $this->prophesize(FixtureService::class);
        $this->interfaceService = $this->prophesize(InterfaceService::class);
        $this->valueObjectService = $this->prophesize(ValueObjectService::class);
        $this->valueObjectTestService = $this->prophesize(ValueObjectTestService::class);
        $this->construct = $this->prophesize(ConstructStatusObject::class);


        $this->service = new SrcConstructor(
            $this->tableService->reveal(),
            $this->columnService->reveal(),
            $this->module->reveal(),
            $this->schema->reveal(),
            $this->serviceManager->reveal(),
            $this->trait->reveal(),
            $this->traitTest->reveal(),
            $this->factory->reveal(),
            $this->factoryTest->reveal(),
            $this->formService->reveal(),
            $this->formTestService->reveal(),
            $this->filterService->reveal(),
            $this->filterTestService->reveal(),
            $this->entityService->reveal(),
            $this->entityTestService->reveal(),
            $this->valueObjectService->reveal(),
            $this->valueObjectTestService->reveal(),
            $this->viewHelperService->reveal(),
            $this->viewHelperTestService->reveal(),
            $this->controllerPluginService->reveal(),
            $this->controllerPluginTestService->reveal(),
            $this->repositoryService->reveal(),
            $this->repositoryTestService->reveal(),
            $this->serviceService->reveal(),
            $this->serviceTestService->reveal(),
            $this->fixtureService->reveal(),
            $this->interfaceService->reveal(),
            $this->construct->reveal()
        );

    }

    public function mockSchemaSrcCreate($module, $name, $type)
    {
        $this->schema->create(
            $module,
            [
                'name' => $name,
                'type' => $type,
            ***REMOVED***,
            false
        )->willReturn($this->src->reveal())->shouldBeCalled();
    }

    public function mockConsoleValidation($module, $name, $type)
    {
        $this->schema->create(
            $module,
            [
                'name' => $name,
                'type' => $type,
            ***REMOVED***,
            false
        )->willReturn($this->consoleValidation->reveal())->shouldBeCalled();
    }

    public function assertCreateSrc($name, $type)
    {
        $this->mockSchemaSrcCreate('MyModule', $name, $type);

        $srcData = [
            'type' => $type,
            'name' => $name
        ***REMOVED***;

        $create = $this->service->create($srcData);
        $this->assertInstanceOf(ConstructStatusObject::class, $create);

    }

    /**
     * @group mmm3
     */
    public function testCreateEntities()
    {
        $data = [
            [
                'name' => 'MyEntityOne',
                'type' => 'Entity'
            ***REMOVED***,
            [
                'name' => 'MyEntityTwo',
                'type' => 'Entity'
            ***REMOVED***
        ***REMOVED***;

        $tableObjectOne = $this->prophesize(TableObject::class);

        $dbOne = $this->prophesize(Db::class);
        $dbOne->getTable()->willReturn('MyEntityOne')->shouldBeCalled();

        $srcOne = $this->prophesize(Src::class);
        $srcOne->getDb()->willReturn($dbOne->reveal())->shouldBeCalled();
        $this->schema->create(
            'MyModule',
            [
                'name' => 'MyEntityOne',
                'type' => 'Entity',
            ***REMOVED***,
            false
        )->willReturn($srcOne->reveal())->shouldBeCalled();

        $this->tableService->getTableObject('MyEntityOne')->willReturn($tableObjectOne->reveal())->shouldBeCalled();

        $dbOne->setTableObject($tableObjectOne->reveal())->shouldBeCalled();

        $columnManagerOne = $this->prophesize(ColumnManager::class);
        $this->columnService->getColumnManager($dbOne->reveal())->willReturn($columnManagerOne->reveal());
        $dbOne->setColumnManager($columnManagerOne)->shouldBeCalled();

        $tableObjectTwo = $this->prophesize(TableObject::class);

        $dbTwo = $this->prophesize(Db::class);
        $dbTwo->getTable()->willReturn('MyEntityTwo')->shouldBeCalled();


        $srcTwo = $this->prophesize(Src::class);
        $srcTwo->getDb()->willReturn($dbTwo->reveal())->shouldBeCalled();
        $this->schema->create(
            'MyModule',
            [
                'name' => 'MyEntityTwo',
                'type' => 'Entity',
            ***REMOVED***,
            false
        )->willReturn($srcTwo->reveal())->shouldBeCalled();

        $this->tableService->getTableObject('MyEntityTwo')->willReturn($tableObjectTwo->reveal())->shouldBeCalled();

        $dbTwo->setTableObject($tableObjectTwo->reveal())->shouldBeCalled();

        $columnManagerTwo = $this->prophesize(ColumnManager::class);
        $this->columnService->getColumnManager($dbTwo->reveal())->willReturn($columnManagerTwo->reveal());
        $dbTwo->setColumnManager($columnManagerTwo)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->entityService->createEntities([
            $srcOne->reveal(),
            $srcTwo->reveal()
        ***REMOVED***)->willReturn(true)->shouldBeCalled();

        $this->assertEquals(
            [
                'created' => [
                    $srcOne->reveal(),
                    $srcTwo->reveal()
                ***REMOVED***,
                'validated' => [***REMOVED***
            ***REMOVED***,
            $this->service->createEntities($data)
        );
    }

    /**
     * @group x3
     */
    public function testCreateServiceSrc()
    {
        $name = 'MyService';
        $type = 'Service';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->serviceService->createService($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x2
     */
    public function testCreateRepositorySrc()
    {
        $name = 'MyRepository';
        $type = 'Repository';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->repositoryService->createRepository($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x6
     */
    public function testCreateFormSrc()
    {
        $name = 'MyForm';
        $type = 'Form';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->formService->createForm($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x4
     */
    public function testCreateFilterSrc()
    {
        $name = 'MyFilter';
        $type = 'Filter';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->filterService->createFilter($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x5
     */
    public function testCreateEntitySrc()
    {
        $name = 'MyEntity';
        $type = 'Entity';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->entityService->createEntity($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x5
     */
    public function testCreateFixtureSrc()
    {
        $name = 'MyFixture';
        $type = 'Fixture';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->fixtureService->createFixture($this->src->reveal())->willReturn(true)->shouldBeCalled();
        //$this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x5
     */
    public function testCreateViewHelperSrc()
    {
        $name = 'MyViewHelper';
        $type = 'ViewHelper';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->viewHelperService->createViewHelper($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x5
     */
    public function testCreateControllerPluginSrc()
    {
        $name = 'MyControllerPlugin';
        $type = 'ControllerPlugin';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->controllerPluginService->createControllerPlugin($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }


    /**
     * @group x7
     */
    public function testCreateValueObjectSrc()
    {
        $name = 'MyValueObject';
        $type = 'ValueObject';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->valueObjectService->createValueObject($this->src->reveal())->willReturn(true)->shouldBeCalled();
        //$this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x7
     */
    public function testCreateInterfaceSrc()
    {
        $name = 'MyInterface';
        $type = 'Interface';

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->interfaceService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
        //$this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }


    /**
     * @group x1
     */
    public function testCreateServiceSrcWithDb()
    {
        $name = 'MyService';
        $type = 'Service';

        $this->tableObject = $this->prophesize(TableObject::class);
        $this->columnManager = $this->prophesize(ColumnManager::class);

        $this->db = $this->prophesize(Db::class);

        $this->columnService->getColumnManager($this->db)->willReturn($this->columnManager->reveal())->shouldBeCalled();
        $this->tableService->getTableObject('My')->willReturn($this->tableObject->reveal())->shouldBeCalled();

        $this->db->getTable()->willReturn('My')->shouldBeCalled();
        $this->db->setTableObject($this->tableObject->reveal())->shouldBeCalled();
        $this->db->setColumnManager($this->columnManager->reveal())->shouldBeCalled();

        $this->src = $this->prophesize(Src::class);
        $this->src->getName()->willReturn($name)->shouldBeCalled();
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn($this->db->reveal())->shouldBeCalled();
        $this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        $this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->serviceService->createService($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $srcData = [
            'type' => 'Service',
            'name' => 'MyService'
        ***REMOVED***;

        $create = $this->service->create($srcData);
        $this->assertInstanceOf(ConstructStatusObject::class, $create);
    }

    public function testCreateServiceReturnConsoleValidationStatus()
    {
        $name = 'InvalidService';
        $type = 'Service';

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->mockConsoleValidation('MyModule', $name, $type);

        $srcData = [
            'type' => $type,
            'name' => $name
        ***REMOVED***;

        //$this->assertEquals($this->consoleValidation->reveal(), $this->service->create($srcData));
        $this->assertInstanceOf(ConstructStatusObject::class, $this->service->create($srcData));
    }

    /**
     * @group mmm1
     * @group mmm2
     */
    public function testCreateFactory()
    {
        $type = 'Factory';

        $this->src = $this->prophesize(Src::class);
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        //$this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->schema->factory(
            'MyModule',
            [
                'name' => 'MyService',
                'type' => 'Factory',
            ***REMOVED***,
            false
        )->willReturn($this->src->reveal())->shouldBeCalled();

        //$this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $this->factory->createFactory($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->factory->createConstructorSnippet($this->src->reveal())->willReturn(true)->shouldBeCalled();



        $this->factoryTest->createFactoryTest($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->factoryTest->createConstructorSnippet($this->src->reveal())->willReturn(true)->shouldBeCalled();

        $data = [
            'name' => 'MyService',
            'type' => 'Factory'
        ***REMOVED***;

        $create = $this->service->createAdditional([$data***REMOVED***);
        $this->assertEquals(
            [$this->src->reveal()***REMOVED***,
            $create['created'***REMOVED***
        );

    }

    /**
     * @group mmm1
     */
    public function testCreateTrait()
    {
        $type = 'Trait';

        $this->src = $this->prophesize(Src::class);
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        //$this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->schema->factory(
            'MyModule',
            [
                'name' => 'MyService',
                'type' => 'Trait',
            ***REMOVED***,
            false
        )->willReturn($this->src->reveal())->shouldBeCalled();

        $this->trait->createTrait($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->traitTest->createTraitTest($this->src->reveal())->willReturn(true)->shouldBeCalled();


        $data = [
            'name' => 'MyService',
            'type' => 'Trait'
        ***REMOVED***;

        $create = $this->service->createAdditional([$data***REMOVED***);
        $this->assertEquals(
            [$this->src->reveal()***REMOVED***,
            $create['created'***REMOVED***
        );
    }

    /**
     * @group g1
     */
    public function testCreateSrcTypeNotExist()
    {
        $type = 'MyNewType';
        $name = 'MyService';

        $this->expectException(SrcTypeNotFoundException::class);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->src = $this->prophesize(Src::class);
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();
        //$this->src->isAbstract()->willReturn(false)->shouldBeCalled();
        //$this->src->isFactory()->willReturn(false)->shouldBeCalled();

        $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $data = [
            'type' => $type,
            'name' => $name
        ***REMOVED***;

        $this->service->create($data);
    }

    // /**
    //  * @group g1
    //  */
    // public function testCreateSrcWithoutType()
    // {
    //     $type = null;
    //     $name = 'MyService';

    //     $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

    //     $this->src = $this->prophesize(Src::class);
    //     $this->src->getName()->willReturn(null)->shouldBeCalled();
    //     $this->src->getType()->willReturn(null)->shouldBeCalled();
    //     $this->src->getDb()->willReturn(null)->shouldBeCalled();

    //     $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

    //     $data = [
    //         'type' => $type,
    //         'name' => $name
    //     ***REMOVED***;

    //     $create = $this->service->create($data);
    //     $this->assertEquals(SrcConstructor::TYPE_NOT_FOUND, $create);
    // }
}
