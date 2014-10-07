<?php
namespace GearTest\Model;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{

    public function configuration()
    {
        return array(
            array('project','/var/www/html','module',array('TableTable','TableLateNight'),'tab',null)
        );
    }
    /**
     * @dataProvider configuration
     */

    public function testCreateObjectSuccessul($project,$path,$module,$tables,$prefix,$speciality)
    {
        $configuration = new \Gear\Model\Configuration($project,$path,$module,$tables,$prefix,$speciality);

        $this->assertEquals($configuration->getProject(),'project');
        $this->assertEquals($configuration->getPath(),'/var/www/html');
        $this->assertEquals($configuration->getModule(),'Module');
        $this->assertEquals($configuration->getTables(),array('table_table','table_late_night'));
        $this->assertEquals($configuration->getPrefix(),'tab');
        $this->assertEquals($configuration->getSpecialty(),null);
        //var_dump($configuration);
    }
}
