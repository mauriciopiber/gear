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


    public function setUp()
    {
        parent::setUp();

        $this->ant = new \Gear\Edge\Ant\AntEdge();

    }
    /**
     * @covers Gear\Edge\AntEdge\AntEdge::getAntModule
     */
    public function testGetModuleWebLocation()
    {

        $yaml = new \Gear\Util\Yaml\YamlService();
        $this->ant->setYamlService($yaml);
        $web = $this->ant->getAntModule('web');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    /**
     * @covers Gear\Edge\AntEdge\AntEdge::getAntModule
     */
    public function testGetModuleCliLocation()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $this->ant->setYamlService($yaml);
        $web = $this->ant->getAntModule('cli');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }


    /**
     * @covers Gear\Edge\AntEdge\AntEdge::getAntModule
     */
    public function testUnfoundModuleType()
    {
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
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
