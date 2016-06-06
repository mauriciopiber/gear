<?php
namespace GearTest\EdgeTest\AntEdgeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Edge\AntEdge\AntEdgeTrait;

/**
 * @group Edge
 * @group AntEdge
 */
class AntEdgeTest extends AbstractTestCase
{
    use AntEdgeTrait;


    public function setUp()
    {
        parent::setUp();

        $this->ant = new \Gear\Edge\AntEdge\AntEdge();

    }
    /**
     * @covers Gear\Edge\AntEdge::getAntModule
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
     * @covers Gear\Edge\AntEdge::getAntProject
     */
    public function testGetProjectWebLocation()
    {

        $yaml = new \Gear\Util\Yaml\YamlService();
        $this->ant->setYamlService($yaml);
        $web = $this->ant->getAntProject('web');
        $this->assertArrayHasKey('default', $web);
        $this->assertArrayHasKey('target', $web);
    }

    /**
     * @covers Gear\Edge\AntEdge::getAntModule
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
     * @covers Gear\Edge\AntEdge::getAntProject
     */
    public function testUnfoundProjectType()
    {
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $this->ant->getAntProject(null);

    }

    /**
     * @covers Gear\Edge\AntEdge::getAntModule
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
        $this->assertInstanceOf('Gear\Edge\AntEdge\AntEdge', $antEdge);
    }

    /**
     * @group Gear
     * @group AntEdge
    */
    public function testSet()
    {
        $mockAntEdge = $this->getMockSingleClass(
            'Gear\Edge\AntEdge\AntEdge'
        );
        $this->setAntEdge($mockAntEdge);
        $this->assertEquals($mockAntEdge, $this->getAntEdge());
    }
}
