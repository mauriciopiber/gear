<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class LocalTest extends AbstractGearTest
{


    public function testCreateServiceFromArrayWithoutDependes()
    {
        $array = array(
        	'username' => 'myproject',
            'password' => 'mydatabase',
        );

        $src = new \Gear\ValueObject\Config\Local($array);

        $this->assertEquals($src->getUsername(), 'myproject');
        $this->assertEquals($src->getPassword(), 'mydatabase');
        $this->assertEquals($src->getHasDoctrine(), true);
        $this->assertEquals($src->getHasDb(), true);


        $extract = $src->extract();


        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['username'***REMOVED***, 'myproject');
        $this->assertEquals($extract['password'***REMOVED***, 'mydatabase');
        $this->assertEquals($extract['has_doctrine'***REMOVED***, true);
        $this->assertEquals($extract['has_db'***REMOVED***, true);

    }
}
