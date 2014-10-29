<?php
namespace GearTest;

abstract class AbstractGearTest extends \PHPUnit_Framework_TestCase
{
    protected $serviceLocator;

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function setUp()
    {
        $this->bootstrap = new \GearTest\Bootstrap();
        $this->setServiceLocator($this->bootstrap->getServiceManager());
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
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
}
