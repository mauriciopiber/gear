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

trait AllColumnsDbNotNullTableTrait
{

    public function prophesizeColumnNull($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(false);

        return $column->reveal();
    }

    public function prophesizeForeignKeyNull($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize(ConstraintObject::class);
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function getAllPossibleColumnsNotNull()
    {
        $this->string = new StringService();

        $columns = [***REMOVED***;

        $columns[***REMOVED*** = new PrimaryKey(
            $this->prophesizeColumnNull('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKeyNull('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[***REMOVED*** = new Date($this->prophesizeColumnNull('table', 'date_column_not_null', 'date'));
        $columns[***REMOVED*** = new DatePtBr($this->prophesizeColumnNull('table', 'date_pt_br_column_not_null', 'date'));

        //datetime
        $columns[***REMOVED*** = new Datetime(
            $this->prophesizeColumnNull('table', 'datetime_column_not_null', 'datetime')
        );
        $columns[***REMOVED*** = new DatetimePtBr(
            $this->prophesizeColumnNull('table', 'datetime_pt_br_column_not_null', 'datetime')
        );

        //time
        $columns[***REMOVED*** = new Time(
            $this->prophesizeColumnNull('table', 'time_column_not_null', 'time')
        );

        $columns[***REMOVED*** = new Decimal(
            $this->prophesizeColumnNull('table', 'decimal_column_not_null', 'decimal')
        );

        $columns[***REMOVED*** = new MoneyPtBr(
            $this->prophesizeColumnNull('table', 'money_pt_br_column_not_null', 'decimal')
        );

        $columns[***REMOVED*** = new IntegerCheckbox(
            $this->prophesizeColumnNull('table', 'checkbox_column_not_null', 'int')
        );

        $foreignKey = new ForeignKey(
            $this->prophesizeColumnNull('table', 'id_foreign_key_column_not_null', 'int'),
            $this->prophesizeForeignKeyNull('table', 'id_foreign_key_column_not_null', 'FOREIGN KEY', 'foreign_key_column_not_null'),
            'foreign_key_column_not_null'
        );

        $columns[***REMOVED*** = $foreignKey;

        $columns[***REMOVED*** = new Integer(
            $this->prophesizeColumnNull('table', 'int_column_not_null', 'int')
        );

        $columns[***REMOVED*** = new Html(
            $this->prophesizeColumnNull('table', 'html_column_not_null', 'text')
        );

        $columns[***REMOVED*** = new Text(
            $this->prophesizeColumnNull('table', 'text_column_not_null', 'text')
        );

        $columns[***REMOVED*** = new Tinyint(
            $this->prophesizeColumnNull('table', 'tinyint_column_not_null', 'tinyint')
        );

        $columns[***REMOVED*** = new TinyintCheckbox(
            $this->prophesizeColumnNull('table', 'checkbox_column_not_null', 'tinyint')
        );

        $columns[***REMOVED*** = new Email(
            $this->prophesizeColumnNull('table', 'email_column_not_null', 'varchar')
        );

        $columns[***REMOVED*** = new PasswordVerify(
            $this->prophesizeColumnNull('table', 'password_verify_column_not_null', 'varchar')
        );

        $columns[***REMOVED*** = new Telephone(
            $this->prophesizeColumnNull('table', 'telephone_column_not_null', 'varchar')
        );

        $columns[***REMOVED*** = new UniqueId(
            $this->prophesizeColumnNull('table', 'unique_id_column_not_null', 'varchar')
        );

        $uploadImage = new UploadImage(
            $this->prophesizeColumnNull('table', 'upload_image_column_not_null', 'varchar')
        );

        $module = $this->prophesize(ModuleStructure::class);
        $module->getModuleName()->willReturn('MyModule');

        $uploadImage->setModule($module->reveal());

        $columns[***REMOVED*** = $uploadImage;


        $columns[***REMOVED*** = new Url(
            $this->prophesizeColumnNull('table', 'url_column_not_null', 'varchar')
        );



        $varcharColumn = $this->prophesize(ColumnObject::class);
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('varchar_column_not_null');
        $varcharColumn->getTableName()->willReturn('table');
        $varcharColumn->isNullable()->willReturn(false);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $column = new Varchar($varcharColumn->reveal());
        //$column->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column_not_null'));

        $columns[***REMOVED*** = $column;


        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}
