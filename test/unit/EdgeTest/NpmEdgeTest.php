<?php
namespace GearTest\EdgeTest\NpmEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\NpmEdgeTrait;

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
        $composer = new \Gear\Edge\NpmEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getNpmModule('web');
        $this->assertArrayHasKey('devDependencies', $web);
    }

    /**
     * @covers Gear\Edge\NpmEdge::getNpmProject
     */
    public function testGetProjectWebLocation()
    {
        $composer = new \Gear\Edge\NpmEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getNpmProject('web');
        $this->assertArrayHasKey('devDependencies', $web);
    }


    /**
     * @group Gear
     * @group NpmEdge
    */
    public function testSet()
    {
        $mockNpmEdge = $this->prophesize(
            'Gear\Edge\NpmEdge'
        );
        $this->setNpmEdge($mockNpmEdge->reveal());
        $this->assertEquals($mockNpmEdge->reveal(), $this->getNpmEdge());
    }
}
