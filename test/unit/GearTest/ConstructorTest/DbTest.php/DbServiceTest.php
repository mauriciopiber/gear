<?php
namespace GearTest\ConstructorTest\DbTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Db\DbServiceTrait;

/**
 * @group module
 */
class DbServiceTest extends AbstractTestCase
{
    use DbServiceTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\Db\DbService', $this->getDbService());
    }
}
