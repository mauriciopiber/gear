<?php
namespace GearTest\MvcTest\RepositoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\ScopeTrait;

/**
 * @group RefactoringSrc1
 * @group Repository9
 */
class RepositoryTestServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use ScopeTrait;


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
        $this->codeTest->setDirService(new \GearBase\Util\Dir\DirService());

        $this->factoryTestService = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
        $this->traitTestService = $this->prophesize('Gear\Mvc\TraitTestService');

        $this->arrayService = new \Gear\Util\Vector\ArrayService();
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);
    }


    public function src()
    {
        return $this->getScope('Repository');
    }

    /**
     * @group src-mvc
     * @group src-mvc-repository-test
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->repository = new \Gear\Mvc\Repository\RepositoryTestService();


        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {
            $this->module->getTestUnitModuleFolder()->willReturn(vfsStream::url('module/test/unit/MyModuleTest'));
        } else {
            $this->module->map('RepositoryTest')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        if ($data->getService() == 'factories') {
            $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryTestService');
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
     * @group RepositoryMvc
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
