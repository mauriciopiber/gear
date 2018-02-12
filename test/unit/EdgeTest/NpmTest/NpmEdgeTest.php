<?php
namespace GearTest\EdgeTest\NpmTest\NpmEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\Npm\NpmEdgeTrait;

/**
 * @group Edge
 * @group Service
 */
class NpmEdgeTest extends TestCase
{
    use NpmEdgeTrait;


    /**
     * @covers Gear\Edge\NpmEdge::getNpmModule
     */
    public function testGetModuleWebLocation()
    {
        $composer = new \Gear\Edge\Npm\NpmEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getNpmModule('web');
        $this->assertArrayHasKey('devDependencies', $web);
    }

    /**
     * @group Gear
     * @group NpmEdge
    */
    public function testSet()
    {
        $mockNpmEdge = $this->prophesize(
            'Gear\Edge\Npm\NpmEdge'
        );
        $this->setNpmEdge($mockNpmEdge->reveal());
        $this->assertEquals($mockNpmEdge->reveal(), $this->getNpmEdge());
    }
}
