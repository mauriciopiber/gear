<?php
namespace GearTest\EdgeTest\AntTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Ant\AntEdgeTrait;

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

        $this->yaml = new \Gear\Util\Yaml\YamlService();

        $this->ant = new \Gear\Edge\Ant\AntEdge(
            $this->yaml
        );

    }
    /**
     * @covers Gear\Edge\AntEdge\AntEdge::getAntModule
     */
    public function testGetModuleWebLocation()
    {
        $web = $this->ant->getAntModule('web');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    /**
     * @covers Gear\Edge\AntEdge\AntEdge::getAntModule
     */
    public function testGetModuleCliLocation()
    {
        $web = $this->ant->getAntModule('cli');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }


    /**
     * @covers Gear\Edge\AntEdge\AntEdge::getAntModule
     */
    public function testUnfoundModuleType()
    {
        $this->expectException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $this->ant->getAntModule(null);

    }


    /**
     * @group Gear
     * @group AntEdge
    */
    public function testSet()
    {
        $mockAntEdge = $this->prophesize(
            'Gear\Edge\Ant\AntEdge'
        );
        $this->setAntEdge($mockAntEdge->reveal());
        $this->assertEquals($mockAntEdge->reveal(), $this->getAntEdge());
    }
}
