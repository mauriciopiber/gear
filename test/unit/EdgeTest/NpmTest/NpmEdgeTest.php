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

    public function testGetModuleWebLocation()
    {
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer = new \Gear\Edge\Npm\NpmEdge($yaml);
        $composer->setYamlService($yaml);
        $web = $composer->getNpmModule('web');
        $this->assertArrayHasKey('devDependencies', $web);
    }

    public function testSet()
    {
        $mockNpmEdge = $this->prophesize(
            'Gear\Edge\Npm\NpmEdge'
        );
        $this->setNpmEdge($mockNpmEdge->reveal());
        $this->assertEquals($mockNpmEdge->reveal(), $this->getNpmEdge());
    }
}
