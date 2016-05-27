<?php
namespace GearTest\EdgeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Edge\NpmEdgeTrait;

/**
 * @group Edge
 * @group Service
 */
class NpmEdgeTest extends AbstractTestCase
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
    public function testServiceLocator()
    {
        $serviceLocator = $this->getNpmEdge()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group NpmEdge
    */
    public function testGet()
    {
        $npmEdge = $this->getNpmEdge();
        $this->assertInstanceOf('Gear\Edge\NpmEdge', $npmEdge);
    }

    /**
     * @group Gear
     * @group NpmEdge
    */
    public function testSet()
    {
        $mockNpmEdge = $this->getMockSingleClass(
            'Gear\Edge\NpmEdge'
        );
        $this->setNpmEdge($mockNpmEdge);
        $this->assertEquals($mockNpmEdge, $this->getNpmEdge());
    }
}
