<?php
namespace GearTest;

trait ColumnsNotNullMockTrait
{
    public function getColumnsNotNullMock()
    {
        $table = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\TableObject',
            array(
                'getColumns',
                'getConstraints',
                'getName'
            )
        );

        $table->expects($this->any())->method('getColumns')->willReturn($this->getColumnsNotNullColumnsMock());
        $table->expects($this->any())->method('getConstraints')->willReturn($this->getColumnsNotNullConstraintsMock());
        $table->expects($this->any())->method('getName')->willReturn('ColumnsNotNull');

        return $table;
    }

    public function getColumnsNotNullColumnsMock()
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
        $column->expects($this->any())->method('getName')->willReturn('id_columns_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
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
        $column->expects($this->any())->method('getName')->willReturn('column_date_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('2');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
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
        $column->expects($this->any())->method('getName')->willReturn('column_datetime_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('3');
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
        $column->expects($this->any())->method('getName')->willReturn('column_time_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('4');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
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
        $column->expects($this->any())->method('getName')->willReturn('column_int_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('5');
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
        $column->expects($this->any())->method('getName')->willReturn('column_tinyint_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('6');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
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
        $column->expects($this->any())->method('getName')->willReturn('column_decimal_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('7');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
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
        $column->expects($this->any())->method('getName')->willReturn('column_varchar_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('8');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('100');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('300');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('column_longtext_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('9');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('longtext');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('4294967295');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('4294967295');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('column_text_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('10');
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
        $column->expects($this->any())->method('getName')->willReturn('created');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('11');
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
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('12');
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
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('13');
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
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('14');
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
        $column->expects($this->any())->method('getName')->willReturn('column_datetime_pt_br_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('15');
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
        $column->expects($this->any())->method('getName')->willReturn('column_date_pt_br_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('16');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
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
        $column->expects($this->any())->method('getName')->willReturn('column_decimal_pt_br_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('17');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
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
        $column->expects($this->any())->method('getName')->willReturn('column_int_checkbox_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('18');
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
        $column->expects($this->any())->method('getName')->willReturn('column_tinyint_checkbox_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('19');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
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
        $column->expects($this->any())->method('getName')->willReturn('column_varchar_email_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('20');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('100');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('300');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('column_varchar_password_verify_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('21');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('100');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('300');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('column_varchar_unique_id_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('22');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('varchar');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('100');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('300');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('');
        $column->expects($this->any())->method('getNumericScale')->willReturn('');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;
        $column = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ColumnObject',
            $stubs
        );
        $column->expects($this->any())->method('getName')->willReturn('column_varchar_upload_image_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('23');
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
        $column->expects($this->any())->method('getName')->willReturn('column_foreign_key_copy_not_null');
        $column->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $column->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $column->expects($this->any())->method('getOrdinalPosition')->willReturn('24');
        $column->expects($this->any())->method('getColumnDefault')->willReturn(null);
        $column->expects($this->any())->method('isNullable')->willReturn(false);
        $column->expects($this->any())->method('getDataType')->willReturn('int');
        $column->expects($this->any())->method('getCharacterMaximumLength')->willReturn('');
        $column->expects($this->any())->method('getCharacterOctetLength')->willReturn('');
        $column->expects($this->any())->method('getNumericPrecision')->willReturn('10');
        $column->expects($this->any())->method('getNumericScale')->willReturn('0');
        $column->expects($this->any())->method('isNumericUnsigned')->willReturn('');
        $column->expects($this->any())->method('getErratas')->willReturn(null);

        $columns[***REMOVED*** = $column;        return $columns;
    }

    public function getColumnsNotNullConstraintsMock()
    {
        $constraints = [***REMOVED***;
        $stubs = array(
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
        $constraint = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            $stubs
        );
        $constraint->expects($this->any())->method('getName')->willReturn('_zf_columns_not_null_PRIMARY');
        $constraint->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $constraint->expects($this->any())->method('getType')->willReturn('PRIMARY KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['id_columns_not_null'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('');
        $constraint->expects($this->any())->method('getReferencedTableName')->willReturn('');
        $constraint->expects($this->any())->method('getReferencedColumns')->willReturn(null);
        $constraint->expects($this->any())->method('getMatchOption')->willReturn('');
        $constraint->expects($this->any())->method('getUpdateRule')->willReturn('');
        $constraint->expects($this->any())->method('getDeleteRule')->willReturn('');
        $constraint->expects($this->any())->method('getCheckClause')->willReturn('');

        $constraints[***REMOVED*** = $constraint;

        $constraint = $this->getMockSingleClass(
            'Zend\Db\Metadata\Object\ConstraintObject',
            $stubs
        );
        $constraint->expects($this->any())->method('getName')->willReturn('columns_not_null_ibfk_1');
        $constraint->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $constraint->expects($this->any())->method('getType')->willReturn('FOREIGN KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['created_by'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('pibernews');
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
        $constraint->expects($this->any())->method('getName')->willReturn('columns_not_null_ibfk_2');
        $constraint->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $constraint->expects($this->any())->method('getType')->willReturn('FOREIGN KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['updated_by'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('pibernews');
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
        $constraint->expects($this->any())->method('getName')->willReturn('fk_columns_not_null_1');
        $constraint->expects($this->any())->method('getTableName')->willReturn('columns_not_null');
        $constraint->expects($this->any())->method('getSchemaName')->willReturn('pibernews');
        $constraint->expects($this->any())->method('getType')->willReturn('FOREIGN KEY');
        $constraint->expects($this->any())->method('getColumns')->willReturn(['column_foreign_key_copy_not_null'***REMOVED***);
        $constraint->expects($this->any())->method('getReferencedTableSchema')->willReturn('pibernews');
        $constraint->expects($this->any())->method('getReferencedTableName')->willReturn('foreign_keys_copy');
        $constraint->expects($this->any())->method('getReferencedColumns')->willReturn(['id_foreign_keys_copy'***REMOVED***);
        $constraint->expects($this->any())->method('getMatchOption')->willReturn('NONE');
        $constraint->expects($this->any())->method('getUpdateRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getDeleteRule')->willReturn('CASCADE');
        $constraint->expects($this->any())->method('getCheckClause')->willReturn('');

        $constraints[***REMOVED*** = $constraint;
        return $constraints;
    }
}
