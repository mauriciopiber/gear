<?php
namespace GearTest;

abstract class AbstractGearTest extends \PHPUnit_Framework_TestCase
{
    protected $serviceLocator;

    public function setUp()
    {
        parent::setUp();

        $this->bootstrap = new \GearTest\Bootstrap();
        $this->setServiceLocator($this->bootstrap->getServiceManager());

        $dirService = $this->bootstrap->getServiceLocator()->get('dirService');
        $dirService->mkDir($this->getTempMock());
        $dirService->mkDir($this->getTempMock().'/schema');

        $this->getServiceLocator()->get('serviceManager')->setAllowOverride(true);
        $this->getServiceLocator()->get('serviceManager')->setService('moduleConfig', $this->getMockConfig());
    }

    public function getTempMock()
    {
        return __DIR__.'/../temp';
    }

    public function getModuleMock()
    {
        return 'ModuleTest';
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function getMockConfig($dir = null)
    {
        if (empty($dir)) {
            $dir = $this->getTempMock();
        }

        $mockConfig = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->getMock();
        $mockConfig->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue($this->getModuleMock()));

        $mockConfig->expects($this->any())
        ->method('getModuleFolder')
        ->will($this->returnValue($dir));

        return $mockConfig;
    }

    public function getMockTemplate()
    {
        $mockTemplate = $this->getMockBuilder('Gear\Service\TemplateService')->getMock();

        $mockTemplate->expects($this->any())
        ->method('render')
        ->willReturn(true);

        return $mockTemplate;
    }


    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
