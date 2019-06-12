<?php
namespace GearTest\EdgeTest;

use PHPUnit\Framework\TestCase;

/**
 * @group Edge
 */
class AbstractEdgeTest extends TestCase
{
    public function testGetModuleWebLocation()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\Composer\ComposerEdge');
        $web = $composer->getModuleLocation('web');
        $this->assertStringEndsWith('data/edge-technologic/module/web', $web);
    }

    public function testGetModuleCliLocation()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\Composer\ComposerEdge');
        $web = $composer->getModuleLocation('cli');
        $this->assertStringEndsWith('data/edge-technologic/module/cli', $web);
    }

    public function testUnfoundModuleType()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\Composer\ComposerEdge');
        $this->expectException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $composer->getModuleLocation(null);

    }

}
