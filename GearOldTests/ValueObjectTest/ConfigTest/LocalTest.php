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
            'host' => 'myprojecthost.com.br',
            'environment' => 'development'
        );

        $src = new \Gear\ValueObject\Config\Local($array);

        $this->assertEquals($src->getUsername(), 'myproject');
        $this->assertEquals($src->getPassword(), 'mydatabase');
        $this->assertEquals($src->getHost(), 'myprojecthost.com.br');
        $this->assertEquals($src->getEnvironment(), 'development');
        $this->assertEquals($src->getHasDoctrine(), true);
        $this->assertEquals($src->getHasDb(), true);


        $extract = $src->extract();


        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['username'***REMOVED***, 'myproject');
        $this->assertEquals($extract['password'***REMOVED***, 'mydatabase');
        $this->assertEquals($extract['host'***REMOVED***, 'myprojecthost.com.br');
        $this->assertEquals($extract['environment'***REMOVED***, 'development');
        $this->assertEquals($extract['has_doctrine'***REMOVED***, true);
        $this->assertEquals($extract['has_db'***REMOVED***, true);

    }
}

