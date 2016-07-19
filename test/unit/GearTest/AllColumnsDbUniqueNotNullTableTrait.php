<?php
namespace GearTest;

trait AllColumnsDbUniqueNotNullTableTrait
{

    public function prophesizeColumnUniqueNotNull($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function prophesizeForeignKeyUniqueNotNull($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function prophesizeUniqueNotNull($tableName, $columnName)
    {
        $unique = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $unique->getType()->willReturn('UNIQUE')->shouldBeCalled();
        $unique->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();
        $unique->getReferencedTableName()->willReturn($tableName);

        return $unique->reveal();
    }

    public function getAllPossibleUniqueNotNullColumns()
    {
        $this->string = new \GearBase\Util\String\StringService();

        $columns = [***REMOVED***;

        $columns[0***REMOVED*** = new \Gear\Column\Int\PrimaryKey(
            $this->prophesizeColumnUniqueNotNull('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKeyUniqueNotNull('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[1***REMOVED*** = new \Gear\Column\Date\Date($this->prophesizeColumnUniqueNotNull('table', 'date_unique_not_null_column', 'date'));
        $columns[1***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'date_unique_not_null_column'));

        $columns[2***REMOVED*** = new \Gear\Column\Date\DatePtBr($this->prophesizeColumnUniqueNotNull('table', 'date_pt_br_unique_not_null_column', 'date'));
        $columns[2***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'date_pt_br_unique_not_null_column'));

        //datetime
        $columns[3***REMOVED*** = new \Gear\Column\Datetime\Datetime(
            $this->prophesizeColumnUniqueNotNull('table', 'datetime_unique_not_null_column', 'datetime')
        );
        $columns[3***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'datetime_unique_not_null_column'));

        $columns[4***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
            $this->prophesizeColumnUniqueNotNull('table', 'datetime_pt_br_unique_not_null_column', 'datetime')
        );
        $columns[4***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'datetime_pt_br_unique_not_null_column'));

        //time
        $columns[5***REMOVED*** = new \Gear\Column\Time\Time(
            $this->prophesizeColumnUniqueNotNull('table', 'time_unique_not_null_column', 'time')
        );
        $columns[5***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'time_unique_not_null_column'));

        $columns[6***REMOVED*** = new \Gear\Column\Decimal\Decimal(
            $this->prophesizeColumnUniqueNotNull('table', 'decimal_unique_not_null_column', 'decimal')
        );
        $columns[6***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'decimal_unique_not_null_column'));

        $columns[7***REMOVED*** = new \Gear\Column\Decimal\MoneyPtBr(
            $this->prophesizeColumnUniqueNotNull('table', 'money_pt_br_unique_not_null_column', 'decimal')
        );
        $columns[7***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'money_pt_br_unique_not_null_column'));

        $columns[8***REMOVED*** = new \Gear\Column\Int\Checkbox(
            $this->prophesizeColumnUniqueNotNull('table', 'checkbox_unique_not_null_column', 'int')
        );


        $foreignKey = new \Gear\Column\Int\ForeignKey(
            $this->prophesizeColumnUniqueNotNull('table', 'id_foreign_key_unique_not_null_column', 'int'),
            $this->prophesizeForeignKeyUniqueNotNull('table', 'id_foreign_key_unique_not_null_column', 'FOREIGN KEY', 'foreign_key_unique_not_null_column')
        );



        $schema = $this->prophesize('Gear\Table\TableService\TableService');
        $schema->getReferencedTableValidColumnName('foreign_key_unique_not_null_column')
        ->willReturn('foreign_key_unique_not_null_column');

        $foreignKey->setTableService($schema->reveal());

        $columns[9***REMOVED*** = $foreignKey;
        $columns[9***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'id_foreign_key_unique_not_null_column'));

        $columns[10***REMOVED*** = new \Gear\Column\Int\Int(
            $this->prophesizeColumnUniqueNotNull('table', 'int_unique_not_null_column', 'int')
        );
        $columns[10***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'int_unique_not_null_column'));

        $columns[11***REMOVED*** = new \Gear\Column\Text\Html(
            $this->prophesizeColumnUniqueNotNull('table', 'html_unique_not_null_column', 'text')
        );


        $columns[12***REMOVED*** = new \Gear\Column\Text\Text(
            $this->prophesizeColumnUniqueNotNull('table', 'text_unique_not_null_column', 'text')
        );


        $columns[13***REMOVED*** = new \Gear\Column\Tinyint\Tinyint(
            $this->prophesizeColumnUniqueNotNull('table', 'tinyint_unique_not_null_column', 'tinyint')
        );


        $columns[14***REMOVED*** = new \Gear\Column\Tinyint\Checkbox(
            $this->prophesizeColumnUniqueNotNull('table', 'checkbox_unique_not_null_column', 'tinyint')
        );


        $columns[15***REMOVED*** = new \Gear\Column\Varchar\Email(
            $this->prophesizeColumnUniqueNotNull('table', 'email_unique_not_null_column', 'varchar')
        );
        $columns[15***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'email_unique_not_null_column'));

        $columns[16***REMOVED*** = new \Gear\Column\Varchar\PasswordVerify(
            $this->prophesizeColumnUniqueNotNull('table', 'password_verify_unique_not_null_column', 'varchar')
        );


        $columns[17***REMOVED*** = new \Gear\Column\Varchar\Telephone(
            $this->prophesizeColumnUniqueNotNull('table', 'telephone_unique_not_null_column', 'varchar')
        );
        $columns[17***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'telephone_unique_not_null_column'));

        $columns[18***REMOVED*** = new \Gear\Column\Varchar\UniqueId(
            $this->prophesizeColumnUniqueNotNull('table', 'unique_id_unique_not_null_column', 'varchar')
        );


        $columns[19***REMOVED*** = new \Gear\Column\Varchar\UploadImage(
            $this->prophesizeColumnUniqueNotNull('table', 'upload_image_unique_not_null_column', 'varchar')
        );


        $columns[20***REMOVED*** = new \Gear\Column\Varchar\Url(
            $this->prophesizeColumnUniqueNotNull('table', 'url_unique_not_null_column', 'varchar')
        );
        $columns[20***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'url_unique_not_null_column'));

        $columns[21***REMOVED*** = new \Gear\Column\Varchar\Varchar(
            $this->prophesizeColumnUniqueNotNull('table', 'varchar_unique_not_null_column', 'varchar')
        );
        $columns[21***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_unique_not_null_column'));

        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}