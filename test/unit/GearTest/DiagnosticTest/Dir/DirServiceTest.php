<?php
namespace GearTest\DiagnosticTest\DirTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

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

    public function testNotCreated()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $dir = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirModule('web')->willReturn([
            'writable' => [
                'not-writable',
            ***REMOVED***,
            'ignore' => [***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $dir->setDirEdge($edge->reveal());

        $errors = $dir->diagnosticModule('web');

        $this->assertEquals([
            sprintf(\Gear\Diagnostic\Dir\DirService::$missingDir, 'not-writable'),
        ***REMOVED***, $errors);
    }

    public function testNoErrors()
    {
        vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        file_put_contents(vfsStream::url('module/not-writable/.gitignore'), '...');

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $dir = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirModule('web')->willReturn([
            'writable' => [
                'not-writable'
            ***REMOVED***,
            'ignore' => [
                'not-writable'
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $dir->setDirEdge($edge->reveal());

        $errors = $dir->diagnosticModule('web');

        $this->assertEquals([***REMOVED***, $errors);
    }

    public function testMissingGitIgnore()
    {
        vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $dir = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirModule('web')->willReturn([
            'writable' => [

            ***REMOVED***,
            'ignore' => [
                'not-writable'
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $dir->setDirEdge($edge->reveal());

        $errors = $dir->diagnosticModule('web');

        $this->assertEquals([
            sprintf(\Gear\Diagnostic\Dir\DirService::$missingIgnore, 'not-writable'),
        ***REMOVED***, $errors);
    }

    /**
     * @group dir1
     */
    public function testCreatedNotWritable()
    {
        vfsStream::newDirectory('not-writable', 000)->at(vfsStreamWrapper::getRoot());

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $dir = new \Gear\Diagnostic\Dir\DirService($this->module->reveal(), $this->stringService->reveal());

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirModule('web')->willReturn([
            'writable' => [
                'not-writable',
            ***REMOVED***,
            'ignore' => [***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $dir->setDirEdge($edge->reveal());

        $errors = $dir->diagnosticModule('web');

        $this->assertEquals([
            sprintf(\Gear\Diagnostic\Dir\DirService::$missingWrite, 'not-writable'),
        ***REMOVED***, $errors);
    }

}
