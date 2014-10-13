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
}
