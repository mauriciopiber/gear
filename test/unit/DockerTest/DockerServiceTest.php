<?php
namespace GearTest\DockerTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\File\FileService;
use Gear\Module;
use Gear\Creator\Template\TemplateService;
use Gear\Util\String\StringService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Docker\DockerService;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use GearTest\UtilTestTrait;

/**
 * @group Service
 */
class DockerServiceTest extends TestCase
{
    use UtilTestTrait;
    public function setUp() : void
    {
        parent::setUp();

        $this->stringService = $this->prophesize(StringService::class);
        //$this->fileCreator = $this->prophesize(FileCreator::class);
        $this->module = $this->prophesize(ModuleStructure::class);


        $template       = new TemplateService(
            $this->mockPhpRenderer((new Module)->getLocation().'/../view')
        );

        $fileService    = new FileService();
        $this->fileCreator    = new FileCreator($fileService, $template);

        $this->service = new DockerService(
            $this->stringService->reveal(),
            $this->fileCreator,
            $this->module->reveal()
        );

        $this->templates =  (new Module())->getLocation().'/../test/template/module/docker';

        vfsStream::setup('module');
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Docker\DockerService', $this->service);
    }

    public function testCreaterDockerCompose()
    {
      $this->module->getType()->willReturn('api')->shouldBeCalled();
      $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

      $expected = file_get_contents($this->templates.'/docker-compose-api.yml');
      $this->service->createDockerComposeFile();
      $actual = file_get_contents(vfsStream::url('module/docker-compose.yml'));

      $this->assertEquals(trim($expected), trim($actual));
    }
}
