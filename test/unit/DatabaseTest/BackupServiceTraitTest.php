<?php
namespace GearTest\DatabaseTest;

use PHPUnit\Framework\TestCase;
use Gear\Database\BackupServiceTrait;

/**
 * @group Database
 */
class BackupServiceTraitTest extends TestCase
{
    use BackupServiceTrait;

    public function testSet()
    {
        $mocking = $this->prophesize('Gear\Database\BackupService')->reveal();
        $this->setBackupService($mocking);
        $this->assertEquals($mocking, $this->getBackupService());
    }
}
