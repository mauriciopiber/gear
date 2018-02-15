<?php
namespace GearTest\ConstructorTest\DbTest;

use PHPUnit\Framework\TestCase;
use Gear\Constructor\Db\DbConstructorTrait;
use Gear\Constructor\Db\DbConstructor;
use GearJson\Action\ActionSchema;
use Exception;
use GearJson\Db\Db;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Module\BasicModuleStructure;
use GearBase\Util\ConsoleValidation\ConsoleValidationStatus;

/**
 * @group fix-table
 * @group Constructor
 * @group module
 * @group module-constructor
 * @group module-constructor-db
 * @group module-constructor-db-service
 */
class DbConstructorTest extends TestCase
{
    use DbConstructorTrait;

    public function setUp()
    {

        $this->dbService = $this->prophesize('GearJson\Db\DbSchema');
        $this->configService = $this->prophesize('Gear\Mvc\Config\ConfigService');
        $this->tableService = $this->prophesize('Gear\Table\TableService\TableService');
        $this->columnService = $this->prophesize('Gear\Column\ColumnService');
        $this->repositoryService = $this->prophesize(RepositoryService::class);
        $this->formService = $this->prophesize(FormService::class);
        $this->filterService = $this->prophesize(FilterService::class);
        $this->searchFormService = $this->prophesize(SearchService::class);
        $this->actionService = $this->prophesize(ActionSchema::class);
        $this->entityService = $this->prophesize(EntityService::class);
        $this->fixtureService = $this->prophesize(FixtureService::class);
        $this->feature = $this->prophesize(Feature::class);
        $this->step = $this->prophesize(Step::class);
        $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->serviceService = $this->prophesize('Gear\Mvc\Service\ServiceService');
        $this->languageService = $this->prophesize('Gear\Mvc\LanguageService');
        $this->controllerService = $this->prophesize('Gear\Mvc\Controller\Web\WebControllerService');
        //$this->controllerTestService = $this->prophesize('Gear\Mvc\Controller\Web\WebControllerService');
        $this->viewService = $this->prophesize('Gear\Mvc\View\ViewService');

        $this->service = new DbConstructor(
            $this->columnService->reveal(),
            $this->tableService->reveal(),
            $this->actionService->reveal(),
            $this->dbService->reveal(),
            $this->feature->reveal(),
            $this->step->reveal(),
            $this->entityService->reveal(),
            $this->searchFormService->reveal(),
            $this->fixtureService->reveal(),
            $this->filterService->reveal(),
            $this->formService->reveal(),
            $this->controllerService->reveal(),
            //$this->controllerTestService->reveal(),
            $this->configService->reveal(),
            $this->languageService->reveal(),
            $this->viewService->reveal(),
            $this->repositoryService->reveal(),
            $this->serviceService->reveal(),
            $this->module->reveal()
        );

    }

    /**
     * @group a1
     */
    public function testCreateDbWithDefaultValues()
    {
        $table = 'MyTable';
        $module = 'MyModule';

        $this->db = $this->prophesize('GearJson\Db\Db');
        $this->db->getTable()->willReturn($table)->shouldBeCalled();
        $this->db->getNamespace()->willReturn($table);

        $this->module->getModuleName()->willReturn($module)->shouldBeCalled();

        $this->dbService->create(
            $module,
            [
                'table' => $table,
                /*
                'columns' => [***REMOVED***,
                'user' => 'all',
                'role' => 'admin',
                'service' => 'factories',
                'namespace' => null
                */
            ***REMOVED***,
            false
        )->willReturn($this->db->reveal())
        ->shouldBeCalled();

        $this->tableObject = $this->prophesize('Zend\Db\Metadata\Object\TableObject');
        $this->db->setTableObject($this->tableObject->reveal())->shouldBeCalled();

        $this->columnManager = $this->prophesize('Gear\Column\ColumnManager');
        $this->db->setColumnManager($this->columnManager->reveal())->shouldBeCalled();

        $this->columnService->getColumnManager($this->db)->willReturn($this->columnManager->reveal())->shouldBeCalled();

        $this->tableService->getTableObject($table)->willReturn($this->tableObject->reveal())->shouldBeCalled();
        $this->tableService->verifyTableAssociation($table, 'upload_image')->willReturn(true)->shouldBeCalled();

        $this->serviceService->createService($this->db->reveal())->shouldBeCalled();
        $this->repositoryService->createRepository($this->db->reveal())->shouldBeCalled();
        $this->formService->createForm($this->db->reveal())->shouldBeCalled();
        $this->filterService->createFilter($this->db->reveal())->shouldBeCalled();
        $this->searchFormService->createSearchForm($this->db->reveal())->shouldBeCalled();
        $this->controllerService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->step->createTableStep($this->db->reveal())->shouldBeCalled();
        $this->feature->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->entityService->createEntity($this->db->reveal())->shouldBeCalled();
        $this->fixtureService->createFixture($this->db->reveal())->shouldBeCalled();
        $this->languageService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->viewService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->configService->introspectFromTable($this->db->reveal())->shouldBeCalled();

        $service = $this->service->create([
            'table' => $table
        ***REMOVED***);


        $this->assertInstanceOf(Db::class, $service);
    }

    /**
     * @group x2
     */
    public function testCreate()
    {
        $table = 'MyTable';
        $columns = [***REMOVED***;
        $user = 'all';
        $role = 'guest';
        $namespace = 'MyTable';
        $module = 'MyModule';

        $this->db = $this->prophesize(Db::class);
        $this->db->getTable()->willReturn($table)->shouldBeCalled();
        $this->db->getNamespace()->willReturn($namespace);

        $this->module->getModuleName()->willReturn($module)->shouldBeCalled();

        $this->dbService->create(
            $module,
            [
                'table' => $table,
                'columns' => $columns,
                'user' => $user,
                'role' => $role,
                'namespace' => $namespace,
            ***REMOVED***,
            false
        )->willReturn($this->db->reveal())
        ->shouldBeCalled();

        $this->tableObject = $this->prophesize('Zend\Db\Metadata\Object\TableObject');

        $this->db->setTableObject($this->tableObject->reveal())->shouldBeCalled();


        $this->columnManager = $this->prophesize('Gear\Column\ColumnManager');
        $this->db->setColumnManager($this->columnManager->reveal())->shouldBeCalled();

        $this->columnService->getColumnManager($this->db)->willReturn($this->columnManager->reveal())->shouldBeCalled();

        $this->tableService->getTableObject($table)->willReturn($this->tableObject->reveal())->shouldBeCalled();
        $this->tableService->verifyTableAssociation($table, 'upload_image')->willReturn(true)->shouldBeCalled();


        $this->serviceService->createService($this->db->reveal())->shouldBeCalled();
        $this->repositoryService->createRepository($this->db->reveal())->shouldBeCalled();
        $this->formService->createForm($this->db->reveal())->shouldBeCalled();
        $this->filterService->createFilter($this->db->reveal())->shouldBeCalled();
        $this->searchFormService->createSearchForm($this->db->reveal())->shouldBeCalled();
        $this->controllerService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->step->createTableStep($this->db->reveal())->shouldBeCalled();
        $this->feature->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->entityService->createEntity($this->db->reveal())->shouldBeCalled();
        $this->fixtureService->createFixture($this->db->reveal())->shouldBeCalled();
        $this->languageService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->viewService->introspectFromTable($this->db->reveal())->shouldBeCalled();
        $this->configService->introspectFromTable($this->db->reveal())->shouldBeCalled();

        $service = $this->service->create([
            'table' => $table,
            'columns' => $columns,
            'user' => $user,
            'role' => $role,
            'namespace' => $namespace
        ***REMOVED***);

        $this->assertInstanceOf(Db::class, $service);
    }

    /**
     * @group a1
     */
    public function testCreateDbReturnConsoleValidation()
    {
        $table = 'MyTable';
        $columns = [***REMOVED***;
        $user = 'all';
        $role = 'guest';
        $service = 'factories';
        $namespace = 'MyTable';
        $module = 'MyModule';

        $this->module->getModuleName()->willReturn($module)->shouldBeCalled();

        $this->consoleValidation = $this->prophesize(ConsoleValidationStatus::class);

        $this->dbService->create(
            $module,
            [
                'table' => $table,
                'columns' => $columns,
                'user' => $user,
                'role' => $role,
                'namespace' => $namespace,
            ***REMOVED***,
            false
            )->willReturn($this->consoleValidation->reveal())
        ->shouldBeCalled();

        $service = $this->service->create([
            'table' => $table,
            'columns' => $columns,
            'user' => $user,
            'role' => $role,
            'namespace' => $namespace
        ***REMOVED***);


        $this->assertEquals($this->consoleValidation->reveal(), $service);
    }
}
