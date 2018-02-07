<?php
namespace GearTest\UtilTest\GlobTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Util\Glob\GlobService;

/**
 * @group Service
 */
class GlobServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->service = new GlobService();
    }

    public function testClassExists()
    {
        $this->assertInstanceOf('Gear\Util\Glob\GlobService', $this->service);
    }
}
