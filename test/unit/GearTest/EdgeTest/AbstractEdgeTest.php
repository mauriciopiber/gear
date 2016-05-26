<?php
namespace GearTest\EdgeTest;

use GearBaseTest\AbstractTestCase;

class AbstractEdgeTest extends AbstractTestCase
{
  public function testGetModuleWebLocation()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\ComposerEdge');
        $web = $composer->getModuleLocation('web');
        $this->assertStringEndsWith('data/edge-technologic/module/web', $web);
    }

    public function testGetModuleCliLocation()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\ComposerEdge');
        $web = $composer->getModuleLocation('cli');
        $this->assertStringEndsWith('data/edge-technologic/module/cli', $web);
    }

    public function testGetProjectWebLocation()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\ComposerEdge');
        $web = $composer->getProjectLocation('web');
        $this->assertStringEndsWith('data/edge-technologic/project/web', $web);
    }


    public function testUnfoundProjectType()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\ComposerEdge');
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $composer->getProjectLocation(null);

    }

    public function testUnfoundModuleType()
    {
        $composer = $this->getMockForAbstractClass('Gear\Edge\ComposerEdge');
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $composer->getModuleLocation(null);

    }

}
