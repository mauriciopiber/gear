<?php
namespace GearTest\EdgeTest\ComposerTest\ComposerEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Composer\ComposerEdgeTrait;

/**
 * @group Edge
 */
class ComposerEdgeTest extends TestCase
{
    use ComposerEdgeTrait;

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerModule
     */
    public function testGetModuleWebLocation()
    {
        $composer = new \Gear\Edge\Composer\ComposerEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getComposerModule('web');
        $this->assertArrayHasKey('require', $web);
        $this->assertArrayHasKey('require-dev', $web);
    }

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerModule
     */
    public function testGetModuleCliLocation()
    {
        $composer = new \Gear\Edge\Composer\ComposerEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getComposerModule('cli');
        $this->assertArrayHasKey('require', $web);
        $this->assertArrayHasKey('require-dev', $web);
    }

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerModule
     */
    public function testUnfoundModuleType()
    {
        $composer = new \Gear\Edge\Composer\ComposerEdge();
        $this->expectException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $composer->getComposerModule(null);

    }

    /**
     * @group Gear
     * @group ComposerEdge
    */
    public function testSet()
    {
        $mockComposerEdge = $this->prophesize(
            'Gear\Edge\Composer\ComposerEdge'
        );
        $this->setComposerEdge($mockComposerEdge->reveal());
        $this->assertEquals($mockComposerEdge->reveal(), $this->getComposerEdge());
    }
}
