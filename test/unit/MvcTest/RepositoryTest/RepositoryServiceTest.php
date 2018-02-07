<?php
namespace GearTest\MvcTest\RepositoryTest;

use PHPUnit_Framework_TestCase as TestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\ScopeTrait;
use GearTest\MvcTest\RepositoryTest\RepositoryDataTrait;
use GearTest\UtilTestTrait;
use \GearJson\Src\Src;
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

    public function setUp()
    {
        parent::setUp();

        $this->vfsLocation = 'module/src/MyModule/Repository';
        $this->createVirtualDir($this->vfsLocation);


        $this->templates =  (new \Gear\Module())->getLocation().'/../test/template/module/mvc/repository';

        $this->repository = new \Gear\Mvc\Repository\RepositoryService();

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->repository->setModule($this->module->reveal());

        $this->string = new \GearBase\Util\String\StringService();
        $this->repository->setStringService($this->string);

        $template       = new \Gear\Creator\Template\TemplateService    ();
        $template->setRenderer($this->mockPhpRenderer());
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);
        $this->repository->setFileCreator($this->fileCreator);

        $this->dirService = new \GearBase\Util\Dir\DirService();


        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->code->setDirService($this->dirService);

        $constructorParams = new ConstructorParams($this->string);
        $this->code->setConstructorParams($constructorParams);

        $this->repository->setCode($this->code);

        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->repository->setFactoryService($this->factory->reveal());

        $this->trait = $this->prophesize('Gear\Mvc\TraitService');
        $this->repository->setTraitService($this->trait->reveal());

        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        $this->injector = new \Gear\Creator\Injector\Injector($this->arrayService);
        $this->repository->setInjector($this->injector);

        //$this->column = $this->prophesize('Gear\Column\ColumnService');
        //$this->repository->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->repository->setTableService($this->table->reveal());

        $this->schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $this->repository->setSchemaService($this->schemaService->reveal());

        $this->repositoryTest = $this->prophesize('Gear\Mvc\Repository\RepositoryTestService');
        $this->repository->setRepositoryTestService($this->repositoryTest->reveal());
    }

    /**
     * @group fix-dependency2
     */
    public function testCreateRepositoryWithSpecialDependency()
    {
        $data = new Src(require __DIR__.'/../_gearfiles/repository-with-special-dependency.php');

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        $this->factory->createFactory($data)->shouldBeCalled();

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

        if (!empty($data->getNamespace())) {
            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));
        } else {
            $this->module->map('Repository')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        if ($data->getService() == 'factories' && $data->getAbstract() == false) {
            $this->factory->createFactory($data)->shouldBeCalled();
        }

        $this->repositoryTest->createRepositoryTest($data)->shouldBeCalled();

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

        $table = $this->string->str('class', $tableName);

        $this->db = new \GearJson\Db\Db(['table' => sprintf('%s', $table)***REMOVED***);

        $createdBy = new \Gear\Column\Integer\ForeignKey(
            $this->prophesizeColumn('table', 'created_by', 'int'),
            $this->prophesizeForeignKey('table', 'created_by', 'FOREIGN KEY', 'user'),
            'email'
        );

        //$schema = $this->prophesize('Gear\Table\TableService\TableService');
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

        $this->schemaService->getSrcByDb($this->db, 'Repository')->willReturn($repository);

        $this->mapping = new \Gear\Mvc\Repository\MappingService();
        $this->mapping->setStringService($this->string);
        //$this->mapping->setColumnService($this->column->reveal());
        $this->mapping->setTableService($this->table->reveal());
        $this->repository->setMappingService($this->mapping);

        $this->repositoryTest->createRepositoryTest($this->db)->shouldBeCalled();
        $this->trait->createTrait($repository)->shouldBeCalled();
        $this->factory->createFactory($repository)->shouldBeCalled();

        $file = $this->repository->createRepository($this->db);

        $expected = $this->templates.'/db/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

        $this->assertStringEndsWith($location.'/'.$repository->getName().'.php', $file);
    }
}