<?php
namespace GearTest\ValueObject;

use GearTest\AbstractGearTest;

class TestTest extends AbstractGearTest
{
    const MAIN = '/var/www/html/modules/module';

    public function testCreateTestFromArray()
    {
        $data = array(
        	'target' => 'tests/fuckTest.php',
            'suite' => 'acceptance'
        );

        $test = new \Gear\ValueObject\Test($data);
        $test->prepare('TestingThis');


        $this->assertEquals($test->getTarget(), 'tests/fuckTest.php');
        $this->assertEquals($test->getSuite(), 'acceptance');
        $this->assertEquals($test->getTestFolder(), self::MAIN.'/TestingThis/test');
        $this->assertEquals($test->getFileName(), 'fuckTest.php');
        $this->assertEquals($test->getFileLocation(), self::MAIN.'/TestingThis/test/acceptance/tests');

        $exchangeData = $test->extract();

        $this->assertEquals($exchangeData['target'***REMOVED***, 'tests/fuckTest.php');
        $this->assertEquals($exchangeData['suite'***REMOVED***,  'acceptance');
        $this->assertEquals($exchangeData['test_folder'***REMOVED***, self::MAIN.'/TestingThis/test');
        $this->assertEquals($exchangeData['file_name'***REMOVED***,  'fuckTest.php');
        $this->assertEquals($exchangeData['file_location'***REMOVED***, self::MAIN.'/TestingThis/test/acceptance/tests');
    }

}
