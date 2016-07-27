<?php
namespace MyModuleTest\RepositoryTest;

use GearBaseTest\AbstractTestCase;
use MyModule\Repository\IntForeignKeyRepositoryTrait;

/**
 * @group MyModule
 * @group IntForeignKeyRepository
 * @group Repository
 */
class IntForeignKeyRepositoryTraitTest extends AbstractTestCase
{
    use IntForeignKeyRepositoryTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getIntForeignKeyRepository()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('MyModule\Repository\IntForeignKeyRepository')->reveal();
        $this->setIntForeignKeyRepository($mocking);
        $this->assertEquals($mocking, $this->getIntForeignKeyRepository());
    }
}
