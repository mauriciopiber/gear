<?php
namespace GearTest\EdgeTest\FileTest\FileEdgeTest;

use PHPUnit\Framework\TestCase;
use Gear\Util\Yaml\YamlService;
use Gear\Edge\File\FileEdge;
use Gear\Edge\File\FileEdgeTrait;

/**
 * @group Edge
 */
class FileEdgeTest extends TestCase
{
    use FileEdgeTrait;

    public function testGetModuleWebLocation()
    {
        $yaml = new YamlService();
        $file = new FileEdge($yaml);
        $web = $file->getFileModule('web');
        $this->assertArrayHasKey('files', $web);
    }

    public function testGetModuleCliLocation()
    {
        $yaml = new YamlService();
        $file = new FileEdge($yaml);
        $web = $file->getFileModule('cli');
        $this->assertArrayHasKey('files', $web);
    }

    public function testUnfoundModuleType()
    {
        $yaml = new YamlService();
        $file = new FileEdge($yaml);
        $this->expectException('Gear\Edge\Exception\ModuleTypeNotFoundException');
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
