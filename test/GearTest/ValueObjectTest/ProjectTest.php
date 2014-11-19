<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ProjectTest extends AbstractGearTest
{


    public function testCreateServiceFromArrayWithoutDependes()
    {
        $array = array(
        	'name' => 'myproject',
            'host' => 'myproject.gear.dev',
            'git' => 'git@bitbucket.orm/mauriciopiber/myproject',
        );

        $src = new \Gear\ValueObject\Project($array);

        $this->assertEquals($src->getName(), 'myproject');
        $this->assertEquals($src->getHost(), 'myproject.gear.dev');
        $this->assertEquals($src->getGit(), 'git@bitbucket.orm/mauriciopiber/myproject');
        $this->assertEquals($src->getFolder(), \Gear\Service\ProjectService::getProjectFolder());


        $extract = $src->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['name'***REMOVED***, 'myproject');
        $this->assertEquals($extract['host'***REMOVED***, 'myproject.gear.dev');
        $this->assertEquals($extract['git'***REMOVED***, 'git@bitbucket.orm/mauriciopiber/myproject');
        $this->assertEquals($extract['folder'***REMOVED***, \Gear\Service\ProjectService::getProjectFolder());

    }
}
