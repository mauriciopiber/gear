<?php
namespace MyModuleTest\FilterTest;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @group MyModule
 * @group AllColumnsDbFilter
 * @group Filter1
 */
class AllColumnsDbFilterTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->filter = new \MyModule\Filter\AllColumnsDbFilter();

    }

    public function mockUploadImage()
    {
        $maker = new \GearBaseTest\UploadImageMock();
        return $maker->mockUploadFile(\MyModule\Module::getLocation());
    }

    /**
     * @group Filter2
     */
    public function testValidPost()
    {
        $data =  array(
                    'idAllColumnsDb' => '99',
                    'varcharPasswordVerify' => '99VarcharPasswordVer',
                    'varcharPasswordVerifyVerify' => '99VarcharPasswordVer',
                    'varcharUploadImage' => array(
                        'error' => 0,
                        'name' => 'varcharUploadImage99insert.gif',
                        'tmp_name' => $this->mockUploadImage(),
                        'type'      =>  'image/gif',
                        'size'      =>  42,
                    ),
                    'varcharUrl' => 'varchar.url99.com.br',
                    'varcharVarchar' => '99Varchar Varchar',
                    'varcharUniqueId' => '99Varchar Unique',
                    'varcharTelephone' => '(51) 9999-9999',
                    'varcharEmail' => 'varchar.email99@gmail.com',
                    'dateDate' => '2007-03-09',
                    'dateDatePtBr' => '09/03/2007',
                    'datetimeDatetime' => '2007-03-09 03:00:39',
                    'datetimeDatetimePtBr' => '09/03/2007 03:00:39',
                    'timeTime' => '03:00:39',
                    'decimalDecimal' => '99.99',
                    'decimalMoneyPtBr' => 'R$ 99,99',
                    'intInt' => '99',
                    'intCheckbox' => 'Sim',
                    'idIntForeignKey' => '9Dep Name',
                    'booleanInt' => 'Sim',
                    'booleanCheckbox' => 'Sim',
                    'textText' => '99Text Text',
                    'textHtml' => '99Text Html',
                );

        $inputFilter = $this->filter->getInputFilter();
        $inputFilter->get('varcharUploadImage')->setAutoPrependUploadValidator(false);
        $inputFilter->setData($data);
        $this->assertTrue($inputFilter->isValid());
    }
}
