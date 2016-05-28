<?php
namespace GearTest\DiagnosticTest;

use GearBaseTest\AbstractTestCase;
use org\bovigo\vfs\vfsStream;

/**
 * @group Diagnostic
 */
class AntServiceTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();

        $root = vfsStream::setup('module');
        $this->file = vfsStream::url('module/build.xml');

    }

    /*
    public function testDiagnosticWebModule()
    {

        $fileConfig = <<<EOS


EOS;
        file_put_contents($this->file, $fileConfig);

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getMainFolder()->willReturn(vfsStream::url('module'));

        $stringService = $this->prophesize('GearBase\Util\String\StringService');

        $composer = new \Gear\Diagnostic\AntService($module->reveal(), $stringService->reveal());


        $yaml = $this->prophesize('Gear\Edge\AntEdge');
        $yaml->getAntModule('web')->willReturn([***REMOVED***);

        $composer->setAntEdge($yaml->reveal());

        $this->assertEquals([***REMOVED***, $composer->diagnosticModule('web'));
    }
    */
}
