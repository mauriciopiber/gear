<?php
namespace GearTest\MvcTest\FactoryTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\MvcTest\FactoryTest\FactoryDataTrait;
use GearJson\Src\Src;

/**
 * @group db-factory
 */
class FactoryTestServiceTest extends AbstractTestCase
{
    use FactoryDataTrait;

    public function setUp()
    {
        parent::setUp();

        $this->root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->module->getModuleName()->willReturn('MyModule');

        $this->baseDir = (new \Gear\Module)->getLocation();

        $phpRenderer = $this->mockPhpRenderer($this->baseDir.'/../../view');

        $this->template = $this->baseDir.'/../../test/template/module/mvc/factory-test';

        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($phpRenderer);

        $fileService    = new \GearBase\Util\File\FileService();
        $stringService  = new \GearBase\Util\String\StringService();
        $fileCreator    = new \Gear\Creator\File($fileService, $template);

        $codeTest = new \Gear\Creator\CodeTest();
        $codeTest->setModule($this->module->reveal());
        $codeTest->setDirService(new \GearBase\Util\Dir\DirService());

        $this->factoryTest = new \Gear\Mvc\Factory\FactoryTestService();
        $this->factoryTest->setStringService($stringService);
        $this->factoryTest->setFileCreator($fileCreator);
        $this->factoryTest->setModule($this->module->reveal());
        $this->factoryTest->setCodeTest($codeTest);

        $this->serviceManager = new \Gear\Mvc\Config\ServiceManager();
        $this->serviceManager->setModule($this->module->reveal());
        $this->factoryTest->setServiceManager($this->serviceManager);

        $this->schema = $this->prophesize('GearJson\Schema\SchemaService');
        $this->factoryTest->setSchemaService($this->schema->reveal());
    }

    public function getData()
    {
        return $this->getFactoryData();
    }

    /**
     * @dataProvider getData
     * @group db-factory-namespace
     */
    public function testCreateFactoryForDb($data, $template)
    {
        if ($data instanceof Src && $data->getTemplate() == 'form-filter') {

            $this->filter = $this->prophesize('GearJson\Src\Src');
            $this->filter->getName()->willReturn('MyTableFilter');
            $this->filter->getType()->willReturn('Filter');
            $this->filter->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Filter')->willReturn($this->filter->reveal());

            $this->form = $this->prophesize('GearJson\Src\Src');
            $this->form->getName()->willReturn('MyTableForm');
            $this->form->getType()->willReturn('Form');
            $this->form->getNamespace()->willReturn($data->getNamespace());


            $this->schema->getSrcByDb($data->getDb(), 'Form')->willReturn($this->form->reveal());

            /**
            $this->entity = $this->prophesize('GearJson\Src\Src');
            $this->entity->getName()->willReturn('MyTable');
            $this->entity->getType()->willReturn('Entity');
            $this->entity->getNamespace()->willReturn(null);
            $this->schema->getSrcByDb($data->getDb(), 'Entity')->willReturn($this->entity);
            */
        }

        $file = $this->factoryTest->createFactoryTest($data, vfsStream::url('module'));

        $this->assertEquals(
            file_get_contents($this->template.'/db/'.$template.'.phtml'),
            file_get_contents($file)
        );
    }

    public function testDependency()
    {
        $this->assertInstanceOf('Gear\Module\BasicModuleStructure', $this->factoryTest->getModule());
        $this->assertInstanceOf('Gear\Creator\File', $this->factoryTest->getFileCreator());
        $this->assertInstanceOf('Gear\Creator\CodeTest', $this->factoryTest->getCodeTest());
    }
}
