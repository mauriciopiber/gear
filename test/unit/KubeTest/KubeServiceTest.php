<?php
namespace GearTest\KubeTest;

use PHPUnit\Framework\TestCase;
use Gear\Kube\KubeService;
use GearTest\UtilTestTrait;
use Gear\Module;
use org\bovigo\vfs\vfsStream;

/**
 * @group Service
 */
class KubeServiceTest extends TestCase
{
    use UtilTestTrait;

    public function setUp() : void
    {
        parent::setUp();

        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');
        $this->fileCreator = $this->createFileCreator();
        $this->stringService = $this->createString();
        $this->code = $this->createCode();

        $this->service = new KubeService(
            $this->module->reveal(),
            $this->fileCreator,
            $this->stringService,
            $this->code
        );


        $this->templates =  (new Module())->getLocation().'/../test/template/module/kube';

        vfsStream::setup('module');
    }

    public function testCreateKubeConfigApi()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();
        $this->module->getType()->willReturn('api')->shouldBeCalled();
        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $file = $this->service->createKube();

        $expect = file_get_contents($this->templates.'/kube-api.yaml');

        $this->assertEquals(trim($expect), file_get_contents($file));
    }
}
