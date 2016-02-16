<?php
namespace GearTest\ConstructorTest\TestTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Test\TestServiceTrait;

/**
 * @group module
 */
class TestServiceTest extends AbstractTestCase
{
    use TestServiceTrait;

    public function testServiceManager()
    {
        $this->assertInstanceOf('Gear\Constructor\Test\TestService', $this->getTestService());
    }
}
