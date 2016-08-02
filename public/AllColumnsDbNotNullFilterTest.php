<?php
namespace MyModuleTest\FilterTest;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @group MyModule
 * @group AllColumnsDbNotNullFilter
 * @group Filter1
 */
class AllColumnsDbNotNullFilterTest extends TestCase
{
    public function setUp()
    {
        $this->filter = new \MyModule\Filter\AllColumnsDbNotNullFilter();
    }

    public function mockUploadImage()
    {
        $maker = new \GearBaseTest\UploadImageMock();
        return $maker->mockUploadFile(\MyModule\Module::getLocation());
    }

    /**
     * @group MyModule
     * @group AllColumnsDbNotNullFilter
     */
    public function testReturnTrueWithValidPost()
    {
        $data = array(
                    'idAllColumnsDbNotNull' => '99',
                    'varcharPasswordVerifyNotNull' => '99VarcharPasswordVer',
                    'varcharPasswordVerifyNotNullVerify' => '99VarcharPasswordVer',
                    'varcharUploadImageNotNull' => array(
                        'error' => 0,
                        'name' => 'varcharUploadImageNotNull99insert.gif',
                        'tmp_name' => $this->mockUploadImage(),
                        'type'      =>  'image/gif',
                        'size'      =>  42,
                    ),
                    'varcharUrlNotNull' => 'varchar.url.not.null99.com.br',
                    'varcharVarcharNotNull' => '99Varchar Varchar Not Null',
                    'varcharUniqueIdNotNull' => '99Varchar Unique Not Null',
                    'varcharTelephoneNotNull' => '(51) 9999-9999',
                    'varcharEmailNotNull' => 'varchar.email.not.null99@gmail.com',
                    'dateDateNotNull' => '2007-03-09',
                    'dateDatePtBrNotNull' => '09/03/2007',
                    'datetimeDatetimeNotNull' => '2007-03-09 03:00:39',
                    'datetimeDatetimePtBrNotNull' => '09/03/2007 03:00:39',
                    'timeTimeNotNull' => '03:00:39',
                    'decimalDecimalNotNull' => '99.99',
                    'decimalMoneyPtBrNotNull' => 'R$ 99,99',
                    'intIntNotNull' => '99',
                    'intCheckboxNotNull' => 'Sim',
                    'idIntForeignKeyNotNull' => '9Dep Name',
                    'booleanIntNotNull' => 'Sim',
                    'booleanCheckboxNotNull' => 'Sim',
                    'textTextNotNull' => '99Text Text Not Null',
                    'textHtmlNotNull' => '99Text Html Not Null',
                );

        $inputFilter = $this->filter->getInputFilter();
        $inputFilter->get('varcharUploadImageNotNull')->setAutoPrependUploadValidator(false);
        $inputFilter->setData($data);
        $this->assertTrue($inputFilter->isValid());
    }
}
