<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class GlobalyTest extends AbstractGearTest
{


    public function testCreateServiceFromArrayWithoutDependes()
    {
        $array = array(
        	'dbms' => 'myproject',
            'dbname' => 'mydatabase',
            'environment' => 'development',
            'host' => 'myproject.gear.dev'
        );

        $src = new \Gear\ValueObject\Config\Globaly($array);

        $this->assertEquals($src->getDbms(), 'myproject');
        $this->assertEquals($src->getDbname(), 'mydatabase');
        $this->assertEquals($src->getEnvironment(), 'development');
        $this->assertEquals($src->getHost(), 'myproject.gear.dev');


        $extract = $src->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['dbms'***REMOVED***, 'myproject');
        $this->assertEquals($extract['dbname'***REMOVED***, 'mydatabase');
        $this->assertEquals($extract['environment'***REMOVED***, 'development');
        $this->assertEquals($extract['host'***REMOVED***, 'myproject.gear.dev');

    }
}
