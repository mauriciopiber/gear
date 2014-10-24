<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class SrcTest extends AbstractGearTest
{

    public function testCreateServiceWithoutDependes()
    {
        $array = array(
        	'name' => 'serviceTest',
            'type' => 'Service',
            'extends' => 'AbstractService',
            'dependency' => ''
        );

        $src = new \Gear\ValueObject\Src($array);

        $this->assertEquals($src->getName(), 'serviceTest');
        $this->assertEquals($src->getType(), 'Service');
        $this->assertEquals($src->getExtends(), 'AbstractService');
        $this->assertEquals($src->getDependency(), array());

        $extract = $src->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['name'***REMOVED***, 'serviceTest');
        $this->assertEquals($extract['type'***REMOVED***, 'Service');
        $this->assertEquals($extract['extends'***REMOVED***, 'AbstractService');
        $this->assertEquals($extract['dependency'***REMOVED***, array());
    }

    public function testCreateServiceWithOneDependes()
    {
        $array = array(
            'name' => 'serviceTest',
            'type' => 'Service',
            'extends' => 'AbstractService',
            'dependency' => 'Service\MyDepends'
        );

        $src = new \Gear\ValueObject\Src($array);

        $this->assertEquals($src->getName(), 'serviceTest');
        $this->assertEquals($src->getType(), 'Service');
        $this->assertEquals($src->getExtends(), 'AbstractService');
        $this->assertEquals($src->getDependency(), array('Service\MyDepends'));

        $extract = $src->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['name'***REMOVED***, 'serviceTest');
        $this->assertEquals($extract['type'***REMOVED***, 'Service');
        $this->assertEquals($extract['extends'***REMOVED***, 'AbstractService');
        $this->assertEquals($extract['dependency'***REMOVED***, array('Service\MyDepends'));
    }

    public function testCreateServiceWithMultipleDepends()
    {
        $array = array(
            'name' => 'serviceTest',
            'type' => 'Service',
            'extends' => 'AbstractService',
            'dependency' => 'Service\MyDepends,Factory\MyDepends'
        );

        $src = new \Gear\ValueObject\Src($array);

        $this->assertEquals($src->getName(), 'serviceTest');
        $this->assertEquals($src->getType(), 'Service');
        $this->assertEquals($src->getExtends(), 'AbstractService');
        $this->assertEquals($src->getDependency(), array('Service\MyDepends','Factory\MyDepends'));

        $extract = $src->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['name'***REMOVED***, 'serviceTest');
        $this->assertEquals($extract['type'***REMOVED***, 'Service');
        $this->assertEquals($extract['extends'***REMOVED***, 'AbstractService');
        $this->assertEquals($extract['dependency'***REMOVED***,  array('Service\MyDepends','Factory\MyDepends'));
    }
}