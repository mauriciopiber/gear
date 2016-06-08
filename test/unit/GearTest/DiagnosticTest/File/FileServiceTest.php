<?php
namespace GearTest\DiagnosticTest\FileTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use Gear\Diagnostic\File\FileService;

/**
 * @group Diagnostic
 * @group FileService
 */
class FileServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/build.xml');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
    }


    /**
     * @group ProjectDiagnostic
     */
    public function testProjectTrait()
    {
        $file = new FileService();
        $file->setProject('testing');
        $this->assertEquals('testing', $file->getProject());
    }


    public function testThrowMissingFiles()
    {
        $file = new FileService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\FileEdge');
        $edge->getFileModule('web')->willReturn([
            'target' => ['piber' => null***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\FileEdge\Exception\MissingFiles');

        $file->setFileEdge($edge->reveal());

        $file->diagnosticModule('web');
    }

    public function testDiagnosticModule()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        file_put_contents(vfsStream::url('module/need-one'), '...');
        file_put_contents(vfsStream::url('module/need-three.yml'), '...');

        $file = new FileService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\FileEdge');
        $edge->getFileModule('web')->willReturn([
            'files' => [
                'need-one',
                'need-two.xml',
                'need-three.yml',
                'need-four.php'
            ***REMOVED***,

        ***REMOVED***)->shouldBeCalled();

        $file->setFileEdge($edge->reveal());

        $errors = $file->diagnosticModule('web');

        $this->assertEquals([
            sprintf(FileService::$missingFile, 'need-two.xml'),
            sprintf(FileService::$missingFile, 'need-four.php')
        ***REMOVED***, $errors);
    }
}
