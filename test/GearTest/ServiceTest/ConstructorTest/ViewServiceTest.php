<?php
namespace GearGest\ConstructorTest;

use GearTest\AbstractGearTest;

class ViewTest extends AbstractGearTest
{
    protected $moduleName;

    public function setUp()
    {
        parent::setUp();
        $this->moduleName = 'MeuModulo';
        $this->service = $this->getServiceLocator()->get('viewConstructor');
        $this->service->setConfig($this->getMockConfig());
    }



    public function getMockConfig()
    {
        $this->testDir     = __DIR__.'/../../temp';

        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
        $dirService->mkDir($this->testDir);
        $dirService->mkDir($this->testDir.'/schema');

        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue($this->moduleName));

        $mockConfig->expects($this->any())
        ->method('getModuleFolder')
        ->will($this->returnValue($this->testDir));

        return $mockConfig;

    }



    public function tearDown()
    {
        parent::tearDown();
    }

    public function testAssertServiceManager()
    {
        $this->assertInstanceOf('Gear\Service\Constructor\ViewService', $this->service);
    }

    public function testCreateReturnsFalseWithFalseArray()
    {
        $data = $this->service->create(array());
        $this->assertFalse($data);
    }


    public function testCreateReturnsTrueWithTrue()
    {
        $data = $this->service->create(array('target' => 'main/test.phtml'));
        $this->assertTrue($data);
    }

}