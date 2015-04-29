<?php
namespace GearTest\ServiceTest\TypeTest;

use GearTest\ServiceTest\AbstractServiceTest;

/**
 * @group string-filter
 * @author piber
 *
 */
class StringServiceTest extends AbstractServiceTest
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
