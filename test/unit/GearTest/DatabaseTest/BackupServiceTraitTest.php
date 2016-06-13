<?php
namespace GearTest\DatabaseTest;

use GearBaseTest\AbstractTestCase;
use Gear\Database\BackupServiceTrait;

/**
 * @group Database
 */
class BackupServiceTraitTest extends AbstractTestCase
{
    use BackupServiceTrait;

    public function testServiceLocator()
    {
        $serviceLocator = $this->getBackupService();
        $this->assertInstanceOf('Gear\Database\BackupService', $serviceLocator);
    }

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Database\BackupService')->reveal();
        $this->setBackupService($mocking);
        $this->assertEquals($mocking, $this->getBackupService());
    }
}
