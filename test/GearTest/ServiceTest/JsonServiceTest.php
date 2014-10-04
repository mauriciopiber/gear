<?php
namespace Gear\ServiceTest;

class JsonServiceTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->bootstrap   = new \GearTest\Bootstrap();
        $this->jsonService = $this->bootstrap->getServiceLocator()->get('jsonService');
        $this->testDir     = __DIR__.'/../../temp';

        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
        $dirService->mkDir($this->testDir);
        $dirService->mkDir($this->testDir.'/schema');

        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TesteModule'));

        $mockConfig->expects($this->any())
        ->method('getModuleFolder')
        ->will($this->returnValue($this->testDir));

        $this->jsonService->setConfig($mockConfig);

    }

    public function tearDown()
    {
        /* @var $dirService \Gear\Service\Filesystem\DirService */
        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
        $dirService->rmDir($this->testDir);
        unset($this->bootstrap);

    }

    public function testCanUseServiceLocator()
    {
        $this->assertInstanceOf('Gear\Service\JsonService', $this->jsonService);
    }

    public function testWriteJson()
    {
        $data = $this->jsonService->writeJson();
        $this->assertTrue($data);
    }

    public function testReadJsonFromModule()
    {

    }

    public function testCreateModuleJson()
    {
        $data = $this->jsonService->createModuleJson();

        $this->assertTrue(is_array($data));

        $this->assertArrayHasKey('TesteModule', $data);

        $this->assertArrayHasKey('src', $data['TesteModule'***REMOVED***);
        $this->assertArrayHasKey('db', $data['TesteModule'***REMOVED***);
        $this->assertArrayHasKey('page', $data['TesteModule'***REMOVED***);


        $this->assertTrue(is_array($data['TesteModule'***REMOVED***['page'***REMOVED***));

        //var_dump($data);
    }

    public function testAddSrcToJson()
    {
        $data = $this->jsonService->createModuleJson();

        $expressaoJson = '{"name" : "DefaultService"}';

        //$this->jsonService->
    }

    public function testAddActionToJson()
    {

    }

    public function testDeleteItemSrcFromJson()
    {

    }

    public function testDumpJsonInArrayFormat()
    {
        $this->jsonService->writeJson();
        $data = $this->jsonService->dump('array');
        $this->assertTrue(is_string($data));
    }

    public function testDumpJsonInJsonFormat()
    {
        $this->jsonService->writeJson();
        $data = $this->jsonService->dump('json');
        $this->assertTrue(is_string($data));
    }
}
