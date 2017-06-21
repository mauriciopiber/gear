<?php
namespace GearTest\ConstructorTest\SrcTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Constructor\Src\SrcService;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;
use Gear\Constructor\Src\Exception\SrcTypeNotFoundException;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\ValueObject\ValueObjectService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\ControllerPlugin\ControllerPluginService;
use Gear\Mvc\ViewHelper\ViewHelperService;
use Gear\Mvc\InterfaceService;
use Gear\Mvc\Entity\EntityService;

/**
 * @group module
 */
class SrcServiceTest extends TestCase
{

    public function setUp()
    {
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        //$this->service->setSrcService($schema);
        //$this->service->setRepositoryService($repository);
        //$this->service->setServiceManager($config);
        $this->schema = $this->prophesize('GearJson\Src\SrcService');
        $this->serviceService = $this->prophesize('Gear\Mvc\Service\ServiceService');
        $this->serviceManager = $this->prophesize('Gear\Mvc\Config\ServiceManager');
        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->factoryTest = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->trait = $this->prophesize('Gear\Mvc\TraitService');
        $this->traitTest = $this->prophesize('Gear\Mvc\TraitTestService');
        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $this->columnService = $this->prophesize('Gear\Column\ColumnService');
        $this->repositoryService = $this->prophesize(RepositoryService::class);
        $this->formService = $this->prophesize(FormService::class);
        $this->filterService = $this->prophesize(FilterService::class);
        $this->searchFormService = $this->prophesize(SearchService::class);
        $this->controllerPluginService = $this->prophesize(ControllerPluginService::class);
        $this->viewHelperService = $this->prophesize(ViewHelperService::class);
        $this->entityService = $this->prophesize(EntityService::class);
        $this->fixtureService = $this->prophesize(FixtureService::class);
        $this->interfaceService = $this->prophesize(InterfaceService::class);
        $this->valueObjectService = $this->prophesize(ValueObjectService::class);


        $this->service = new SrcService(
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
            $this->filterService->reveal(),
            $this->entityService->reveal(),
            $this->searchFormService->reveal(),
            $this->valueObjectService->reveal(),
            $this->viewHelperService->reveal(),
            $this->controllerPluginService->reveal(),
            $this->repositoryService->reveal(),
            $this->serviceService->reveal(),
            $this->fixtureService->reveal(),
            $this->interfaceService->reveal()
        );

    }

    public function mockSchemaSrcCreate($module, $name, $type)
    {
        $this->schema->create(
            $module,
            $name,
            $type,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
        )->willReturn($this->src->reveal())->shouldBeCalled();
    }

    public function mockConsoleValidation($module, $name, $type)
    {
        $this->schema->create(
            $module,
            $name,
            $type,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
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
        $this->assertTrue($create);

    }

    /**
     * @group x9
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

        $srcOne = $this->prophesize('GearJson\Src\Src');
        $this->schema->create(
            'MyModule',
            'MyEntityOne',
            'Entity',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
        )->willReturn($srcOne->reveal())->shouldBeCalled();

        $srcTwo = $this->prophesize('GearJson\Src\Src');
        $this->schema->create(
            'MyModule',
            'MyEntityTwo',
            'Entity',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            false
        )->willReturn($srcTwo->reveal())->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->entityService->createEntities([
            $srcOne->reveal(),
            $srcTwo->reveal()
        ***REMOVED***)->willReturn(true)->shouldBeCalled();

        $this->assertTrue($this->service->createEntities($data));
    }

    /**
     * @group x3
     */
    public function testCreateServiceSrc()
    {
        $name = 'MyService';
        $type = 'Service';

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->serviceService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->repositoryService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->formService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x6
     */
    public function testCreateSearchSrc()
    {
        $name = 'MySearchForm';
        $type = 'SearchForm';

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->searchFormService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->filterService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->entityService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->fixtureService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x5
     */
    public function testCreateViewHelperSrc()
    {
        $name = 'MyViewHelper';
        $type = 'ViewHelper';

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->viewHelperService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->controllerPluginService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->valueObjectService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }

    /**
     * @group x7
     */
    public function testCreateInterfaceSrc()
    {
        $name = 'MyInterface';
        $type = 'Interface';

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->interfaceService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->assertCreateSrc($name, $type);
    }


    /**
     * @group x1
     */
    public function testCreateServiceSrcWithDb()
    {
        $type = 'Service';

        $this->tableObject = $this->prophesize('Zend\Db\Metadata\Object\TableObject');
        $this->columnManager = $this->prophesize('Gear\Column\ColumnManager');

        $this->db = $this->prophesize('GearJson\Db\Db');

        $this->columnService->getColumnManager($this->db)->willReturn($this->columnManager->reveal())->shouldBeCalled();
        $this->tableService->getTableObject('My')->willReturn($this->tableObject->reveal())->shouldBeCalled();

        $this->db->getTable()->willReturn('My')->shouldBeCalled();
        $this->db->setTableObject($this->tableObject->reveal())->shouldBeCalled();
        $this->db->setColumnManager($this->columnManager->reveal())->shouldBeCalled();

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn($this->db->reveal())->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->serviceService->create($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->serviceManager->create($this->src)->willReturn(true)->shouldBeCalled();

        $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $srcData = [
            'type' => 'Service',
            'name' => 'MyService'
        ***REMOVED***;

        $create = $this->service->create($srcData);
        $this->assertTrue($create);
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

        $this->assertEquals($this->consoleValidation->reveal(), $this->service->create($srcData));
    }

    /**
     * @group mm1
     */
    public function testCreateFactory()
    {
        $type = 'Factory';

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $this->factory->createFactory($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->factory->createConstructorSnippet($this->src->reveal())->willReturn(true)->shouldBeCalled();



        $this->factoryTest->createFactoryTest($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->factoryTest->createConstructorSnippet($this->src->reveal())->willReturn(true)->shouldBeCalled();

        $data = [
            'name' => 'MyService',
            'type' => 'Factory'
        ***REMOVED***;

        $create = $this->service->create($data);
        $this->assertTrue($create);

    }

    /**
     * @group x2
     */
    public function testCreateTrait()
    {
        $type = 'Trait';

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $this->trait->createTrait($this->src->reveal())->willReturn(true)->shouldBeCalled();
        $this->traitTest->createTraitTest($this->src->reveal())->willReturn(true)->shouldBeCalled();


        $data = [
            'name' => 'MyService',
            'type' => 'Trait'
        ***REMOVED***;



        $create = $this->service->create($data);
        $this->assertTrue($create);
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

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn($type)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $data = [
            'type' => $type,
            'name' => $name
        ***REMOVED***;

        $this->service->create($data);
    }

    /**
     * @group g1
     */
    public function testCreateSrcWithoutType()
    {
        $type = null;
        $name = 'MyService';

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        $this->src = $this->prophesize('GearJson\Src\Src');
        $this->src->getType()->willReturn(null)->shouldBeCalled();
        $this->src->getDb()->willReturn(null)->shouldBeCalled();

        $this->mockSchemaSrcCreate('MyModule', 'MyService', $type);

        $data = [
            'type' => $type,
            'name' => $name
        ***REMOVED***;

        $create = $this->service->create($data);
        $this->assertEquals(SrcService::TYPE_NOT_FOUND, $create);
    }
}
