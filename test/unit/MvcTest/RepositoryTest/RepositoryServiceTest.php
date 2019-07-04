<?php
namespace GearTest\MvcTest\RepositoryTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Vector\ArrayService;
use Gear\Util\String\StringService;
use Gear\Util\Dir\DirService;
use Gear\Schema\Db\Db;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Repository\MappingService;
use Gear\Module;
use Gear\Creator\Injector\Injector;
use Gear\Column\Integer\ForeignKey;
use Gear\Table\TableService\TableService;
use Gear\Schema\Schema\SchemaService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Column\ColumnService;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;
use GearTest\MvcTest\RepositoryTest\RepositoryDataTrait;
use GearTest\UtilTestTrait;
use \Gear\Schema\Src\Src;
use Gear\Creator\Component\Constructor\ConstructorParams;
use Gear\Column\ColumnManager;

/**
 * @group src-mvc
 * @group db-repository
 */
class RepositoryServiceTest extends TestCase
{
    use UtilTestTrait;
    use ScopeTrait;
    use RepositoryDataTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Repository';
        $this->createVirtualDir($this->vfsLocation);


        $this->templates =  (new Module())->getLocation().'/../test/template/module/mvc/repository';

        $this->module = $this->prophesize(ModuleStructure::class);

        $this->string = new StringService();

        $this->fileCreator    = $this->createFileCreator();

        $this->dirService = new DirService();


        $this->arrayService = new ArrayService();

        $this->injector = new Injector($this->arrayService);

        //$this->column = $this->prophesize(ColumnService::class);
        //$this->repository->setColumnService($this->column->reveal());

        $this->table = $this->prophesize(TableService::class);

        $this->schema = $this->prophesize(SchemaService::class);
        //$this->repository->setSchemaService($this->schema->reveal());



        $this->repository = new RepositoryService(
            $this->module->reveal(),
            $this->createFileCreator(),
            $this->string,
            $this->createCode(),
            $this->createDirService(),
            //$this->factoryService->reveal(),
            $this->table->reveal(),
            $this->arrayService,
            $this->injector
        );
    }

    /**
     * @group fix-dependency2
     */
    public function testCreateRepositoryWithSpecialDependency()
    {
        $data = new Src(require __DIR__.'/../_gearfiles/repository-with-special-dependency.php');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));


        $file = $this->repository->createRepository($data);

        $expected = $this->templates.'/src/repository-with-special-dependency.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    public function src()
    {
        $srcType = 'Repository';

        return $this->getScope($srcType);
    }

    /**
     * @group src-mvc
     * @group src-mvc-repository
     *
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {
            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));
        } else {
            $this->module->map('Repository')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $file = $this->repository->createRepository($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }

    /**
     * @dataProvider tables
     * @group inter
     */
    public function testInstrospectTable($columns, $template, $nullable, $tableName, $namespace, $service)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getNamespace()->willReturn('MyModule')->shouldBeCalled();

        $table = $this->string->str('class', $tableName);

        $this->db = new Db(['table' => sprintf('%s', $table)***REMOVED***);

        $createdBy = new ForeignKey(
            $this->prophesizeColumn('table', 'created_by', 'int'),
            $this->prophesizeForeignKey('table', 'created_by', 'FOREIGN KEY', 'user'),
            'email'
        );

        //$schema = $this->prophesize(TableService::class);
        //$schema->getReferencedTableValidColumnName('user')
        //->willReturn('email');

        //$createdBy->setTableService($schema->reveal());

        $columns[***REMOVED*** = $createdBy;

        //$this->column->getColumns($this->db, false, ['created_by'***REMOVED***)->willReturn($columns)->shouldBeCalled();
        $this->db->setColumnManager(new ColumnManager($columns));
        //$this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();
        //$this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(true);

        $this->table->getReferencedTableValidColumnName('Table')->willReturn('idMyController');
        $this->table->getReferencedTableValidColumnName('user')->willReturn('email');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);
        $this->table->getReferencedTableValidColumnName('foreign_key_column')->willReturn('idForeignKeyColumn');
        $this->table->getConstraintForeignKeyFromColumn($this->db->getTable(), $columns[9***REMOVED***->getColumn())->willReturn($columns[9***REMOVED***->getConstraint());
        $this->table->getConstraintForeignKeyFromColumn($this->db->getTable(), $columns[22***REMOVED***->getColumn())->willReturn($columns[22***REMOVED***->getConstraint());

        $repository = new Src([
            'name' => sprintf('%sRepository', $table),
            'type' => 'Repository',
            'namespace' => $namespace,
            'service' => $service,
            'dependency' => [
                'doctrine.entitymanager.orm_default' => '\Doctrine\ORM\EntityManager',
                '\GearBase\Repository\QueryBuilder'
            ***REMOVED***
        ***REMOVED***);

        if ($namespace === null) {
            $location = vfsStream::url('module/src/MyModule/Repository');
            $this->module->map('Repository')->willReturn($location)->shouldBeCalled();
        } else {
            $location = vfsStream::url('module/src/MyModule');
            $this->module->getSrcModuleFolder()->willReturn($location)->shouldBeCalled();
            $location .= '/'.str_replace('\\', '/', $namespace);
        }

        $this->schema->getSrcByDb($this->db, 'Repository')->willReturn($repository);

        $this->mapping = new MappingService(
            $this->module->reveal(),
            $this->createFileCreator(),
            $this->string,
            $this->createCode(),
            $this->createDirService(),
            //$this->factoryService->reveal(),
            $this->table->reveal(),
            $this->arrayService,
            $this->injector
        );

        $this->repository->setMappingService($this->mapping);
        $this->repository->setSchemaService($this->schema->reveal());

        $file = $this->repository->createRepository($this->db);

        $expected = $this->templates.'/db/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$repository->getName().'.php', $file);
    }
}
