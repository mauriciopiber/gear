<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class GloballyTest extends AbstractGearTest
{
    public function testCreateServiceFromArrayWithoutDependes()
    {
        $array = array(
        	'dbms' => 'myproject',
            'dbname' => 'mydatabase',
            'dbhost' => 'localhost',
        );

        $src = new \Gear\ValueObject\Config\Globally($array);

        $this->assertEquals($src->getDbms(), 'myproject');
        $this->assertEquals($src->getDbname(), 'mydatabase');
        $this->assertEquals($src->getDbhost(), 'localhost');


        $extract = $src->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['dbms'***REMOVED***, 'myproject');
        $this->assertEquals($extract['dbname'***REMOVED***, 'mydatabase');
        $this->assertEquals($extract['dbhost'***REMOVED***, 'localhost');

    }
}
