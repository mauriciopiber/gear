<?php
namespace GearTest;

trait AllColumnsDbUniqueTableTrait
{

    public function prophesizeColumnUnique($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function prophesizeForeignKeyUnique($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function prophesizeUnique($tableName, $columnName)
    {
        $unique = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $unique->getType()->willReturn('UNIQUE');//->shouldBeCalled();
        $unique->getColumns()->willReturn([$columnName***REMOVED***);//->shouldBeCalled();
        $unique->getReferencedTableName()->willReturn($tableName);

        return $unique->reveal();
    }

    public function getAllPossibleUniqueColumns()
    {
        $this->string = new \GearBase\Util\String\StringService();

        $columns = [***REMOVED***;

        $columns[0***REMOVED*** = new \Gear\Column\Int\PrimaryKey(
            $this->prophesizeColumnUnique('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKeyUnique('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[1***REMOVED*** = new \Gear\Column\Date\Date($this->prophesizeColumnUnique('table', 'date_unique_column', 'date'));
        $columns[1***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'date_unique_column'));

        $columns[2***REMOVED*** = new \Gear\Column\Date\DatePtBr($this->prophesizeColumnUnique('table', 'date_pt_br_unique_column', 'date'));
        $columns[2***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'date_pt_br_unique_column'));

        //datetime
        $columns[3***REMOVED*** = new \Gear\Column\Datetime\Datetime(
            $this->prophesizeColumnUnique('table', 'datetime_unique_column', 'datetime')
        );
        $columns[3***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'datetime_unique_column'));

        $columns[4***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
            $this->prophesizeColumnUnique('table', 'datetime_pt_br_unique_column', 'datetime')
        );
        $columns[4***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'datetime_pt_br_unique_column'));

        //time
        $columns[5***REMOVED*** = new \Gear\Column\Time\Time(
            $this->prophesizeColumnUnique('table', 'time_unique_column', 'time')
        );
        $columns[5***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'time_unique_column'));

        $columns[6***REMOVED*** = new \Gear\Column\Decimal\Decimal(
            $this->prophesizeColumnUnique('table', 'decimal_unique_column', 'decimal')
        );
        $columns[6***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'decimal_unique_column'));

        $columns[7***REMOVED*** = new \Gear\Column\Decimal\MoneyPtBr(
            $this->prophesizeColumnUnique('table', 'money_pt_br_unique_column', 'decimal')
        );
        $columns[7***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'money_pt_br_unique_column'));

        $columns[8***REMOVED*** = new \Gear\Column\Int\Checkbox(
            $this->prophesizeColumnUnique('table', 'checkbox_unique_column', 'int')
        );


        $foreignKey = new \Gear\Column\Int\ForeignKey(
            $this->prophesizeColumnUnique('table', 'id_foreign_key_unique_column', 'int'),
            $this->prophesizeForeignKeyUnique('table', 'id_foreign_key_unique_column', 'FOREIGN KEY', 'foreign_key_unique_column')
        );



        $schema = $this->prophesize('Gear\Table\TableService\TableService');
        $schema->getReferencedTableValidColumnName('foreign_key_unique_column')
        ->willReturn('foreign_key_unique_column');

        $foreignKey->setTableService($schema->reveal());

        $columns[9***REMOVED*** = $foreignKey;
        $columns[9***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'id_foreign_key_unique_column'));

        $columns[10***REMOVED*** = new \Gear\Column\Int\Int(
            $this->prophesizeColumnUnique('table', 'int_unique_column', 'int')
        );
        $columns[10***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'int_unique_column'));

        $columns[11***REMOVED*** = new \Gear\Column\Text\Html(
            $this->prophesizeColumnUnique('table', 'html_unique_column', 'text')
        );


        $columns[12***REMOVED*** = new \Gear\Column\Text\Text(
            $this->prophesizeColumnUnique('table', 'text_unique_column', 'text')
        );


        $columns[13***REMOVED*** = new \Gear\Column\Tinyint\Tinyint(
            $this->prophesizeColumnUnique('table', 'tinyint_unique_column', 'tinyint')
        );


        $columns[14***REMOVED*** = new \Gear\Column\Tinyint\Checkbox(
            $this->prophesizeColumnUnique('table', 'checkbox_unique_column', 'tinyint')
        );


        $columns[15***REMOVED*** = new \Gear\Column\Varchar\Email(
            $this->prophesizeColumnUnique('table', 'email_unique_column', 'varchar')
        );
        $columns[15***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'email_unique_column'));

        $columns[16***REMOVED*** = new \Gear\Column\Varchar\PasswordVerify(
            $this->prophesizeColumnUnique('table', 'password_verify_unique_column', 'varchar')
        );


        $columns[17***REMOVED*** = new \Gear\Column\Varchar\Telephone(
            $this->prophesizeColumnUnique('table', 'telephone_unique_column', 'varchar')
        );
        $columns[17***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'telephone_unique_column'));

        $columns[18***REMOVED*** = new \Gear\Column\Varchar\UniqueId(
            $this->prophesizeColumnUnique('table', 'unique_id_unique_column', 'varchar')
        );


        $columns[19***REMOVED*** = new \Gear\Column\Varchar\UploadImage(
            $this->prophesizeColumnUnique('table', 'upload_image_unique_column', 'varchar')
        );


        $columns[20***REMOVED*** = new \Gear\Column\Varchar\Url(
            $this->prophesizeColumnUnique('table', 'url_unique_column', 'varchar')
        );
        $columns[20***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'url_unique_column'));

        $varcharColumn = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('varchar_unique_column');
        $varcharColumn->getTableName()->willReturn('table');
        $varcharColumn->isNullable()->willReturn(true);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $column = new \Gear\Column\Varchar\Varchar($varcharColumn->reveal());
        $column->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_unique_column'));

        $columns[***REMOVED*** = $column;

        //$columns[21***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_unique_column'));

        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}