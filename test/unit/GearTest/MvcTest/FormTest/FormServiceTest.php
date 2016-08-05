<?php
namespace GearTest\MvcTest\FormTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use GearTest\AllColumnsDbTableTrait;
use GearTest\AllColumnsDbNotNullTableTrait;
use GearTest\AllColumnsDbUniqueTableTrait;
use GearTest\AllColumnsDbUniqueNotNullTableTrait;
use GearTest\SingleDbTableTrait;
use GearTest\ScopeTrait;

class FormServiceTest extends AbstractTestCase
{
    use AllColumnsDbTableTrait;
    use AllColumnsDbNotNullTableTrait;
    use AllColumnsDbUniqueTableTrait;
    use AllColumnsDbUniqueNotNullTableTrait;
    use SingleDbTableTrait;
    use ScopeTrait;

    public function setUp()
    {
        parent::setUp();
        vfsStream::setup('module');

        //module
        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');

        //string
        $this->string = new \GearBase\Util\String\StringService();

        //file-render
        $template       = new \Gear\Creator\TemplateService();
        $template->setRenderer($this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../../view'));
        $fileService    = new \GearBase\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\File($fileService, $template);

        //template
        $this->templates =  (new \Gear\Module())->getLocation().'/../../test/template/module/mvc/form';

        //src-dependency
        $this->srcDependency = new \Gear\Creator\SrcDependency();
        $this->srcDependency->setModule($this->module->reveal());
        $this->srcDependency->setStringService($this->string);

        //code
        $this->code = new \Gear\Creator\Code();
        $this->code->setModule($this->module->reveal());
        $this->code->setStringService($this->string);
        $this->code->setSrcDependency($this->srcDependency);
        $this->code->setDirService(new \GearBase\Util\Dir\DirService());

        //array
        $this->arrayService = new \Gear\Util\Vector\ArrayService();

        //injector
        $this->injector = new \Gear\Creator\File\Injector($this->arrayService);

        $this->form = new \Gear\Mvc\Form\FormService();

        $this->form->setFileCreator($this->fileCreator);
        $this->form->setStringService($this->string);
        $this->form->setModule($this->module->reveal());
        $this->form->setCode($this->code);

        $this->form->setSrcDependency($this->srcDependency);

        //form-test
        $this->formTest = $this->prophesize('Gear\Mvc\Form\FormTestService');
        $this->form->setFormTestService($this->formTest->reveal());

        //trait
        $this->traitService = $this->prophesize('Gear\Mvc\TraitService');
        $this->form->setTraitService($this->traitService->reveal());

        //factory
        $this->factory = $this->prophesize('Gear\Mvc\Factory\FactoryService');
        $this->form->setFactoryService($this->factory->reveal());

        //interface
        $this->interface = $this->prophesize('Gear\Mvc\InterfaceService');
        $this->form->setInterfaceService($this->interface->reveal());
    }


    public function src()
    {
        $srcType = 'Form';

        return $this->getScopeForm($srcType);
    }


    /**
     * @group src-mvc
     * @group src-mvc-form
     * @dataProvider src
     */
    public function testCreateSrc($data, $template)
    {
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();

        if (!empty($data->getNamespace())) {

            $this->module->getSrcModuleFolder()->willReturn(vfsStream::url('module/src/MyModule'));

        } else {
            $this->module->map('Form')->willReturn(vfsStream::url('module'))->shouldBeCalled();
        }

        if ($data->getService() == 'factories' && $data->getAbstract() == false) {

            if (!empty($data->getNamespace())) {
               $this->factory->createFactory(
                   $data,
                   vfsStream::url('module/src/MyModule').'/'.str_replace('\\', '/', $data->getNamespace())
               )->shouldBeCalled();
            } else {
                $this->factory->createFactory($data, vfsStream::url('module'))->shouldBeCalled();
            }
        }

        $file = $this->form->create($data);

        $expected = $this->templates.'/src/'.$template.'.phtml';

        $this->assertEquals(
            file_get_contents($expected),
            file_get_contents($file)
        );

    }
}
