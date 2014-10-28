<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class ViewTest extends AbstractGearTest
{
    const MAIN = '/var/www/html/modules/module';

    public function testCreateServiceFromArrayWithoutDependes()
    {
        $array = array(
            'target' => 'temp/test.phml',
        );

        $src = new \Gear\ValueObject\View($array);
        $src->prepare('TestingThis');

        $this->assertEquals($src->getTarget(), 'temp/test.phml');
        $this->assertEquals($src->getViewFolder(), self::MAIN.'/TestingThis/view');


        $this->assertEquals($src->getFileName(), 'test.phml');
        $this->assertEquals($src->getFileLocation(), self::MAIN.'/TestingThis/view/temp');


        $extract = $src->extract();

        $this->assertInternalType('array', $extract);
        $this->assertEquals($extract['target'***REMOVED***, 'temp/test.phml');
        $this->assertEquals($extract['view_folder'***REMOVED***, self::MAIN.'/TestingThis/view');
        $this->assertEquals($extract['file_name'***REMOVED***, 'test.phml');
        $this->assertEquals($extract['file_location'***REMOVED***, self::MAIN.'/TestingThis/view/temp');

    }
}
