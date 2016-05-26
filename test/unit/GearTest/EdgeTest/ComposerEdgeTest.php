<?php
namespace GearTest\EdgeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Edge\ComposerEdgeTrait;

/**
 * @group Edge
 */
class ComposerEdgeTest extends AbstractTestCase
{
    use ComposerEdgeTrait;

    /*
    public function testGetModuleWebLocation()
    {
        $composer = new \Gear\Edge\ComposerEdge();

        $yaml = new \Gear\Util\Yaml\YamlService();

        $composer->setYamlService($yaml);

        $web = $composer->getComposerModule('web');
        $this->assertStringEndsWith('data/edge-technologic/module/web', $web);
    }
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

    /*
    public function testGetProjectWebLocation()
    {
        $composer = new \Gear\Edge\ComposerEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $composer->setYamlService($yaml);
        $web = $composer->getComposerProject('web');
        $this->assertStringEndsWith('data/edge-technologic/project/web', $web);
    }


    public function testUnfoundProjectType()
    {
        $composer = new \Gear\Edge\ComposerEdge();
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $composer->getComposerProject(null);

    }
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
