<?php
namespace MyModuleTest\ServiceTest;

use GearBaseTest\AbstractTestCase;
use MyModule\Service\IntForeignKeyServiceTrait;

/**
 * @group MyModule
 * @group IntForeignKeyService
 * @group Service
 */
class IntForeignKeyServiceTraitTest extends AbstractTestCase
{
    use IntForeignKeyServiceTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getIntForeignKeyService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('MyModule\Service\IntForeignKeyService')->reveal();
        $this->setIntForeignKeyService($mocking);
        $this->assertEquals($mocking, $this->getIntForeignKeyService());
    }
}
