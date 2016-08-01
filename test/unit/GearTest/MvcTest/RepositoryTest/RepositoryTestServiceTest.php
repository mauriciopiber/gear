<?php
namespace GearTest\MvcTest\RepositoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;

/**
 * @group RefactoringSrc1
 */
class RepositoryTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;


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


        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/repository-test';

        $this->codeTest = new \Gear\Creator\CodeTest;
        $this->codeTest->setStringService($this->string);
        $this->codeTest->setModule($this->module->reveal());

        $this->factoryTestService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->traitTestService = $this->prophesize('Gear\Mvc\TraitTestService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);
    }


    public function src()
    {
        $namespace = 'Basic';

        $srcType = 'Repository';
        return [
            /*
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
            */
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

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));

        } else {
            $this->module->map('RepositoryTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        $this->repository = new \Gear\Mvc\Repository\RepositoryTestService();

        if ($data->getService() == 'factories') {
            $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');

            if (!empty($data->getNamespace())) {
               $this->factory->createFactory(
                   $data,
                   vfsStream::url('module/src/MyModule').'/'.str_replace('\\', '/', $data->getNamespace())
               )->shouldBeCalled();
            } else {
                $this->factory->createFactory($data, vfsStream::url('module'))->shouldBeCalled();
            }


            $this->repository->setFactoryTestService($this->factory->reveal());
        }


        $this->repository->setFileCreator($this->fileCreator);
        $this->repository->setStringService($this->string);
        $this->repository->setModule($this->module->reveal());
        $this->repository->setCodeTest($this->codeTest);


        $serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $serviceManager->setModule($this->module->reveal());
        $serviceManager->setStringService($this->string);

        $this->repository->setServiceManager($serviceManager);

        $this->repository->setTraitTestService($this->traitTestService->reveal());

        $srcDependency = new \Gear\Creator\SrcDependency();
        $srcDependency->setModule($this->module->reveal());
        $this->repository->setSrcDependency($srcDependency);

        $file = $this->repository->createFromSrc($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );


        //$this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        //$this->module->getRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
    }

    public function tables()
    {
        /**
        $db = new Db(['table' => 'MyRepository'***REMOVED***);

        $action = new Action([
            'name' => 'MyAction',
            'repository' => new Repository(['name' => 'MyRepository', 'object' => '%s\Repository\MyRepository'***REMOVED***),
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
            [$this->getAllPossibleColumns(), '', true, 'table'***REMOVED***,
            //[$this->getAllPossibleColumnsNotNull(), '-not-null', false***REMOVED***,
            //[$this->getAllPossibleColumnsUnique(), '-unique', true***REMOVED***,
            //[$this->getAllPossibleColumnsUniqueNotNull(), '-unique-not-null', false***REMOVED***,
        ***REMOVED***;
    }

    /**
     * @dataProvider tables
     * @group RefactoringUnitTest
     */
    public function testInstrospectTable($columns, $template, $nullable, $tableName)
    {
        $table = $this->string->str('class', $tableName);

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->module->getTestRepositoryFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        $this->db = new \GearJson\Db\Db(['table' => sprintf('%s', $table)***REMOVED***);

        $this->repository = new \Gear\Mvc\Repository\RepositoryTestService();
        $this->repository->setFileCreator($this->fileCreator);
        $this->repository->setStringService($this->string);
        $this->repository->setModule($this->module->reveal());

        $this->column = $this->prophesize('Gear\Column\ColumnService');
        $this->column->getColumns($this->db)->willReturn($columns)->shouldBeCalled();

        $this->column->verifyColumnAssociation($this->db, 'Gear\Column\Varchar\UploadImage')->willReturn(false);
        $this->column->renderColumnPart('staticTest')->willReturn('');
        $this->column->renderColumnPart('insertArray', true)->willReturn('');
        //$this->column->renderColumnPart('insertArray', false, true)->willReturn('');
        $this->column->renderColumnPart('insertAssert', true)->willReturn('');
        $this->column->renderColumnPart('insertAssert', true, true)->willReturn('');
        $this->column->renderColumnPart('insertSelect', true)->willReturn('');
        $this->column->renderColumnPart('updateArray', true)->willReturn('');
        $this->column->renderColumnPart('updateAssert', true, true)->willReturn('');

        $this->repository->setColumnService($this->column->reveal());

        $this->table = $this->prophesize('Gear\Table\TableService\TableService');
        $this->table->verifyTableAssociation($this->db->getTable())->willReturn(false);
        $this->table->isNullable($this->db->getTable())->willReturn($nullable);
        $this->table->getPrimaryKeyColumnName($this->db->getTable())->willReturn('idMyController')->shouldBeCalled();

        $this->repository->setTableService($this->table->reveal());

        $repository = new \GearJson\Src\Src(['name' => sprintf('%sRepository', $table), 'type' => 'Repository'***REMOVED***);

        $schemaService = $this->prophesize('GearJson\Schema\SchemaService');
        $schemaService->getSrcByDb($this->db, 'Repository')->willReturn($repository);

        $this->repository->setSchemaService($schemaService->reveal());

        $this->repository->setTraitTestService($this->traitTestService->reveal());
        //$this->repository->setFactoryService

        $file = $this->repository->introspectFromTable($this->db);

        $expected = $this->templates.'/all-columns-db'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );
    }



}
