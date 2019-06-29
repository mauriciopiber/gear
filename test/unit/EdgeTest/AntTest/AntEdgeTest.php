<?php
namespace GearTest\EdgeTest\AntTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Yaml\YamlService;
use Gear\Edge\Ant\AntEdgeTrait;
use Gear\Edge\Ant\AntEdge;

/**
 * @group Edge
 * @group AntEdge
 */
class AntEdgeTest extends TestCase
{
    use AntEdgeTrait;


    public function setUp() : void
    {
        parent::setUp();

        $this->yaml = new YamlService();

        $this->ant = new AntEdge(
            $this->yaml
        );

    }

    public function testGetModuleWebLocation()
    {
        $web = $this->ant->getAntModule('web');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    public function testGetModuleCliLocation()
    {
        $web = $this->ant->getAntModule('cli');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    public function testUnfoundModuleType()
    {
        $this->expectException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $this->ant->getAntModule(null);

    }

    public function testSet()
    {
        $mockAntEdge = $this->prophesize(
            'Gear\Edge\Ant\AntEdge'
        );
        $this->setAntEdge($mockAntEdge->reveal());
        $this->assertEquals($mockAntEdge->reveal(), $this->getAntEdge());
    }
}
