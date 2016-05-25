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


        $table->getColumns()->willReturn($this->getAllColumnsDbColumnsMock());
        $table->getConstraints()->willReturn($this->getAllColumnsDbConstraintsMock());
        $table->getName()->willReturn('AllColumnsDb');

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

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');

        $column->getName()->willReturn('id_all_columns_db');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('1');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(false);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('all_columns_one');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('2');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('all_columns_two');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('3');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('email_one');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('4');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('email_two');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('5');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('upload_image_one');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('6');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('upload_image_two');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('7');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('url_one');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('8');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('url_two');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('9');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('telephone_one');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('10');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('telephone_two');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('11');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('unique_id_one');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('12');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('unique_id_two');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('13');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('date_enus');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('14');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('date');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('date_ptbr');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('15');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('date');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('datetime_enus');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('16');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('datetime');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('datetime_ptbr');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('17');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('datetime');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('time_enus');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('18');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('time');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('time_ptbr');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('19');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('time');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('text_enus');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('20');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('text');
        $column->getCharacterMaximumLength()->willReturn('65535');
        $column->getCharacterOctetLength()->willReturn('65535');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('text_ptbr');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('21');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('text');
        $column->getCharacterMaximumLength()->willReturn('65535');
        $column->getCharacterOctetLength()->willReturn('65535');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('decimal_enus');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('22');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('decimal');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('2');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('decimal_ptbr');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('23');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('decimal');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('2');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('int_enus');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('24');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');



        $column->getName()->willReturn('int_ptbr');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('25');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('checkbox');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('26');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('tinyint_enus');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('27');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('tinyint');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('3');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('tinyint_ptbr');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('28');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('tinyint');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('3');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('all_columns_upload_one');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('29');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('all_columns_upload_two');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('30');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('varchar');
        $column->getCharacterMaximumLength()->willReturn('255');
        $column->getCharacterOctetLength()->willReturn('765');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('id_int_dep_three');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('31');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('id_int_dep_four');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('32');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('created');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('33');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(false);
        $column->getDataType()->willReturn('datetime');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('updated');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('34');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('datetime');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('');
        $column->getNumericScale()->willReturn('');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('created_by');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('35');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(false);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();


        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getName()->willReturn('updated_by');
        $column->getTableName()->willReturn('all_columns_db');
        $column->getSchemaName()->willReturn('gear');
        $column->getOrdinalPosition()->willReturn('36');
        $column->getColumnDefault()->willReturn(null);
        $column->isNullable()->willReturn(true);
        $column->getDataType()->willReturn('int');
        $column->getCharacterMaximumLength()->willReturn('');
        $column->getCharacterOctetLength()->willReturn('');
        $column->getNumericPrecision()->willReturn('10');
        $column->getNumericScale()->willReturn('0');
        $column->isNumericUnsigned()->willReturn('');
        $column->getErratas()->willReturn(null);

        $columns[***REMOVED*** = $column->reveal();

        return $columns;
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
        $constraint = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $constraint->getName()->willReturn('_zf_all_columns_db_PRIMARY');
        $constraint->getTableName()->willReturn('all_columns_db');
        $constraint->getSchemaName()->willReturn('gear');
        $constraint->getType()->willReturn('PRIMARY KEY');
        $constraint->getColumns()->willReturn(['id_all_columns_db'***REMOVED***);
        $constraint->getReferencedTableSchema()->willReturn('');
        $constraint->getReferencedTableName()->willReturn('');
        $constraint->getReferencedColumns()->willReturn(null);
        $constraint->getMatchOption()->willReturn('');
        $constraint->getUpdateRule()->willReturn('');
        $constraint->getDeleteRule()->willReturn('');
        $constraint->getCheckClause()->willReturn('');

        return $constraint->reveal();
    }

    public function getAllColumnsDbConstraintsMock()
    {
        $stubs = $this->stubs();

        $constraints = [***REMOVED***;
        $constraints[***REMOVED*** = $this->getPrimaryKey();

        $constraint = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $constraint->getName()->willReturn('all_columns_db_ibfk_1');
        $constraint->getTableName()->willReturn('all_columns_db');
        $constraint->getSchemaName()->willReturn('gear');
        $constraint->getType()->willReturn('FOREIGN KEY');
        $constraint->getColumns()->willReturn(['id_int_dep_three'***REMOVED***);
        $constraint->getReferencedTableSchema()->willReturn('gear');
        $constraint->getReferencedTableName()->willReturn('int_dep_three');
        $constraint->getReferencedColumns()->willReturn(['id_int_dep_three'***REMOVED***);
        $constraint->getMatchOption()->willReturn('NONE');
        $constraint->getUpdateRule()->willReturn('CASCADE');
        $constraint->getDeleteRule()->willReturn('CASCADE');
        $constraint->getCheckClause()->willReturn('');

        $constraints[***REMOVED*** = $constraint->reveal();

        $constraint = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $constraint->getName()->willReturn('all_columns_db_ibfk_2');
        $constraint->getTableName()->willReturn('all_columns_db');
        $constraint->getSchemaName()->willReturn('gear');
        $constraint->getType()->willReturn('FOREIGN KEY');
        $constraint->getColumns()->willReturn(['id_int_dep_four'***REMOVED***);
        $constraint->getReferencedTableSchema()->willReturn('gear');
        $constraint->getReferencedTableName()->willReturn('int_dep_four');
        $constraint->getReferencedColumns()->willReturn(['id_int_dep_four'***REMOVED***);
        $constraint->getMatchOption()->willReturn('NONE');
        $constraint->getUpdateRule()->willReturn('CASCADE');
        $constraint->getDeleteRule()->willReturn('CASCADE');
        $constraint->getCheckClause()->willReturn('');

        $constraints[***REMOVED*** = $constraint->reveal();

        $constraint = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $constraint->getName()->willReturn('all_columns_db_ibfk_3');
        $constraint->getTableName()->willReturn('all_columns_db');
        $constraint->getSchemaName()->willReturn('gear');
        $constraint->getType()->willReturn('FOREIGN KEY');
        $constraint->getColumns()->willReturn(['created_by'***REMOVED***);
        $constraint->getReferencedTableSchema()->willReturn('gear');
        $constraint->getReferencedTableName()->willReturn('user');
        $constraint->getReferencedColumns()->willReturn(['id_user'***REMOVED***);
        $constraint->getMatchOption()->willReturn('NONE');
        $constraint->getUpdateRule()->willReturn('CASCADE');
        $constraint->getDeleteRule()->willReturn('CASCADE');
        $constraint->getCheckClause()->willReturn('');

        $constraints[***REMOVED*** = $constraint->reveal();

        $constraint = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');

        $constraint->getName()->willReturn('all_columns_db_ibfk_4');
        $constraint->getTableName()->willReturn('all_columns_db');
        $constraint->getSchemaName()->willReturn('gear');
        $constraint->getType()->willReturn('FOREIGN KEY');
        $constraint->getColumns()->willReturn(['updated_by'***REMOVED***);
        $constraint->getReferencedTableSchema()->willReturn('gear');
        $constraint->getReferencedTableName()->willReturn('user');
        $constraint->getReferencedColumns()->willReturn(['id_user'***REMOVED***);
        $constraint->getMatchOption()->willReturn('NONE');
        $constraint->getUpdateRule()->willReturn('CASCADE');
        $constraint->getDeleteRule()->willReturn('CASCADE');
        $constraint->getCheckClause()->willReturn('');

        $constraints[***REMOVED*** = $constraint->reveal();
        return $constraints;
    }
}
