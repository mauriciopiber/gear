<?php
namespace Teste\MyModuleTest;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testLocation()
    {
        $module = new \MyModule\Module();
        $location = $module->getLocation();
        $this->assertStringEndsWith('/src/MyModule', $location);
    }
}
