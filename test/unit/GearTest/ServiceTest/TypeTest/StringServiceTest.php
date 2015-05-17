<?php
namespace GearTest\ServiceTest\TypeTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group string-filter
 * @author piber
 */
class StringServiceTest extends AbstractTestCase
{

    use \Gear\Common\StringServiceTrait;


    public function getData()
    {
        return array(
        	array('CutIntoVarWithLenghtTwenty'),
            array('cut_into_var_with_lenght_twenty'),
            array('cutIntoVarWithLenghtTwenty'),
        );
    }

    public function testCutForeignKeysSearchFactory()
    {
        $data = 'foreignKeysSearchFactory';
        $expected = 'foreignKeysSearch';
        $this->assertEquals($expected, $this->getStringService()->str('var-lenght', $data));

        $data = 'foreignKeysRepository';
        $expected = 'foreignKeys';
        $this->assertEquals($expected, $this->getStringService()->str('var-lenght', $data));
    }

    public function testClassToLabel()
    {
        $data = 'CampeaoMundial';
        $expected = 'Campeao Mundial';
        $this->assertEquals($expected, $this->getStringService()->str('label', $data));

    }


    /**
     * @dataProvider getData
     */
    public function testCutVariableVar($data)
    {
        $expected = 'cutIntoVarWithLenght';
        $this->assertEquals($expected, $this->getStringService()->str('var-lenght', $data));
    }

    /**
     * @dataProvider getData
     */
    public function testCutVariableClass($data)
    {
        $expected = 'CutIntoVarWithLenght';
        $this->assertEquals($expected, $this->getStringService()->str('class-lenght', $data));
    }


}
