<?php
namespace GearTest\UtilTest\GlobTest;

use PHPUnit\Framework\TestCase;
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
