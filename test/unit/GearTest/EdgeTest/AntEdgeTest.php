<?php
namespace GearTest\EdgeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Edge\AntEdgeTrait;

/**
 * @group Edge
 */
class AntEdgeTest extends AbstractTestCase
{
    use AntEdgeTrait;
    /**
     * @covers Gear\Edge\AntEdge::getAntModule
     */
    public function testGetModuleWebLocation()
    {
        $ant = new \Gear\Edge\AntEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $ant->setYamlService($yaml);
        $web = $ant->getAntModule('web');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    /**
     * @covers Gear\Edge\AntEdge::getAntProject
     */
    public function testGetProjectWebLocation()
    {
        $ant = new \Gear\Edge\AntEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $ant->setYamlService($yaml);
        $web = $ant->getAntProject('web');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    /**
     * @covers Gear\Edge\AntEdge::getAntModule
     */
    public function testGetModuleCliLocation()
    {
        $ant = new \Gear\Edge\AntEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $ant->setYamlService($yaml);
        $web = $ant->getAntModule('cli');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    /**
     * @covers Gear\Edge\AntEdge::getAntProject
     */
    public function testUnfoundProjectType()
    {
        $ant = new \Gear\Edge\AntEdge();
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $ant->getAntProject(null);

    }

    /**
     * @covers Gear\Edge\AntEdge::getAntModule
     */
    public function testUnfoundModuleType()
    {
        $ant = new \Gear\Edge\AntEdge();
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $ant->getAntModule(null);

    }


    /**
     * @group Gear
     * @group AntEdge
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getAntEdge()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group AntEdge
    */
    public function testGet()
    {
        $antEdge = $this->getAntEdge();
        $this->assertInstanceOf('Gear\Edge\AntEdge', $antEdge);
    }

    /**
     * @group Gear
     * @group AntEdge
    */
    public function testSet()
    {
        $mockAntEdge = $this->getMockSingleClass(
            'Gear\Edge\AntEdge'
        );
        $this->setAntEdge($mockAntEdge);
        $this->assertEquals($mockAntEdge, $this->getAntEdge());
    }
}
