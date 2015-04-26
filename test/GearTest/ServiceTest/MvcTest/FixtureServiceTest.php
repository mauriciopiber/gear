<?php
namespace GearTest\ServiceTest\MvcServiceTest;

use GearTest\ServiceTest\AbstractServiceTest;


/**
 * @group hardcode
 *
 * @author piber
 *
 */
class FixtureServiceTest extends AbstractServiceTest
{
    use\Gear\Common\FixtureServiceTrait;

    static $temp = '/_files/fixture-template-columns.phtml';

    public function testCreateDbAll()
    {

        $this->mockDb();

        $this->src->expects($this->any())->method('hasDependency')->willReturn(false);
        $this->src->expects($this->any())->method('getType')->willReturn('Fixture');
        $this->src->expects($this->any())->method('getName')->willReturn('ColumnsFixture');
        // mock gear schema
        $this->module = $this->getMockSingleClass('Gear\ValueObject\BasicModuleStructure', array('getFixtureFolder', 'getModuleName'));
        $this->module->expects($this->any())->method('getModuleName')->willReturn('Column');
        $this->module->expects($this->any())->method('getFixtureFolder')->willReturn(__DIR__.'/_files/');

        // mock module service folder && module name
        // mock speciality by array
        $this->getFixtureService()->setGearSchema($this->schema);
        $this->getFixtureService()->setModule($this->module);
        $this->getFixtureService()->setFile($this->file);

        $fileCreatedLocation = $this->getFixtureService()->introspectFromTable($this->db);


        //preg replace unique id
        $fileCreated = file_get_contents($fileCreatedLocation);

        //preg replace unique id
        preg_match_all('/\'[a-zA-Z***REMOVED****UniqueId\' => \'[a-zA-Z0-9.***REMOVED****\'/', $fileCreated, $valuesToSearch);

        //var_dump($valuesToSearch);



        $fileTemp = file_get_contents(__DIR__ . static::$temp);
        preg_match_all('/\'[a-zA-Z***REMOVED****UniqueId\' => \'[a-zA-Z0-9.***REMOVED****\'/', $fileTemp, $valuesToReplace);

        //var_dump($valuesToReplace);

        foreach ($valuesToReplace[0***REMOVED*** as $i => $values) {

            $fileTemp = str_replace($values, $valuesToSearch[0***REMOVED***[$i***REMOVED***, $fileTemp);
        }



        $this->assertEquals($fileTemp, $fileCreated);
    }
}
