<?php
namespace GearTest\DiagnosticTest\FileTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\String\StringService;
use Gear\Module\Structure\ModuleStructure;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\File\FileService;
use Gear\Edge\File\FileEdge;
use Gear\Config\GearConfig;

/**
 * @group Diagnostic
 * @group FileService
 * @group FileDiagnostic
 * @group EdgeFile
 */
class FileServiceTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/build.xml');

        $this->module = $this->prophesize(ModuleStructure::class);
        $this->stringService = $this->prophesize(StringService::class);
        $this->fileEdge = $this->prophesize(FileEdge::class);
        $this->gearConfig = $this->prophesize(GearConfig::class);

        $this->fileService = new FileService(
            $this->module->reveal(),
            $this->gearConfig->reveal(),
            $this->fileEdge->reveal()
        );
    }

    public function testThrowMissingFiles()
    {
        $this->fileEdge->getFileModule('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->expectException('Gear\Edge\File\Exception\MissingFiles');

        $this->fileService->setFileEdge($this->fileEdge->reveal());

        $this->fileService->diagnosticModule('web');
    }

    public function testDiagnosticModule()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        file_put_contents(vfsStream::url('module/need-one'), '...');
        file_put_contents(vfsStream::url('module/need-three.yml'), '...');

        $this->fileEdge->getFileModule('web')->willReturn([
            'files' => [
                'need-one',
                'need-two.xml',
                'need-three.yml',
                'need-four.php'
            ***REMOVED***,

        ***REMOVED***)->shouldBeCalled();

        $errors = $this->fileService->diagnosticModule('web');

        $this->assertEquals([
            sprintf(FileService::$missingFile, 'need-two.xml'),
            sprintf(FileService::$missingFile, 'need-four.php')
        ***REMOVED***, $errors);
    }
}
