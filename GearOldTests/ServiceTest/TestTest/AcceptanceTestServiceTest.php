<?php
namespace GearTest\ServiceTest\TestServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;
use Zend\View\HelperPluginManager;

/**
 * @group hardcode
 *
 * @author piber
 *
 */
class AcceptanceTestServiceTest extends AbstractServiceTest
{
    use\Gear\Common\AcceptanceTestServiceTrait;

    static $temp = '/_files/acceptance-create-template-columns.phtml';

    public function testCreateDbAll()
    {

        $this->mockDb();

        $this->module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getTestAcceptanceFolder', 'getModuleName'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('Column');
        $this->module->expects($this->any())->method('getTestAcceptanceFolder')->willReturn(__DIR__.'/_files/');

        $this->bootstrap
        ->getServiceManager()
        ->setAllowOverride(true);
        $this->bootstrap
        ->getServiceManager()
        ->setService('moduleStructure', $this->module);


        $this->getAcceptanceTestService()->setGearSchema($this->schema);
        $this->getAcceptanceTestService()->setModule($this->module);
        $this->getAcceptanceTestService()->setFile($this->file);

        $this->getAcceptanceTestService()->loadTable($this->db);

        $fileCreatedLocation = $this->getAcceptanceTestService()->acceptanceCreate();

        $fileTemp = file_get_contents(__DIR__ . static::$temp);
        $fileCreated = file_get_contents($fileCreatedLocation);


        $this->assertEquals($fileTemp, $fileCreated);
    }
}
