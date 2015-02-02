<?php
namespace GearTest\ServiceTest;

use GearTest\AbstractTestCase;

abstract class AbstractServiceTest extends AbstractTestCase
{
    /**
     * Set up config for boilerplate module, to use to test files and configs on gear
     * should be removed on tearDown.
     */
    public function setUp()
    {
        parent::setUp();

        $this->bootstrap = new \GearTest\Bootstrap();
        $this->setServiceLocator($this->bootstrap->getServiceManager());

        $this->bootstrap->getServiceManager()->setAllowOverride(true);

        $this->config = $this->getMockBuilder('\Gear\ValueObject\Config\Config')->disableOriginalConstructor()->setMethods(array('getModule'))->getMock();
        $this->config->expects($this->any())
        ->method('getModule')
        ->will($this->returnValue('TestModule'));

        $this->bootstrap->getServiceLocator()->get('ServiceManager')->setService('moduleConfig', $this->config);

        $moduleService = $this->getServiceLocator()->get('moduleService');
        $moduleService->setConfig($this->config);
        $this->moduleService = $moduleService;


    }

    public function tearDown()
    {
        unset($this->config);
        unset($this->moduleService);
        parent::tearDown();
    }



}