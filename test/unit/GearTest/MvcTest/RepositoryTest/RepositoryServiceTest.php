<?php
namespace GearTest\MvcTest\RepositoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

/**
 * @group fix-table
 * @group module
 * @group module-mvc
 * @group module-mvc-service
 * @group module-mvc-service-service-test
 * @group do-it
 * @group Repository6
 */
class RepositoryServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use \GearTest\ScopeTrait;


    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->string = new \GearBase\Util\String\StringService();
        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        $this->dirService = new \GearBase\Util\Dir\DirService();

        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/repository';

        $this->code = new \Gear\Creator\Code();
        $this->code->setStringService($this->string);
        $this->code->setModule($this->module->reveal());
        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->code->setSrcDependency($this->srcDependency);
        $this->code->setDirService($this->dirService);




        $this->factoryService = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->traitService = $this->prophesize('Gear\Mvc\TraitService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);
    }

    public function tables()
    {
        /**
        $db = new Db(['table' => 'Table'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'service' => new Service(['name' => 'Table', 'object' => '%s\Service\Table'***REMOVED***),
            'db' => $db
        ***REMOVED***);


        return [
            [$action, $this->getAllPossibleColumns(), '', true, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsNotNull(), '.not.null', false, false***REMOVED***,
            [$action, $this->getAllPossibleColumnsUnique(), '.unique', true, true***REMOVED***,
            [$action, $this->getAllPossibleColumnsUniqueNotNull(), '.unique.not.null', false, true***REMOVED***,
        ***REMOVED***;
        */
        return [
            [$this->getAllPossibleColumns(), '', true***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    public function src()
    {
        $namespace = 'Basic';

        $srcType = 'Repository';
        return [
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('CompleteFactories%s', $srcType),
                        'type' => $srcType,
                        'implements' => ['ColumnInterface\RepositoryBeforeInterface', 'ColumnInterface\RepositoryAfterInterface'***REMOVED***,
                        'dependency' => ['Repository\MyDependencyOne', 'Logic\MyDependencyTwo', 'Mvc\MyDependencyThree'***REMOVED***,
                        'extends' => 'Repository\AbstractRepository',
                        'namespace' => 'Greatest',
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'complete-factories',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicAbstract%s', $srcType),
                        'type' => $srcType,
                        'abstract' => true
                    ***REMOVED***
                ),
                'basic-abstract',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependencies%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependencyOne', 'Repository\MyDependencyTwo', 'Repository\MyDependencyThree'***REMOVED***
                    ***REMOVED***
                ),
                'basic-dependencies',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependency%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependency'***REMOVED***
                    ***REMOVED***
                ),
                'basic-dependency',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependenciesFactory%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependencyOne', 'Repository\MyDependencyTwo', 'Repository\MyDependencyThree'***REMOVED***,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-dependencies-factory',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicDependencyFactory%s', $srcType),
                        'type' => $srcType,
                        'dependency' => ['Repository\MyDependency'***REMOVED***,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-dependency-factory',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicFactory%s', $srcType),
                        'type' => $srcType,
                        'service' => 'factories'
                    ***REMOVED***
                ),
                'basic-factory',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicImplements%s', $srcType),
                        'type' => $srcType,
                        'implements' => [
                            '\Zend\ServiceManager\ServiceLocatorAwareInterface'

                        ***REMOVED***,
                        'dependency' => [
                            '\Zend\ServiceManager\ServiceLocatorAware'
                        ***REMOVED***
                    ***REMOVED***
                ),
                'basic-implements',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicImplementsDependencies%s', $srcType),
                        'type' => $srcType,
                        'implements' => [
                            '\Zend\ServiceManager\ServiceLocatorAwareInterface',
                            'Repository\DbQueryInterface',
                            'Repository\DbAdapterInterface'
                        ***REMOVED***,
                        'dependency' => [
                            '\Zend\ServiceManager\ServiceLocatorAware',
                            'Repository\DbQuery',
                            'Repository\DbAdapter'
                        ***REMOVED***
                    ***REMOVED***
                ),
                'basic-implements-dependencies',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('Basic%s', $srcType),
                        'type' => $srcType,
                        'extends' => 'Repository\AbstractRepository'
                    ***REMOVED***
                ),
                'basic-extends',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('BasicNamespace%s', $srcType),
                        'type' => $srcType,
                        'namespace' => $namespace
                    ***REMOVED***
                ),
                'basic-namespace',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('LongNamespace%s', $srcType),
                        'type' => $srcType,
                        'namespace' => 'Basic\\Feature\\Issue\\Task'
                    ***REMOVED***
                ),
                'long-namespace',
            ***REMOVED***,
            [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('Basic%s', $srcType),
                        'type' => $srcType
                    ***REMOVED***
                ),
                'basic',
            ***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @group RefactoringSrc
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if ($data->getAbstract()) {
            $this->module->getRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        } elseif (!empty($data->getNamespace())) {

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        } else {
            $this->module->map('Repository')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $this->repository = new \Gear\Mvc\Repository\RepositoryService();

        if ($data->getService() == 'factories') {
            $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');

            if (!empty($data->getNamespace())) {
               $this->factory->createFactory(
                   $data,
                   vfsStream::url('module/src/MyModule').'/'.str_replace('\\', '/', $data->getNamespace())
               )->shouldBeCalled();
            } else {
                $this->factory->createFactory($data, vfsStream::url('module'))->shouldBeCalled();
            }


            $this->repository->setFactoryService($this->factory->reveal());
        }


        $this->repository->setFileCreator($this->fileCreator);
        $this->repository->setStringService($this->string);
        $this->repository->setModule($this->module->reveal());
        $this->repository->setCode($this->code);


        $this->repository->setTraitService($this->traitService->reveal());

        $srcDependency = $this->prophesize('Gear\Creator\SrcDependency');
        $this->repository->setSrcDependency($srcDependency->reveal());


        $this->repositoryTest = $this->prophesize('Gear\Mvc\Repository\RepositoryTestService');

        $this->repository->setRepositoryTestService($this->repositoryTest->reveal());

        $file = $this->repository->create($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );


        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        //$this->module->getRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     */
    public function testInstrospectTable($columns, $template, $nullable)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => 'Table'***REMOVED***);

        $this->repository = new \Gear\Mvc\Repository\RepositoryService();
        $this->repository->setFileCreator($this->fileCreator);
        $this->repository->setStringService($this->string);
        $this->repository->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(true);

        $this->repository->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->getReferencedTableValidColumnName('Table')->willReturn('idMyController');
        $this->table->verifyTableAssociation($this->db->getTable(), 'upload_image')->willReturn(false);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);

        $this->repository->setTableService($this->table->reveal());

        $service = new \GearJson\Src\Src(['name' => 'TableRepository', 'type' => 'Repository'***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Repository')->willReturn($service);

        $this->repository->setCode($this->code);

        $this->repository->setSchemaService($schemaService->reveal());

        $this->repository->setTraitService($this->traitService->reveal());

        $srcDependency = $this->prophesize('Gear\Creator\SrcDependency');
        $this->repository->setSrcDependency($srcDependency->reveal());
        //$this->repository->setFactoryService

        $this->repositoryTest = $this->prophesize('Gear\Mvc\Repository\RepositoryTestService');

        $this->repository->setRepositoryTestService($this->repositoryTest->reveal());

        $mapping = new \Gear\Mvc\Repository\MappingService();
        $mapping->setStringService($this->string);
        $mapping->setColumnService($this->column->reveal());
        $mapping->setTableService($this->table->reveal());

        $this->table->getReferencedTableValidColumnName('foreign_key_column')->willReturn('idForeignKeyColumn');
        //$columns[9***REMOVED***->getConstraint()->getReferencedTableName()->willReturn('myTable');

        $this->table->getConstraintForeignKeyFromColumn($this->db->getTable(), $columns[9***REMOVED***->getColumn())->willReturn($columns[9***REMOVED***->getConstraint());

        $this->repository->setMappingService($mapping);

        $file = $this->repository->introspectFromTable($this->db);

        $expected = $this->templates.'/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }
}
