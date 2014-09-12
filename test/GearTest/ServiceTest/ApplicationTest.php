<?php
namespace Gear\ServiceTest;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{


    public function testCanTestWithThisStuff()
    {
        $this->assertTrue(true);
    }


    public function testTryToActivateANewModule()
    {
        $data = include __DIR__.'/../../../../../config/application.config.php';
        $this->assertTrue(is_array($data));

        return $data;
    }

    /**
     * @depends testTryToActivateANewModule
     */
    public function testTryToAddANewModule($data)
    {
        $data['modules'***REMOVED***[***REMOVED*** = 'teste';

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents(__DIR__.'/../../../../../config/application.config.php', '<?php return ' . $dataArray . '; ?>');
    }

    public function testRemoveModuleFromApplicationConfig()
    {

        $data = include __DIR__.'/../../../../../config/application.config.php';


        $delValue = 'teste';

        if(($key = array_search($delValue, $data['modules'***REMOVED***)) !== false) {
            unset($data['modules'***REMOVED***[$key***REMOVED***);
        }

        $dataArray = preg_replace("/[0-9***REMOVED***+ \=\>/i", ' ', var_export($data, true));

        file_put_contents(__DIR__.'/../../../../../config/application.config.php', '<?php return ' . $dataArray . '; ?>');

    }
}
