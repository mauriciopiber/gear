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

    static $temp = '_files/service-template-columns.phtml';

    public function testOne()
    {

        // mock db

        $columns = array(
            'column_datetime_pt_br' => "datetime-pt-br",
            'column_date_pt_br' => "date-pt-br",
            'column_decimal_pt_br' => "money-pt-br",
            'column_int_checkbox' => "checkbox",
            'column_tinyint_checkbox' => "checkbox",
            'column_varchar_email' => "email",
            'column_varchar_password_verify' => "password-verify",
            'column_varchar_upload_image' => "upload-image",
            'column_varchar_unique_id' => "unique-id"
        );

        $db = $this->getMockSingleClass('Gear\ValueObject\Db', array('getColumns', 'getTable', 'getUser'));
        $db->expects($this->any())->method('getColumns')->willReturn($columns);
        $db->expects($this->any())->method('getTable')->willReturn('Columns');
        $db->expects($this->any())->method('getUser')->willReturn('all');

        // mock src
        $src = $this->getMockSingleClass('Gear\ValueObject\Src', array('getType', 'getName', 'getDb'));
        $src->expects($this->any())->method('getType')->willReturn('Service');
        $src->expects($this->any())->method('getName')->willReturn('ColumnsService');
        $src->expects($this->any())->method('getDb')->willReturn($db);

        // mock gear schema

        $schema = $this->getMockSingleClass('Gear\Schema', array('getSpecialityArray', 'getSrcByDb'));
        $schema->expects($this->any())->method('getSrcByDb')->willReturn($src);
        $schema->expects($this->any())->method('getSpecialityArray')->willReturn($columns);

        $basicModuleStructure = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getServiceFolder'));
        $basicModuleStructure->expects($this->any())->method('getServiceFolder')->willReturn(__DIR__.'/_files');

        // mock module service folder && module name
        // mock speciality by array
        $this->getServiceService()->setGearSchema($schema);
        $this->getServiceService()->setModule($basicModuleStructure);

        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $templateService = null;

        $fileCreator->setTemplateService($templateService);


        $this->getServiceService()->setFile($fileCreator);

        $fileCreatedLocation = $this->getServiceService()->introspectFromTable($db);

        $fileTemp = file_get_contents(__DIR__ . static::$temp);
        $fileCreated = file_get_contents($fileCreatedLocation);

        $this->assertEquals($fileTemp, $fileCreated);
    }
}
