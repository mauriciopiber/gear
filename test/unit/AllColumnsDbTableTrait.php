<?php
namespace GearTest;

use Gear\Column\Varchar\UploadImage;
use Gear\Util\String\StringService;
use Gear\Column\Varchar\Varchar;
use Gear\Column\Varchar\Url;
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
use Gear\Module\Structure\ModuleStructure;

trait AllColumnsDbTableTrait
{
    public function prophesizeColumn($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize(ColumnObject::class);
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function prophesizeForeignKey($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize(ConstraintObject::class);
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function getUploadImageColumns($tableName)
    {
        $columns = [***REMOVED***;

        $module = $this->prophesize(ModuleStructure::class);
        $module->getModuleName()->willReturn('MyModule');

        $this->string = new StringService();

        foreach (['my_image_one', 'my_image_two'***REMOVED*** as $columnName) {
            $uploadImage = new UploadImage(
                $this->prophesizeColumn($tableName, $columnName, 'varchar')
            );
            $uploadImage->setModule($module->reveal());
            $uploadImage->setStringService($this->string);
            $columns[***REMOVED*** = $uploadImage;
        }


        return $columns;
    }

    public function getAllPossibleColumns($tableName = 'table')
    {
        $module = $this->prophesize(ModuleStructure::class);
        $module->getModuleName()->willReturn('MyModule');

        $this->string = new StringService();

        $columns = [***REMOVED***;

        $columns[***REMOVED*** = new PrimaryKey(
            $this->prophesizeColumn('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKey('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[***REMOVED*** = new Date($this->prophesizeColumn('table', 'date_column', 'date'));
        $columns[***REMOVED*** = new DatePtBr($this->prophesizeColumn('table', 'date_pt_br_column', 'date'));

        //datetime
        $columns[***REMOVED*** = new Datetime(
            $this->prophesizeColumn($tableName, 'datetime_column', 'datetime')
        );
        $columns[***REMOVED*** = new DatetimePtBr(
            $this->prophesizeColumn($tableName, 'datetime_pt_br_column', 'datetime')
        );

        //time
        $columns[***REMOVED*** = new Time(
            $this->prophesizeColumn($tableName, 'time_column', 'time')
        );

        $columns[***REMOVED*** = new Decimal(
            $this->prophesizeColumn($tableName, 'decimal_column', 'decimal')
        );

        $columns[***REMOVED*** = new MoneyPtBr(
            $this->prophesizeColumn($tableName, 'money_pt_br_column', 'decimal')
        );

        $columns[***REMOVED*** = new IntegerCheckbox(
            $this->prophesizeColumn($tableName, 'checkbox_column', 'int')
        );

        $foreignKey = new ForeignKey(
            $this->prophesizeColumn($tableName, 'id_foreign_key_column', 'int'),
            $this->prophesizeForeignKey($tableName, 'id_foreign_key_column', 'FOREIGN KEY', 'foreign_key_column'),
            'foreign_key_column'
        );

        $foreignKey->setModule($module->reveal());

        $columns[***REMOVED*** = $foreignKey;

        $columns[***REMOVED*** = new Integer(
            $this->prophesizeColumn($tableName, 'int_column', 'int')
        );

        $columns[***REMOVED*** = new Html(
            $this->prophesizeColumn($tableName, 'html_column', 'text')
        );

        $columns[***REMOVED*** = new Text(
            $this->prophesizeColumn($tableName, 'text_column', 'text')
        );

        $columns[***REMOVED*** = new Tinyint(
            $this->prophesizeColumn($tableName, 'tinyint_column', 'tinyint')
        );

        $columns[***REMOVED*** = new TinyintCheckbox(
            $this->prophesizeColumn($tableName, 'checkbox_column', 'tinyint')
        );

        $columns[***REMOVED*** = new Email(
            $this->prophesizeColumn($tableName, 'email_column', 'varchar')
        );

        $columns[***REMOVED*** = new PasswordVerify(
            $this->prophesizeColumn($tableName, 'password_verify_column', 'varchar')
        );

        $columns[***REMOVED*** = new Telephone(
            $this->prophesizeColumn($tableName, 'telephone_column', 'varchar')
        );

        $columns[***REMOVED*** = new UniqueId(
            $this->prophesizeColumn($tableName, 'unique_id_column', 'varchar')
        );

        $uploadImage = new UploadImage(
            $this->prophesizeColumn($tableName, 'upload_image_column', 'varchar')
        );

        $uploadImage->setModule($module->reveal());

        $columns[***REMOVED*** = $uploadImage;

        $columns[***REMOVED*** = new Url(
            $this->prophesizeColumn($tableName, 'url_column', 'varchar')
        );


        $varcharColumn = $this->prophesize(ColumnObject::class);
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('varchar_column');
        $varcharColumn->getTableName()->willReturn($tableName);
        $varcharColumn->isNullable()->willReturn(true);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $column = new Varchar($varcharColumn->reveal());
        //$column->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column'));


        $columns[***REMOVED*** = $column;

        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}
