<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class FileTest extends AbstractGearTest
{
    public function dataFile()
    {
        return array(
            array('datasdfsa1', 'dasdfata2', 'datasdfasdfa3', 'd34523452ta4')
        );
    }

    /**
     * @dataProvider dataFile
     */

    public function testCreateFileFromArray($name, $location, $extension, $content)
    {
        $data = array(
        	'name'       => $name,
            'extension'  => $extension,
            'content'    => $content,
            'location'   => $location
        );

        $file = new \Gear\ValueObject\Filesystem\File($data);


        $this->assertEquals($file->getName(), $name);
        $this->assertEquals($file->getExtension(), $extension);
        $this->assertEquals($file->getContent(), $content);
        $this->assertEquals($file->getLocation(), $location);


        $exchangeData = $file->extract();

        $this->assertEquals($exchangeData['name'***REMOVED***, $name);
        $this->assertEquals($exchangeData['extension'***REMOVED***, $extension);
        $this->assertEquals($exchangeData['content'***REMOVED***, $content);
        $this->assertEquals($exchangeData['location'***REMOVED***, $location);
    }
}
