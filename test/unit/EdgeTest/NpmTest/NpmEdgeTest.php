<?php
namespace GearTest\EdgeTest\NpmTest\NpmEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Yaml\YamlService;
use Gear\Edge\Npm\NpmEdge;
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
        $yaml = new YamlService();
        $composer = new NpmEdge($yaml);
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
