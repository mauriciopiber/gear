<?php
namespace TestUpload\TestUntilTest\FactoryTest;

/**
 * @group Factory
 */
class AbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->bootstrap = new \TestUpload\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }


    public function testSetEntityManager()
    {
        $abstract = $this->getMockBuilder('TestUpload\Factory\AbstractFactory')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setServiceLocator($this->bootstrap->getServiceLocator());

        $this->assertEquals($this->bootstrap->getServiceLocator(), $abstract->getServiceLocator());
    }
}
