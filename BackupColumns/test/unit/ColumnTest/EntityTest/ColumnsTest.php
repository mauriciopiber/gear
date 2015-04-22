<?php
namespace Column\ColumnTest\EntityTest;

/**
 * @group Entity
 */
class ColumnsTest extends \PHPUnit_Framework_TestCase
{
    protected $columns;

    protected function setUp()
    {
        $this->bootstrap = new \Column\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getColumns()
    {
        if (!isset($this->columns)) {
            $this->columns = $this->bootstrap->getServiceLocator()->get('Column\Entity\Columns');
        }
        return $this->columns;
    }

    /**
     * @group Column
     * @group Columns
     */
    public function testCallUsingServiceLocator()
    {
        $columns = $this->getColumns();
        $this->assertInstanceOf('Column\Entity\Columns', $columns);
    }


    public function testGetterInitiateByNull()
    {
        $entity = $this->getColumns();
        $this->assertNull($entity->getIdColumns());
        $this->assertNull($entity->getColumnDate());
        $this->assertNull($entity->getColumnDatetime());
        $this->assertNull($entity->getColumnTime());
        $this->assertNull($entity->getColumnInt());
        $this->assertNull($entity->getColumnTinyint());
        $this->assertNull($entity->getColumnDecimal());
        $this->assertNull($entity->getColumnVarchar());
        $this->assertNull($entity->getColumnLongtext());
        $this->assertNull($entity->getColumnText());
        $this->assertNull($entity->getCreated());
        $this->assertNull($entity->getUpdated());
        $this->assertNull($entity->getCreatedBy());
        $this->assertNull($entity->getUpdatedBy());
        $this->assertNull($entity->getColumnDatetimePtBr());
        $this->assertNull($entity->getColumnDatePtBr());
        $this->assertNull($entity->getColumnDecimalPtBr());
        $this->assertNull($entity->getColumnIntCheckbox());
        $this->assertNull($entity->getColumnTinyintCheckbox());
        $this->assertNull($entity->getColumnVarcharEmail());
        $this->assertNull($entity->getColumnVarcharPasswordVerify());
        $this->assertNull($entity->getColumnVarcharUniqueId());
        $this->assertNull($entity->getColumnVarcharUploadImage());
        $this->assertNull($entity->getColumnForeignKey());
    }

    /**
     * @dataProvider getProvider
     */
    public function testSetterAndGet(
        $columnDate,
        $columnDatetime,
        $columnTime,
        $columnInt,
        $columnTinyint,
        $columnDecimal,
        $columnVarchar,
        $columnLongtext,
        $columnText,
        $created,
        $updated,
        $mockCreatedBy,
        $mockUpdatedBy,
        $columnDatetimePtBr,
        $columnDatePtBr,
        $columnDecimalPtBr,
        $columnIntCheckbox,
        $columnTinyintCheckbox,
        $columnVarcharEmail,
        $columnVarcharPasswordVerify,
        $columnVarcharUniqueId,
        $columnVarcharUploadImage,
        $mockColumnForeignKey
    ) {
        $entity = $this->getColumns();
        $entity->setColumnDate($columnDate);
        $this->assertEquals($columnDate, $entity->getColumnDate());

        $entity->setColumnDatetime($columnDatetime);
        $this->assertEquals($columnDatetime, $entity->getColumnDatetime());

        $entity->setColumnTime($columnTime);
        $this->assertEquals($columnTime, $entity->getColumnTime());

        $entity->setColumnInt($columnInt);
        $this->assertEquals($columnInt, $entity->getColumnInt());

        $entity->setColumnTinyint($columnTinyint);
        $this->assertEquals($columnTinyint, $entity->getColumnTinyint());

        $entity->setColumnDecimal($columnDecimal);
        $this->assertEquals($columnDecimal, $entity->getColumnDecimal());

        $entity->setColumnVarchar($columnVarchar);
        $this->assertEquals($columnVarchar, $entity->getColumnVarchar());

        $entity->setColumnLongtext($columnLongtext);
        $this->assertEquals($columnLongtext, $entity->getColumnLongtext());

        $entity->setColumnText($columnText);
        $this->assertEquals($columnText, $entity->getColumnText());

        $entity->setCreated($created);
        $this->assertEquals($created, $entity->getCreated());

        $entity->setUpdated($updated);
        $this->assertEquals($updated, $entity->getUpdated());

        $entity->setCreatedBy($mockCreatedBy);
        $this->assertEquals($mockCreatedBy, $entity->getCreatedBy());

        $entity->setUpdatedBy($mockUpdatedBy);
        $this->assertEquals($mockUpdatedBy, $entity->getUpdatedBy());

        $entity->setColumnDatetimePtBr($columnDatetimePtBr);
        $this->assertEquals($columnDatetimePtBr, $entity->getColumnDatetimePtBr());

        $entity->setColumnDatePtBr($columnDatePtBr);
        $this->assertEquals($columnDatePtBr, $entity->getColumnDatePtBr());

        $entity->setColumnDecimalPtBr($columnDecimalPtBr);
        $this->assertEquals($columnDecimalPtBr, $entity->getColumnDecimalPtBr());

        $entity->setColumnIntCheckbox($columnIntCheckbox);
        $this->assertEquals($columnIntCheckbox, $entity->getColumnIntCheckbox());

        $entity->setColumnTinyintCheckbox($columnTinyintCheckbox);
        $this->assertEquals($columnTinyintCheckbox, $entity->getColumnTinyintCheckbox());

        $entity->setColumnVarcharEmail($columnVarcharEmail);
        $this->assertEquals($columnVarcharEmail, $entity->getColumnVarcharEmail());

        $entity->setColumnVarcharPasswordVerify($columnVarcharPasswordVerify);
        $this->assertEquals($columnVarcharPasswordVerify, $entity->getColumnVarcharPasswordVerify());

        $entity->setColumnVarcharUniqueId($columnVarcharUniqueId);
        $this->assertEquals($columnVarcharUniqueId, $entity->getColumnVarcharUniqueId());

        $entity->setColumnVarcharUploadImage($columnVarcharUploadImage);
        $this->assertEquals($columnVarcharUploadImage, $entity->getColumnVarcharUploadImage());

        $entity->setColumnForeignKey($mockColumnForeignKey);
        $this->assertEquals($mockColumnForeignKey, $entity->getColumnForeignKey());

    }

    public function getProvider()
    {
        $mockUserCreatedBy = $this->getMockBuilder('Security\Entity\User')->getMock();

        $mockUserUpdatedBy = $this->getMockBuilder('Security\Entity\User')->getMock();

        $mockForeignKeysColumnForeignKey = $this->getMockBuilder('Column\Entity\ForeignKeys')->getMock();

        return array(
            array(
                'Column Date',
                'Column Datetime',
                'Column Time',
                'Column Int',
                'Column Tinyint',
                'Column Decimal',
                'Column Varchar',
                'Column Longtext',
                'Column Text',
                'Created',
                'Updated',
                $mockUserCreatedBy,
                $mockUserUpdatedBy,
                'Column Datetime Pt Br',
                'Column Date Pt Br',
                'Column Decimal Pt Br',
                'Column Int Checkbox',
                'Column Tinyint Checkbox',
                'Column Varchar Email',
                'Column Varchar Password Verify',
                'Column Varchar Unique',
                'Column Varchar Upload Image',
                $mockForeignKeysColumnForeignKey
            )
        );
    }
}
