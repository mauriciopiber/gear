<?php
namespace Teste\TesteTest;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function testLocation()
    {
        $module = new \Teste\Module();
        $location = $module->getLocation();
        $this->assertStringEndsWith('Teste/src/Teste', $location);
    }
}
