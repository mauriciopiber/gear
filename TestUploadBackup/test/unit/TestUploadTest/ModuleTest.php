<?php
namespace Teste\TestUploadTest;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testLocation()
    {
        $module = new \TestUpload\Module();
        $location = $module->getLocation();
        $this->assertStringEndsWith('TestUpload/src/TestUpload', $location);
    }
}
