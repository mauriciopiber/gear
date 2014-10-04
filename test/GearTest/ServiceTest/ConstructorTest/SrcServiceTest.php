<?php
namespace Gear\ServiceTest\ConstructorTest;

class SrcServiceTest extends \PHPUnit_Framework_TestCase
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
}
