<?php
namespace GearTest;

trait AllColumnsDbMockTrait
{
    public function getAllColumnsDbMock()
    {
        $table = $this->prophesize('Zend\Db\Metadata\Object\TableObject');
        $table->getColumns()->willReturn($this->getAllColumnsDbColumnsMock());
        $table->getConstraints()->willReturn($this->getAllColumnsDbConstraintsMock());
        $table->getName()->willReturn('AllColumnsDb');

        return $table->reveal();

        /*
        $table = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\TableObject',
            array(
                'getColumns',
                'getConstraints',
                'getName'
            )
        );

        $table->expects($this->any())->method('getColumns')->willReturn($this->getAllColumnsDbColumnsMock());
        $table->expects($this->any())->method('getConstraints')->willReturn($this->getAllColumnsDbConstraintsMock());
        $table->expects($this->any())->method('getName')->willReturn('AllColumnsDb');

        return $table;
        */
    }

    public function getAllColumnsDbColumnsMock()
    {
        $columns = [***REMOVED***;
        $stubs = array(
            'getName',
            'getTableName',
            'getSchemaName',
            'getOrdinalPosition',
            'getColumnDefault',
            'isNullable',
            'getDataType',
            'getCharacterMaximumLength',
            'getCharacterOctetLength',
            'getNumericPrecision',
            'getNumericScale',
            'isNumericUnsigned',
            'getErratas'
        );
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('id_all_columns_db');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('1');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('all_columns_one');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('2');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('all_columns_two');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('3');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('email_one');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('4');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('email_two');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('5');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('upload_image_one');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('6');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('upload_image_two');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('7');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('url_one');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('8');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('url_two');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('9');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('telephone_one');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('10');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('telephone_two');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('11');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('unique_id_one');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('12');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('unique_id_two');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('13');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('date_enus');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('14');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('date');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('date_ptbr');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('15');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('date');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('datetime_enus');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('16');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('datetime');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('datetime_ptbr');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('17');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('datetime');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('time_enus');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('18');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('time');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('time_ptbr');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('19');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('time');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('text_enus');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('20');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('text');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('65535');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('65535');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('text_ptbr');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('21');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('text');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('65535');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('65535');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('decimal_enus');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('22');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('decimal');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('2');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('decimal_ptbr');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('23');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('decimal');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('2');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('int_enus');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('24');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('int_ptbr');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('25');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('checkbox');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('26');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('tinyint_enus');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('27');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('tinyint');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('3');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('tinyint_ptbr');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('28');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('tinyint');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('3');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('all_columns_upload_one');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('29');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('all_columns_upload_two');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('30');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('255');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('765');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('id_int_dep_three');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('31');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('id_int_dep_four');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('32');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('created');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('33');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('datetime');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('updated');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('34');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('datetime');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('created_by');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('35');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('updated_by');
        $column->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $column->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('36');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(true);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;        return $columns;
    }

    public function stubs()
    {
        return array(
            'getName',
            'getTableName',
            'getSchemaName',
            'getType',
            'getColumns',
            'getReferencedTableSchema',
            'getReferencedTableName',
            'getReferencedColumns',
            'getMatchOption',
            'getUpdateRule',
            'getDeleteRule',
            'getCheckClause'
        );
    }

    public function getPrimaryKey()
    {
        $stubs = $this->stubs();

        $constraint = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            $stubs
        );
        $constraint->expects($this->any())->method('getName')->willReturn('_zf_all_columns_db_PRIMARY');
        $constraint->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $constraint->expects($this->any())->method('getType')->willReturn('PRIMARY KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['id_all_columns_db'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('');
        $constraint->expects($this->any())->method('getReferencedTableName')->willReturn('');
        $constraint->expects($this->any())->method('getReferencedColumns')->willReturn(null);
        $constraint->expects($this->any())->method('getMatchOption')->willReturn('');
        $constraint->expects($this->any())->method('getUpdateRule')->willReturn('');
        $constraint->expects($this->any())->method('getDeleteRule')->willReturn('');
        $constraint->expects($this->any())->method('getCheckClause')->willReturn('');

        return $constraint;
    }

    public function getAllColumnsDbConstraintsMock()
    {
        $stubs = $this->stubs();

        $constraints = [***REMOVED***;
        $constraints[***REMOVED*** = $this->getPrimaryKey();

        $constraint = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            $stubs
        );
        $constraint->expects($this->any())->method('getName')->willReturn('all_columns_db_ibfk_1');
        $constraint->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $constraint->expects($this->any())->method('getType')->willReturn('FOREIGN KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['id_int_dep_three'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('gear');
        $constraint->expects($this->any())->method('getReferencedTableName')->willReturn('int_dep_three');
        $constraint->expects($this->any())->method('getReferencedColumns')->willReturn(['id_int_dep_three'***REMOVED***);
        $constraint->expects($this->any())->method('getMatchOption')->willReturn('NONE');
        $constraint->expects($this->any())->method('getUpdateRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getDeleteRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getCheckClause')->willReturn('');

        $constraints[***REMOVED*** = $constraint;

        $constraint = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            $stubs
        );
        $constraint->expects($this->any())->method('getName')->willReturn('all_columns_db_ibfk_2');
        $constraint->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $constraint->expects($this->any())->method('getType')->willReturn('FOREIGN KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['id_int_dep_four'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('gear');
        $constraint->expects($this->any())->method('getReferencedTableName')->willReturn('int_dep_four');
        $constraint->expects($this->any())->method('getReferencedColumns')->willReturn(['id_int_dep_four'***REMOVED***);
        $constraint->expects($this->any())->method('getMatchOption')->willReturn('NONE');
        $constraint->expects($this->any())->method('getUpdateRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getDeleteRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getCheckClause')->willReturn('');

        $constraints[***REMOVED*** = $constraint;

        $constraint = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            $stubs
        );
        $constraint->expects($this->any())->method('getName')->willReturn('all_columns_db_ibfk_3');
        $constraint->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $constraint->expects($this->any())->method('getType')->willReturn('FOREIGN KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['created_by'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('gear');
        $constraint->expects($this->any())->method('getReferencedTableName')->willReturn('user');
        $constraint->expects($this->any())->method('getReferencedColumns')->willReturn(['id_user'***REMOVED***);
        $constraint->expects($this->any())->method('getMatchOption')->willReturn('NONE');
        $constraint->expects($this->any())->method('getUpdateRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getDeleteRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getCheckClause')->willReturn('');

        $constraints[***REMOVED*** = $constraint;

        $constraint = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            $stubs
        );
        $constraint->expects($this->any())->method('getName')->willReturn('all_columns_db_ibfk_4');
        $constraint->expects($this->any())->method('getTableName')->willReturn('all_columns_db');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('gear');
        $constraint->expects($this->any())->method('getType')->willReturn('FOREIGN KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['updated_by'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('gear');
        $constraint->expects($this->any())->method('getReferencedTableName')->willReturn('user');
        $constraint->expects($this->any())->method('getReferencedColumns')->willReturn(['id_user'***REMOVED***);
        $constraint->expects($this->any())->method('getMatchOption')->willReturn('NONE');
        $constraint->expects($this->any())->method('getUpdateRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getDeleteRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getCheckClause')->willReturn('');

        $constraints[***REMOVED*** = $constraint;
        return $constraints;
    }
}
