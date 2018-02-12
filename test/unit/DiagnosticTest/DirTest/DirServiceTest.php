<?php
namespace GearTest\DiagnosticTest\DirTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Gear\Diagnostic\Dir\DirService;

/**
 * @group Diagnostic
 * @group DirService
 * @group DirDiagnostic
 */
class DirServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');

        $this->module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $this->stringService = $this->prophesize('GearBase\Util\String\StringService');
    }

    /**
     * @group ProjectDiagnostic
     */
    public function testProjectTrait()
    {
        $dir = new DirService();
        $dir->setProject('testing');
        $this->assertEquals('testing', $dir->getProject());
    }

    public function xtestThrowMissingIgnores()
    {
        $file = new DirService($this->module->reveal(), $this->stringService->reveal());
        $this->assertInstanceOf('Gear\Diagnostic\Dir\DirService', $file);
    }

    public function testThrowMissingIgnores()
    {
        $dir = new DirService($this->module->reveal(), $this->stringService->reveal());

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
        $file = new DirService($this->module->reveal(), $this->stringService->reveal());

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

        $dir = new DirService($this->module->reveal(), $this->stringService->reveal());

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
            sprintf(DirService::$missingDir, 'not-writable'),
        ***REMOVED***, $errors);
    }

    public function testNoErrors()
    {
        vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        file_put_contents(vfsStream::url('module/not-writable/.gitignore'), '...');

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $dir = new DirService($this->module->reveal(), $this->stringService->reveal());

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

        $dir = new DirService($this->module->reveal(), $this->stringService->reveal());

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
            sprintf(DirService::$missingIgnore, 'not-writable'),
        ***REMOVED***, $errors);
    }

    /**
     * @group dir1
     */
    public function testCreatedNotWritable()
    {
        vfsStream::newDirectory('not-writable', 000)->at(vfsStreamWrapper::getRoot());

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $dir = new DirService($this->module->reveal(), $this->stringService->reveal());

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
            sprintf(DirService::$missingWrite, 'not-writable'),
        ***REMOVED***, $errors);
    }

    /**
     * @group ProjectDiagnostic
     */
    public function testDiagnosticProject()
    {
        vfsStream::setup('project');

        vfsStream::newDirectory('exist-1')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('exist-2')->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('not-writable', 000)->at(vfsStreamWrapper::getRoot());
        vfsStream::newDirectory('ignore')->at(vfsStreamWrapper::getRoot());

        file_put_contents(vfsStream::url('project/ignore/.gitignore'), '*');

        $dir = new DirService();
        $dir->setProject(vfsStream::url('project'));

        $edge = $this->prophesize('Gear\Edge\DirEdge');
        $edge->getDirProject('web')->willReturn([
            'writable' => [
                'exist-1',
                'exist-2',
                'not-exist-1',
                'not-exist-2',
                'not-writable',
            ***REMOVED***,
            'ignore' => [
                'not-ignore',
                'ignore'
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $dir->setDirEdge($edge->reveal());

        $errors = $dir->diagnosticProject('web');

        $this->assertEquals([
            sprintf(DirService::$missingDir, 'not-exist-1'),
            sprintf(DirService::$missingDir, 'not-exist-2'),
            sprintf(DirService::$missingWrite, 'not-writable'),
            sprintf(DirService::$missingIgnore, 'not-ignore'),
        ***REMOVED***, $errors);
    }

}
