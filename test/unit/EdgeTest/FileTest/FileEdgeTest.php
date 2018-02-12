<?php
namespace GearTest\EdgeTest\FileTest\FileEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Edge\File\FileEdgeTrait;

/**
 * @group Edge
 */
class FileEdgeTest extends TestCase
{
    use FileEdgeTrait;

    /**
     * @covers Gear\Edge\FileEdge::getFileModule
     */
    public function testGetModuleWebLocation()
    {
        $file = new \Gear\Edge\File\FileEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $file->setYamlService($yaml);
        $web = $file->getFileModule('web');
        $this->assertArrayHasKey('files', $web);
    }

    /**
     * @covers Gear\Edge\FileEdge::getFileModule
     */
    public function testGetModuleCliLocation()
    {
        $file = new \Gear\Edge\File\FileEdge();
        $yaml = new \Gear\Util\Yaml\YamlService();
        $file->setYamlService($yaml);
        $web = $file->getFileModule('cli');
        $this->assertArrayHasKey('files', $web);
    }

    /**
     * @covers Gear\Edge\FileEdge::getFileModule
     */
    public function testUnfoundModuleType()
    {
        $file = new \Gear\Edge\File\FileEdge();
        $this->setExpectedException('Gear\Edge\Exception\ModuleTypeNotFoundException');
        $web = $file->getFileModule(null);

    }

    /**
     * @group Gear
     * @group FileEdge
    */
    public function testSet()
    {
        $mockFileEdge = $this->prophesize(
            'Gear\Edge\File\FileEdge'
        );
        $this->setFileEdge($mockFileEdge->reveal());
        $this->assertEquals($mockFileEdge->reveal(), $this->getFileEdge());
    }
}
