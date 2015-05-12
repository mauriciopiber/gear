<?php
namespace GearTest\ConfigTest;

use GearBaseTest\AbstractTestCase;

class ServiceManagerTest extends AbstractTestCase
{


    public function testServiceManagerEntitySrc()
    {
        $mockModule = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $mockModule->expects($this->any())->method('getModuleName')->willReturn('PiberModule');

        $serviceManager = new \Gear\Config\ServiceManager($mockModule);

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('TableDb');
        $src->expects($this->any())->method('getType')->willReturn('Entity');

        $serviceManager->extractServiceManagerFromSrc($src);

        $service = $serviceManager->getArray()['invokables'***REMOVED***[0***REMOVED***;

        $this->assertEquals('PiberModule', $service['module'***REMOVED***);
        $this->assertEquals('TableDb', $service['name'***REMOVED***);
        $this->assertEquals('Entity', $service['type'***REMOVED***);
        $this->assertEquals('TableDb', $service['aliase'***REMOVED***);
    }

    public function testServiceManagerRepositorySrc()
    {
        $mockModule = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $mockModule->expects($this->any())->method('getModuleName')->willReturn('PiberModule');

        $serviceManager = new \Gear\Config\ServiceManager($mockModule);

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('TableDbRepository');
        $src->expects($this->any())->method('getType')->willReturn('Repository');

        $serviceManager->extractServiceManagerFromSrc($src);

        $service = $serviceManager->getArray()['invokables'***REMOVED***[0***REMOVED***;


        $this->assertEquals('PiberModule', $service['module'***REMOVED***);
        $this->assertEquals('TableDbRepository', $service['name'***REMOVED***);
        $this->assertEquals('Repository', $service['type'***REMOVED***);
        //$this->assertEquals('TableDb', $service['aliase'***REMOVED***);
    }

    public function testServiceManagerServiceSrc()
    {
        $mockModule = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $mockModule->expects($this->any())->method('getModuleName')->willReturn('PiberModule');

        $serviceManager = new \Gear\Config\ServiceManager($mockModule);

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('TableDbService');
        $src->expects($this->any())->method('getType')->willReturn('Service');

        $serviceManager->extractServiceManagerFromSrc($src);

        $service = $serviceManager->getArray()['invokables'***REMOVED***[0***REMOVED***;

        $this->assertEquals('PiberModule', $service['module'***REMOVED***);
        $this->assertEquals('TableDbService', $service['name'***REMOVED***);
        $this->assertEquals('Service', $service['type'***REMOVED***);
        //$this->assertEquals('TableDb', $service['aliase'***REMOVED***);
    }

    public function testServiceManagerFactorySrc()
    {
        $mockModule = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $mockModule->expects($this->any())->method('getModuleName')->willReturn('PiberModule');

        $serviceManager = new \Gear\Config\ServiceManager($mockModule);

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType'));
        $src->expects($this->any())->method('getName')->willReturn('TableDbFactory');
        $src->expects($this->any())->method('getType')->willReturn('Factory');

        $serviceManager->extractServiceManagerFromSrc($src);

        $service = $serviceManager->getArray()['factories'***REMOVED***[0***REMOVED***;

        $this->assertEquals('PiberModule\Factory\TableDbFactory', $service['callable'***REMOVED***);
        $this->assertEquals('PiberModule\Factory\TableDbFactory', $service['object'***REMOVED***);

/*
        $this->assertEquals('PiberModule', $service['module'***REMOVED***);
        $this->assertEquals('TableDbService', $service['name'***REMOVED***);
        $this->assertEquals('Service', $service['type'***REMOVED***); */
    }

    public function testServiceManagerSearchFormSrc()
    {

    }

    public function testServiceManagerSearchFactorySrc()
    {

    }

    public function testServiceManagerWithoutType()
    {
        $mockModule = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getModuleName'));
        $mockModule->expects($this->any())->method('getModuleName')->willReturn('PiberModule');

        $serviceManager = new \Gear\Config\ServiceManager($mockModule);

        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getName', 'getType', 'getNamespace'));
        $src->expects($this->any())->method('getName')->willReturn('FreeSrc');
        $src->expects($this->any())->method('getType')->willReturn(null);
        $src->expects($this->any())->method('getNamespace')->willReturn('Future');

        $serviceManager->extractServiceManagerFromSrc($src);

        $service = $serviceManager->getArray()['factories'***REMOVED***[0***REMOVED***;

        $this->assertEquals('PiberModule\Future\FreeSrc', $service['callable'***REMOVED***);
        $this->assertEquals('PiberModule\Future\FreeSrcFactory', $service['object'***REMOVED***);
    }

}
