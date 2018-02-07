<?php
namespace GearTest\EdgeTest\ComposerEdgeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Edge\ComposerEdgeTrait;

/**
 * @group Edge
 */
class ComposerEdgeTest extends AbstractTestCase
{
    use ComposerEdgeTrait;

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerModule
     */
    public function testGetModuleWebLocation()
    {
        $composer = new \Gear\Edge\ComposerEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getComposerModule('web');
        $this->assertArrayHasKey('require', $web);
        $this->assertArrayHasKey('require-dev', $web);
    }

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerProject
     */
    public function testGetProjectWebLocation()
    {
        $composer = new \Gear\Edge\ComposerEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getComposerProject('web');
        $this->assertArrayHasKey('require', $web);
        $this->assertArrayHasKey('require-dev', $web);
    }

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerModule
     */
    public function testGetModuleCliLocation()
    {
        $composer = new \Gear\Edge\ComposerEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getComposerModule('cli');
        $this->assertArrayHasKey('require', $web);
        $this->assertArrayHasKey('require-dev', $web);
    }

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerProject
     */
    public function testUnfoundProjectType()
    {
        $composer = new \Gear\Edge\ComposerEdge();
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $composer->getComposerProject(null);

    }

    /**
     * @covers Gear\Edge\ComposerEdge::getComposerModule
     */
    public function testUnfoundModuleType()
    {
        $composer = new \Gear\Edge\ComposerEdge();
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $composer->getComposerModule(null);

    }

    /**
     * @group Gear
     * @group ComposerEdge
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getComposerEdge()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group ComposerEdge
    */
    public function testGet()
    {
        $composerEdge = $this->getComposerEdge();
        $this->assertInstanceOf('Gear\Edge\ComposerEdge', $composerEdge);
    }

    /**
     * @group Gear
     * @group ComposerEdge
    */
    public function testSet()
    {
        $mockComposerEdge = $this->getMockSingleClass(
            'Gear\Edge\ComposerEdge'
        );
        $this->setComposerEdge($mockComposerEdge);
        $this->assertEquals($mockComposerEdge, $this->getComposerEdge());
    }
}
