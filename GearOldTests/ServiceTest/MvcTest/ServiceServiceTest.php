<?php
namespace GearTest\ServiceTest\MvcServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;


/**
 * @group hardcode
 *
 * @author piber
 *
 */
class ServiceServiceTest extends AbstractServiceTest
{
    use\Gear\Common\ServiceServiceTrait;

    static $temp = '/_files/service-template-columns.phtml';

    public function testCreateDbAll()
    {

        $this->mockDb();

        $this->src->expects($this->any())->method('getDependency')->willReturn(array('Repository\Columns'));
        $this->src->expects($this->any())->method('hasDependency')->willReturn(true);
        $this->src->expects($this->any())->method('getType')->willReturn('Service');
        $this->src->expects($this->any())->method('getName')->willReturn('ColumnsService');
        // mock gear schema
        $this->module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getServiceFolder', 'getModuleName'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('Column');
        $this->module->expects($this->any())->method('getServiceFolder')->willReturn(__DIR__.'/_files/');

        // mock module service folder && module name
        // mock speciality by array
        $this->getServiceService()->setGearSchema($this->schema);
        $this->getServiceService()->setModule($this->module);
        $this->getServiceService()->setFile($this->file);

        $fileCreatedLocation = $this->getServiceService()->introspectFromTable($this->db);

        $fileTemp = file_get_contents(__DIR__ . static::$temp);
        $fileCreated = file_get_contents($fileCreatedLocation);


        $this->assertEquals($fileTemp, $fileCreated);
    }
}
