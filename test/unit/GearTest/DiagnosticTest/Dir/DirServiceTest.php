<?php
namespace GearTest\DiagnosticTest\DirTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Diagnostic
 * @group DirService
 */
class DirServiceTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
    }

    public function xtestThrowMissingIgnores()
    {
        $file = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());
        $this->assertInstanceOf('Gear\Diagnostic\Dir\DirService', $file);
    }

    public function testThrowMissingIgnores()
    {
        $dir = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirModule('web')->willReturn([
            'writable' => ['dir-one', 'dir-two'***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\Dir\Exception\MissingIgnore');

        $dir->setDirEdge($edge->reveal());

        $dir->diagnosticModule('web');
    }

    public function testThrowMissingWritable()
    {
        $file = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirModule('web')->willReturn([
            'ignores' => ['dir-one', 'dir-two'***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\Dir\Exception\MissingWritable');

        $file->setDirEdge($edge->reveal());

        $file->diagnosticModule('web');
    }
    /*


    public function testDiagnosticModule()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'))->shouldBeCalled();

        file_put_contents(vfsStream::url('module/need-one'), '...');
        file_put_contents(vfsStream::url('module/need-three.yml'), '...');

        $file = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirModule('web')->willReturn([
            'files' => [
                'need-one',
                'need-two.xml',
                'need-three.yml',
                'need-four.php'
            ***REMOVED***,

        ***REMOVED***)->shouldBeCalled();

        $file->setDirEdge($edge->reveal());

        $errors = $file->diagnosticModule('web');

        $this->assertEquals([
            sprintf(\Gear\Diagnostic\Dir\DirService::$missingDir, 'need-two.xml'),
            sprintf(\Gear\Diagnostic\Dir\DirService::$missingDir, 'need-four.php')
        ***REMOVED***, $errors);
    }
    */
}
