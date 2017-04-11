<?php
namespace GearTest\CreatorTest;

use PHPUnit_Framework_TestCase as TestCase;
use Gear\Creator\ClassObject;
use GearJson\Controller\Controller;
use GearJson\Src\Src;

class ClassObjectTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->module = 'Module';
    }
    
    public function testController()
    {
        $controller = new Controller(
            [
                'name' => 'MyController',
                'namespace' => 'AnotherNamespace',
                'type' => 'Action'
            ***REMOVED***    
        );
        
        
        $class = new ClassObject($controller, $this->module);
        
        $this->assertEquals($class->getNamespace(), 'Module\AnotherNamespace');
        $this->assertEquals($class->getFullName(), 'Module\AnotherNamespace\MyController');
        $this->assertEquals($class->getAbsoluteFullName(), '\Module\AnotherNamespace\MyController');
        $this->assertEquals($class->getName(), 'MyController');
        
    }
    
    public function testSrc()
    {
        $src = new Src(
            [
                'name' => 'MyService',
                'namespace' => 'AnotherNamespace',
                'type' => 'Service'
            ***REMOVED***
        );
        
        
        $class = new ClassObject($src, $this->module);
        
        $this->assertEquals($class->getNamespace(), 'Module\AnotherNamespace');
        $this->assertEquals($class->getFullName(), 'Module\AnotherNamespace\MyService');
        $this->assertEquals($class->getAbsoluteFullName(), '\Module\AnotherNamespace\MyService');
        $this->assertEquals($class->getName(), 'MyService');
    }
}

