<?php
namespace GearTest\EdgeTest\DirEdgeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Edge\DirEdgeTrait;

/**
 * @group Edge
 */
class DirEdgeTest extends AbstractTestCase
{
    use DirEdgeTrait;

    /**
     * @covers Gear\Edge\DirEdge::getDirModule
     */
    public function testGetModuleWebLocation()
    {
        $dir = new \Gear\Edge\DirEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir->setYamlService($yaml);
        $web = $dir->getDirModule('web');
        $this->assertArrayHasKey('writable', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    /**
     * @covers Gear\Edge\DirEdge::getDirProject
     */
    public function testGetProjectWebLocation()
    {
        $dir = new \Gear\Edge\DirEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir->setYamlService($yaml);
        $web = $dir->getDirProject('web');
        $this->assertArrayHasKey('ignore', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    /**
     * @covers Gear\Edge\DirEdge::getDirModule
     */
    public function testGetModuleCliLocation()
    {
        $dir = new \Gear\Edge\DirEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $dir->setYamlService($yaml);
        $web = $dir->getDirModule('cli');
        $this->assertArrayHasKey('ignore', $web);
        $this->assertArrayHasKey('writable', $web);
    }

    /**
     * @covers Gear\Edge\DirEdge::getDirProject
     */
    public function testUnfoundProjectType()
    {
        $dir = new \Gear\Edge\DirEdge();
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $dir->getDirProject(null);

    }

    /**
     * @covers Gear\Edge\DirEdge::getDirModule
     */
    public function testUnfoundModuleType()
    {
        $dir = new \Gear\Edge\DirEdge();
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $dir->getDirModule(null);

    }

    /**
     * @group Gear
     * @group DirEdge
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getDirEdge()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group DirEdge
    */
    public function testGet()
    {
        $dirEdge = $this->getDirEdge();
        $this->assertInstanceOf('Gear\Edge\DirEdge', $dirEdge);
    }

    /**
     * @group Gear
     * @group DirEdge
    */
    public function testSet()
    {
        $mockDirEdge = $this->getMockSingleClass(
            'Gear\Edge\DirEdge'
        );
        $this->setDirEdge($mockDirEdge);
        $this->assertEquals($mockDirEdge, $this->getDirEdge());
    }
}
