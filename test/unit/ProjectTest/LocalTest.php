<?php
namespace GearTest\ProjectTest;

use PHPUnit\Framework\TestCase;
use Exception;
use Gear\Project\Config\Local;

class LocalTest extends TestCase
{
    public function testMissingParams()
    {
        $this->expectException(Exception::class);

        $data = new Local([
            'username' => '',
            'password' => '',
            'host' => '',
            'environment' => ''
        ***REMOVED***);
    }
}