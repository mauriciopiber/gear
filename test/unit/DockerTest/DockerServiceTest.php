<?php
namespace GearTest\DockerTest;

use PHPUnit\Framework\TestCase;
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
    public function setUp()
    {
        parent::setUp();

        $this->stringService = $this->prophesize('Gear\Util\String\StringService');
        //$this->fileCreator = $this->prophesize('Gear\Creator\FileCreator\FileCreator');
        $this->module = $this->prophesize('Gear\Module\Structure\ModuleStructure');


        $template       = new \Gear\Creator\Template\TemplateService(
            $this->mockPhpRenderer((new \Gear\Module)->getLocation().'/../view')
        );

        $fileService    = new \Gear\Util\File\FileService();
        $this->fileCreator    = new \Gear\Creator\FileCreator\FileCreator($fileService, $template);

        $this->service = new DockerService(
            $this->stringService->reveal(),
            $this->fileCreator,
            $this->module->reveal()
        );

        $this->templates =  (new \Gear\Module())->getLocation().'/../test/template/module/docker';

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
