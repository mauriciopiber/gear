<?php
namespace GearTest\EdgeTest\DirTest\DirEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Dir\DirEdgeTrait;

/**
 * @group Edge
 */
class DirEdgeTest extends TestCase
{
    use DirEdgeTrait;

    public function testGetModuleWebLocation()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir = new \Gear\Edge\Dir\DirEdge($yaml);
        $web = $dir->getDirModule('web');
        $this->assertArrayHasKey('writable', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    public function testGetModuleCliLocation()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir = new \Gear\Edge\Dir\DirEdge($yaml);
        $web = $dir->getDirModule('cli');
        $this->assertArrayHasKey('ignore', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    public function testUnfoundModuleType()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir = new \Gear\Edge\Dir\DirEdge($yaml);
        $this->expectException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $dir->getDirModule(null);

    }

    public function testSet()
    {
        $mockDirEdge = $this->prophesize(
            'Gear\Edge\Dir\DirEdge'
        );
        $this->setDirEdge($mockDirEdge->reveal());
        $this->assertEquals($mockDirEdge->reveal(), $this->getDirEdge());
    }
}
