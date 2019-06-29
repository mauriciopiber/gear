<?php
namespace GearTest;

use Gear\Module\Structure\ModuleStructure;
use Gear\Util\String\StringService;
use Gear\Column\Varchar\Varchar;
use Gear\Column\Varchar\Url;
use Gear\Column\Varchar\UploadImage;
use Gear\Column\Varchar\UniqueId;
use Gear\Column\Varchar\Telephone;
use Gear\Column\Varchar\PasswordVerify;
use Gear\Column\Varchar\Email;
use Gear\Column\Tinyint\Tinyint;
use Gear\Column\Tinyint\Checkbox as TinyintCheckbox;
use Gear\Column\Time\Time;
use Gear\Column\Text\Text;
use Gear\Column\Text\Html;
use Gear\Column\Integer\PrimaryKey;
use Gear\Column\Integer\Integer;
use Gear\Column\Integer\ForeignKey;
use Gear\Column\Integer\Checkbox as IntegerCheckbox;
use Gear\Column\Decimal\MoneyPtBr;
use Gear\Column\Decimal\Decimal;
use Gear\Column\Datetime\DatetimePtBr;
use Gear\Column\Datetime\Datetime;
use Gear\Column\Date\DatePtBr;
use Gear\Column\Date\Date;
use Zend\Db\Metadata\Object\ConstraintObject;
use Zend\Db\Metadata\Object\ColumnObject;
trait AllColumnsDbUniqueNotNullTableTrait
{

    public function prophesizeColumnUniqueNotNull($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(false);


        return $column->reveal();
    }

    public function prophesizeForeignKeyUniqueNotNull($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize(ConstraintObject::class);
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function prophesizeUniqueNotNull($tableName, $columnName)
    {
        $unique = $this->prophesize(ConstraintObject::class);
        $unique->getType()->willReturn('UNIQUE');//->shouldBeCalled();
        $unique->getColumns()->willReturn([$columnName***REMOVED***);//->shouldBeCalled();
        $unique->getReferencedTableName()->willReturn($tableName);

        return $unique->reveal();
    }

    public function getAllPossibleColumnsUniqueNotNull()
    {
        $this->string = new StringService();

        $columns = [***REMOVED***;

        $columns[0***REMOVED*** = new PrimaryKey(
            $this->prophesizeColumnUniqueNotNull('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKeyUniqueNotNull('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[1***REMOVED*** = new Date($this->prophesizeColumnUniqueNotNull('table', 'date_column_unique_not_null', 'date'));
        $columns[1***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'date_column_unique_not_null'));

        $columns[2***REMOVED*** = new DatePtBr($this->prophesizeColumnUniqueNotNull('table', 'date_pt_br_column_unique_not_null', 'date'));
        $columns[2***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'date_pt_br_column_unique_not_null'));

        //datetime
        $columns[3***REMOVED*** = new Datetime(
            $this->prophesizeColumnUniqueNotNull('table', 'datetime_column_unique_not_null', 'datetime')
        );
        $columns[3***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'datetime_column_unique_not_null'));

        $columns[4***REMOVED*** = new DatetimePtBr(
            $this->prophesizeColumnUniqueNotNull('table', 'datetime_pt_br_column_unique_not_null', 'datetime')
        );
        $columns[4***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'datetime_pt_br_column_unique_not_null'));

        //time
        $columns[5***REMOVED*** = new Time(
            $this->prophesizeColumnUniqueNotNull('table', 'time_column_unique_not_null', 'time')
        );
        $columns[5***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'time_column_unique_not_null'));

        $columns[6***REMOVED*** = new Decimal(
            $this->prophesizeColumnUniqueNotNull('table', 'decimal_column_unique_not_null', 'decimal')
        );
        $columns[6***REMOVED***->setUniqueConstraint($this->prophesizeUniqueNotNull('table', 'decimal_column_unique_not_null'));

        $columns[7***REMOVED*** = new MoneyPtBr(
            $this->prophesizeColumnUniqueNotNull('table', 'money_pt_br_column_unique_not_null', 'decimal')
        );
        $columns[7***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'money_pt_br_column_unique_not_null'));

        $columns[8***REMOVED*** = new IntegerCheckbox(
            $this->prophesizeColumnUniqueNotNull('table', 'checkbox_column_unique_not_null', 'int')
        );


        $foreignKey = new ForeignKey(
            $this->prophesizeColumnUniqueNotNull('table', 'id_foreign_key_column_unique_not_null', 'int'),
            $this->prophesizeForeignKeyUniqueNotNull('table', 'id_foreign_key_column_unique_not_null', 'FOREIGN KEY', 'foreign_key_column_unique_not_null'),
            'foreign_key_column_unique_not_null'
        );

        $columns[9***REMOVED*** = $foreignKey;
        $columns[9***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'id_foreign_key_column_unique_not_null'));

        $columns[10***REMOVED*** = new Integer(
            $this->prophesizeColumnUniqueNotNull('table', 'int_column_unique_not_null', 'int')
        );
        $columns[10***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'int_column_unique_not_null'));

        $columns[11***REMOVED*** = new Html(
            $this->prophesizeColumnUniqueNotNull('table', 'html_column_unique_not_null', 'text')
        );


        $columns[12***REMOVED*** = new Text(
            $this->prophesizeColumnUniqueNotNull('table', 'text_column_unique_not_null', 'text')
        );


        $columns[13***REMOVED*** = new Tinyint(
            $this->prophesizeColumnUniqueNotNull('table', 'tinyint_column_unique_not_null', 'tinyint')
        );


        $columns[14***REMOVED*** = new TinyintCheckbox(
            $this->prophesizeColumnUniqueNotNull('table', 'checkbox_column_unique_not_null', 'tinyint')
        );


        $columns[15***REMOVED*** = new Email(
            $this->prophesizeColumnUniqueNotNull('table', 'email_column_unique_not_null', 'varchar')
        );
        $columns[15***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'email_column_unique_not_null'));

        $columns[16***REMOVED*** = new PasswordVerify(
            $this->prophesizeColumnUniqueNotNull('table', 'password_verify_column_unique_not_null', 'varchar')
        );


        $columns[17***REMOVED*** = new Telephone(
            $this->prophesizeColumnUniqueNotNull('table', 'telephone_column_unique_not_null', 'varchar')
        );
        $columns[17***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'telephone_column_unique_not_null'));

        $columns[18***REMOVED*** = new UniqueId(
            $this->prophesizeColumnUniqueNotNull('table', 'unique_id_column_unique_not_null', 'varchar')
        );

        $columns[19***REMOVED*** = new UploadImage(
            $this->prophesizeColumnUniqueNotNull('table', 'upload_image_column_unique_not_null', 'varchar')
        );

        $module = $this->prophesize(ModuleStructure::class);
        $module->getModuleName()->willReturn('MyModule');

        $columns[19***REMOVED***->setModule($module->reveal());


        $columns[20***REMOVED*** = new Url(
            $this->prophesizeColumnUniqueNotNull('table', 'url_column_unique_not_null', 'varchar')
        );
        $columns[20***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'url_column_unique_not_null'));


        $varcharColumn = $this->prophesize(ColumnObject::class);
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('varchar_column_unique_not_null');
        $varcharColumn->getTableName()->willReturn('table');
        $varcharColumn->isNullable()->willReturn(false);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $columns[21***REMOVED*** = new Varchar($varcharColumn->reveal());
        $columns[21***REMOVED***->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column_unique_not_null'));

        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}
