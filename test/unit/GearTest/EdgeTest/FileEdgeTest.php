<?php
namespace GearTest\EdgeTest\FileEdgeTest;

use GearBaseTest\AbstractTestCase;
use Gear\Edge\FileEdgeTrait;

/**
 * @group Edge
 */
class FileEdgeTest extends AbstractTestCase
{
    use FileEdgeTrait;

    /**
     * @covers Gear\Edge\FileEdge::getFileModule
     */
    public function testGetModuleWebLocation()
    {
        $file = new \Gear\Edge\FileEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $file->setYamlService($yaml);
        $web = $file->getFileModule('web');
        $this->assertArrayHasKey('files', $web);
    }

    /**
     * @covers Gear\Edge\FileEdge::getFileProject
     */
    public function testGetProjectWebLocation()
    {
        $file = new \Gear\Edge\FileEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $file->setYamlService($yaml);
        $web = $file->getFileProject('web');
        $this->assertArrayHasKey('files', $web);
    }

    /**
     * @covers Gear\Edge\FileEdge::getFileModule
     */
    public function testGetModuleCliLocation()
    {
        $file = new \Gear\Edge\FileEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $file->setYamlService($yaml);
        $web = $file->getFileModule('cli');
        $this->assertArrayHasKey('files', $web);
    }

    /**
     * @covers Gear\Edge\FileEdge::getFileProject
     */
    public function testUnfoundProjectType()
    {
        $file = new \Gear\Edge\FileEdge();
        $this->setExpectedException('Gear\Edge\Exception\ProjectTypeNotFoundException');
        $web = $file->getFileProject(null);

    }

    /**
     * @covers Gear\Edge\FileEdge::getFileModule
     */
    public function testUnfoundModuleType()
    {
        $file = new \Gear\Edge\FileEdge();
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $file->getFileModule(null);

    }

    /**
     * @group Gear
     * @group FileEdge
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getFileEdge()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Gear
     * @group FileEdge
    */
    public function testGet()
    {
        $fileEdge = $this->getFileEdge();
        $this->assertInstanceOf('Gear\Edge\FileEdge', $fileEdge);
    }

    /**
     * @group Gear
     * @group FileEdge
    */
    public function testSet()
    {
        $mockFileEdge = $this->getMockSingleClass(
            'Gear\Edge\FileEdge'
        );
        $this->setFileEdge($mockFileEdge);
        $this->assertEquals($mockFileEdge, $this->getFileEdge());
    }
}
