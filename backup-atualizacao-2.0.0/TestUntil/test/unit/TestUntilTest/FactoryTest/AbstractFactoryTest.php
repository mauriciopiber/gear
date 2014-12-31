<?php
namespace TestUntil\TestUntilTest\FactoryTest;

class AbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $pais;

    protected function setUp()
    {
        $this->bootstrap = new \TestUntil\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }


    public function testSetEntityManager()
    {
        $abstract = $this->getMockBuilder('TestUntil\Factory\AbstractFactory')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setServiceLocator($this->bootstrap->getServiceLocator());

        $this->assertEquals($this->bootstrap->getServiceLocator(), $abstract->getServiceLocator());
    }

}
