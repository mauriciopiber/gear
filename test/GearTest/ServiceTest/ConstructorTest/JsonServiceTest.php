<?php
namespace Gear\ServiceTest\ConstructorTest;

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
    /**
     * @group rev2
     */
    public function testCreateNewModuleJson()
    {
        $data = $this->jsonService->createNewModuleJson();

        $this->assertTrue(is_array($data));

        $this->assertArrayHasKey('TesteModule', $data);

        $this->assertArrayHasKey('src', $data['TesteModule'***REMOVED***);
        $this->assertArrayHasKey('db', $data['TesteModule'***REMOVED***);
        $this->assertArrayHasKey('controller', $data['TesteModule'***REMOVED***);

        $this->assertEquals(0, count($data['TesteModule'***REMOVED***['src'***REMOVED***));
        $this->assertEquals(0, count($data['TesteModule'***REMOVED***['db'***REMOVED***));
        $this->assertEquals(1, count($data['TesteModule'***REMOVED***['controller'***REMOVED***));

        $this->assertTrue(is_array($data['TesteModule'***REMOVED***['src'***REMOVED***));
        $this->assertTrue(is_array($data['TesteModule'***REMOVED***['db'***REMOVED***));
        $this->assertTrue(is_array($data['TesteModule'***REMOVED***['controller'***REMOVED***));
    }
}
