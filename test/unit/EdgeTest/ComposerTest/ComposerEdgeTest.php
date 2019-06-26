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

    public function testGetModuleWebLocation()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer = new \Gear\Edge\Composer\ComposerEdge($yaml);
        $web = $composer->getComposerModule('web');
        $this->assertArrayHasKey('require', $web);
        $this->assertArrayHasKey('require-dev', $web);
    }

    public function testGetModuleCliLocation()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer = new \Gear\Edge\Composer\ComposerEdge($yaml);
        $web = $composer->getComposerModule('cli');
        $this->assertArrayHasKey('require', $web);
        $this->assertArrayHasKey('require-dev', $web);
    }

    public function testUnfoundModuleType()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer = new \Gear\Edge\Composer\ComposerEdge($yaml);
        $this->expectException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $composer->getComposerModule(null);

    }

    public function testSet()
    {
        $mockComposerEdge = $this->prophesize(
            'Gear\Edge\Composer\ComposerEdge'
        );
        $this->setComposerEdge($mockComposerEdge->reveal());
        $this->assertEquals($mockComposerEdge->reveal(), $this->getComposerEdge());
    }
}
