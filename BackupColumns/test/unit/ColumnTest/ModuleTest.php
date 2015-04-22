<?php
namespace Teste\ColumnTest;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testLocation()
    {
        $module = new \Column\Module();
        $location = $module->getLocation();
        $this->assertStringEndsWith('Column/src/Column', $location);
    }
}
