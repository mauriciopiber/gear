<?php
namespace GearTest;

use Gear\Module\Structure\ModuleStructure;
use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
trait AllColumnsDbUniqueTableTrait
{

    public function prophesizeColumnUnique($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function prophesizeForeignKeyUnique($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize(ConstraintObject::class);
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function prophesizeUnique($tableName, $columnName)
    {
        $unique = $this->prophesize(ConstraintObject::class);
        $unique->getType()->willReturn('UNIQUE');//->shouldBeCalled();
        $unique->getColumns()->willReturn([$columnName***REMOVED***);//->shouldBeCalled();
        $unique->getReferencedTableName()->willReturn($tableName);

        return $unique->reveal();
    }

    public function getAllPossibleColumnsUnique()
    {
        $this->string = new \Gear\Util\String\StringService();

        $columns = [***REMOVED***;

        $columns[0***REMOVED*** = new \Gear\Column\Integer\PrimaryKey(
            $this->prophesizeColumnUnique('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKeyUnique('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[1***REMOVED*** = new \Gear\Column\Date\Date($this->prophesizeColumnUnique('table', 'date_column_unique', 'date'));
        $columns[1***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'date_column_unique'));

        $columns[2***REMOVED*** = new \Gear\Column\Date\DatePtBr($this->prophesizeColumnUnique('table', 'date_pt_br_column_unique', 'date'));
        $columns[2***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'date_pt_br_column_unique'));

        //datetime
        $columns[3***REMOVED*** = new \Gear\Column\Datetime\Datetime(
            $this->prophesizeColumnUnique('table', 'datetime_column_unique', 'datetime')
        );
        $columns[3***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'datetime_column_unique'));

        $columns[4***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
            $this->prophesizeColumnUnique('table', 'datetime_pt_br_column_unique', 'datetime')
        );
        $columns[4***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'datetime_pt_br_column_unique'));

        //time
        $columns[5***REMOVED*** = new \Gear\Column\Time\Time(
            $this->prophesizeColumnUnique('table', 'time_column_unique', 'time')
        );
        $columns[5***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'time_column_unique'));

        $columns[6***REMOVED*** = new \Gear\Column\Decimal\Decimal(
            $this->prophesizeColumnUnique('table', 'decimal_column_unique', 'decimal')
        );
        $columns[6***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'decimal_column_unique'));

        $columns[7***REMOVED*** = new \Gear\Column\Decimal\MoneyPtBr(
            $this->prophesizeColumnUnique('table', 'money_pt_br_column_unique', 'decimal')
        );
        $columns[7***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'money_pt_br_column_unique'));

        $columns[8***REMOVED*** = new \Gear\Column\Integer\Checkbox(
            $this->prophesizeColumnUnique('table', 'checkbox_column_unique', 'int')
        );


        $foreignKey = new \Gear\Column\Integer\ForeignKey(
            $this->prophesizeColumnUnique('table', 'id_foreign_key_column_unique', 'int'),
            $this->prophesizeForeignKeyUnique('table', 'id_foreign_key_column_unique', 'FOREIGN KEY', 'foreign_key_column_unique'),
            'foreign_key_column_unique'
        );

        $columns[9***REMOVED*** = $foreignKey;
        $columns[9***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'id_foreign_key_column_unique'));

        $columns[10***REMOVED*** = new \Gear\Column\Integer\Integer(
            $this->prophesizeColumnUnique('table', 'int_column_unique', 'int')
        );
        $columns[10***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'int_column_unique'));

        $columns[11***REMOVED*** = new \Gear\Column\Text\Html(
            $this->prophesizeColumnUnique('table', 'html_column_unique', 'text')
        );


        $columns[12***REMOVED*** = new \Gear\Column\Text\Text(
            $this->prophesizeColumnUnique('table', 'text_column_unique', 'text')
        );


        $columns[13***REMOVED*** = new \Gear\Column\Tinyint\Tinyint(
            $this->prophesizeColumnUnique('table', 'tinyint_column_unique', 'tinyint')
        );


        $columns[14***REMOVED*** = new \Gear\Column\Tinyint\Checkbox(
            $this->prophesizeColumnUnique('table', 'checkbox_column_unique', 'tinyint')
        );


        $columns[15***REMOVED*** = new \Gear\Column\Varchar\Email(
            $this->prophesizeColumnUnique('table', 'email_column_unique', 'varchar')
        );
        $columns[15***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'email_column_unique'));

        $columns[16***REMOVED*** = new \Gear\Column\Varchar\PasswordVerify(
            $this->prophesizeColumnUnique('table', 'password_verify_column_unique', 'varchar')
        );


        $columns[17***REMOVED*** = new \Gear\Column\Varchar\Telephone(
            $this->prophesizeColumnUnique('table', 'telephone_column_unique', 'varchar')
        );
        $columns[17***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'telephone_column_unique'));

        $columns[18***REMOVED*** = new \Gear\Column\Varchar\UniqueId(
            $this->prophesizeColumnUnique('table', 'unique_id_column_unique', 'varchar')
        );

        $columns[19***REMOVED*** = new \Gear\Column\Varchar\UploadImage(
            $this->prophesizeColumnUnique('table', 'upload_image_column_unique', 'varchar')
        );

        $module = $this->prophesize(ModuleStructure::class);

        $module->getModuleName()->willReturn('MyModule');

        $columns[19***REMOVED***->setModule($module->reveal());


        $columns[20***REMOVED*** = new \Gear\Column\Varchar\Url(
            $this->prophesizeColumnUnique('table', 'url_column_unique', 'varchar')
        );
        $columns[20***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'url_column_unique'));

        $varcharColumn = $this->prophesize(ColumnObject::class);
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('varchar_column_unique');
        $varcharColumn->getTableName()->willReturn('table');
        $varcharColumn->isNullable()->willReturn(true);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $column = new \Gear\Column\Varchar\Varchar($varcharColumn->reveal());
        $column->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column_unique'));

        $columns[***REMOVED*** = $column;

        //$columns[21***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column_unique'));

        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}