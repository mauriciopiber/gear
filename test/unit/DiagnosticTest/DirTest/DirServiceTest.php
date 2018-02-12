<?php
namespace GearTest\DiagnosticTest\DirTest;

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use Gear\Diagnostic\Dir\DirService;
use Gear\Edge\Dir\DirEdge;

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
        $this->dirEdge = $this->prophesize(DirEdge::class);

        $this->dirService = new DirService(
            $this->module->reveal(),
            //$this->stringService->reveal(),
            $this->dirEdge->reveal()
        );
    }

    public function testThrowMissingIgnores()
    {
        $this->dirEdge->getDirModule('web')->willReturn([
            'writable' => ['dir-one', 'dir-two'***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\Dir\Exception\MissingIgnore');

        $this->dirService->setDirEdge($this->dirEdge->reveal());

        $this->dirService->diagnosticModule('web');
    }

    public function testThrowMissingWritable()
    {
        $this->dirEdge->getDirModule('web')->willReturn([
            'ignores' => ['dir-one', 'dir-two'***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $this->setExpectedException('Gear\Edge\Dir\Exception\MissingWritable');

        $this->dirService->diagnosticModule('web');
    }

    public function testNotCreated()
    {
        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $this->dirEdge->getDirModule('web')->willReturn([
            'writable' => [
                'not-writable',
            ***REMOVED***,
            'ignore' => [***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $errors = $this->dirService->diagnosticModule('web');

        $this->assertEquals([
            sprintf(DirService::$missingDir, 'not-writable'),
        ***REMOVED***, $errors);
    }

    public function testNoErrors()
    {
        vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        file_put_contents(vfsStream::url('module/not-writable/.gitignore'), '...');

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $this->dirEdge->getDirModule('web')->willReturn([
            'writable' => [
                'not-writable'
            ***REMOVED***,
            'ignore' => [
                'not-writable'
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $errors = $this->dirService->diagnosticModule('web');

        $this->assertEquals([***REMOVED***, $errors);
    }

    public function testMissingGitIgnore()
    {
        vfsStream::newDirectory('not-writable')->at(vfsStreamWrapper::getRoot());

        $this->module->getMainFolder()->willReturn(vfsStream::url('module'));

        $this->dirEdge->getDirModule('web')->willReturn([
            'writable' => [

            ***REMOVED***,
            'ignore' => [
                'not-writable'
            ***REMOVED***
        ***REMOVED***)->shouldBeCalled();

        $errors = $this->dirService->diagnosticModule('web');

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

        $this->dirEdge->getDirModule('web')->willReturn([
            'writable' => [
                'not-writable',
            ***REMOVED***,
            'ignore' => [***REMOVED***
        ***REMOVED***)->shouldBeCalled();


        $errors = $this->dirService->diagnosticModule('web');

        $this->assertEquals([
            sprintf(DirService::$missingWrite, 'not-writable'),
        ***REMOVED***, $errors);
    }

}
