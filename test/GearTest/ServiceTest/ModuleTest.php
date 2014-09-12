<?php
namespace GearTest\ServiceTest;

class ModuleTest extends \PHPUnit_Framework_TestCase
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
        $bootstrap = new \GearTest\Bootstrap();
        $this->setServiceLocator($bootstrap->getServiceManager());
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testUseServiceLocatorModuleObject()
    {
        $module = $this->getServiceLocator()->get('moduleService');
        $this->assertInstanceOf('Gear\Service\Module', $module);
    }

    /**
     * @depends testUseServiceLocatorModuleObject
     */
    public function testCreateNewModule()
    {
        $module = $this->getServiceLocator()->get('moduleService')->new();
        $this->assertInstanceOf('Gear\ValueObject\Module', $module);

        return $module;
        // o módulo pode ter N configurações, de início vamos usar só uma.
    }

    /**
     * Features!
     * build.
     * tests.
     * srcDDD
     * doctrine/DB
     * isolation
     */
}
