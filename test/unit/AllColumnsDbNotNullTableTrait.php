<?php
namespace GearTest;

trait AllColumnsDbNotNullTableTrait
{

    public function prophesizeColumnNull($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(false);

        return $column->reveal();
    }

    public function prophesizeForeignKeyNull($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
        $foreignKey->getType()->willReturn($foreignType)->shouldBeCalled();
        $foreignKey->getColumns()->willReturn([$columnName***REMOVED***)->shouldBeCalled();

        if ($tableReference !== false) {
            $foreignKey->getReferencedTableName()->willReturn($tableReference);
        }

        return $foreignKey->reveal();
    }

    public function getAllPossibleColumnsNotNull()
    {
        $this->string = new \GearBase\Util\String\StringService();

        $columns = [***REMOVED***;

        $columns[***REMOVED*** = new \Gear\Column\Integer\PrimaryKey(
            $this->prophesizeColumnNull('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKeyNull('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[***REMOVED*** = new \Gear\Column\Date\Date($this->prophesizeColumnNull('table', 'date_column_not_null', 'date'));
        $columns[***REMOVED*** = new \Gear\Column\Date\DatePtBr($this->prophesizeColumnNull('table', 'date_pt_br_column_not_null', 'date'));

        //datetime
        $columns[***REMOVED*** = new \Gear\Column\Datetime\Datetime(
            $this->prophesizeColumnNull('table', 'datetime_column_not_null', 'datetime')
        );
        $columns[***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
            $this->prophesizeColumnNull('table', 'datetime_pt_br_column_not_null', 'datetime')
        );

        //time
        $columns[***REMOVED*** = new \Gear\Column\Time\Time(
            $this->prophesizeColumnNull('table', 'time_column_not_null', 'time')
        );

        $columns[***REMOVED*** = new \Gear\Column\Decimal\Decimal(
            $this->prophesizeColumnNull('table', 'decimal_column_not_null', 'decimal')
        );

        $columns[***REMOVED*** = new \Gear\Column\Decimal\MoneyPtBr(
            $this->prophesizeColumnNull('table', 'money_pt_br_column_not_null', 'decimal')
        );

        $columns[***REMOVED*** = new \Gear\Column\Integer\Checkbox(
            $this->prophesizeColumnNull('table', 'checkbox_column_not_null', 'int')
        );

        $foreignKey = new \Gear\Column\Integer\ForeignKey(
            $this->prophesizeColumnNull('table', 'id_foreign_key_column_not_null', 'int'),
            $this->prophesizeForeignKeyNull('table', 'id_foreign_key_column_not_null', 'FOREIGN KEY', 'foreign_key_column_not_null'),
            'foreign_key_column_not_null'
        );

        $columns[***REMOVED*** = $foreignKey;

        $columns[***REMOVED*** = new \Gear\Column\Integer\Integer(
            $this->prophesizeColumnNull('table', 'int_column_not_null', 'int')
        );

        $columns[***REMOVED*** = new \Gear\Column\Text\Html(
            $this->prophesizeColumnNull('table', 'html_column_not_null', 'text')
        );

        $columns[***REMOVED*** = new \Gear\Column\Text\Text(
            $this->prophesizeColumnNull('table', 'text_column_not_null', 'text')
        );

        $columns[***REMOVED*** = new \Gear\Column\Tinyint\Tinyint(
            $this->prophesizeColumnNull('table', 'tinyint_column_not_null', 'tinyint')
        );

        $columns[***REMOVED*** = new \Gear\Column\Tinyint\Checkbox(
            $this->prophesizeColumnNull('table', 'checkbox_column_not_null', 'tinyint')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Email(
            $this->prophesizeColumnNull('table', 'email_column_not_null', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\PasswordVerify(
            $this->prophesizeColumnNull('table', 'password_verify_column_not_null', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Telephone(
            $this->prophesizeColumnNull('table', 'telephone_column_not_null', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\UniqueId(
            $this->prophesizeColumnNull('table', 'unique_id_column_not_null', 'varchar')
        );

        $uploadImage = new \Gear\Column\Varchar\UploadImage(
            $this->prophesizeColumnNull('table', 'upload_image_column_not_null', 'varchar')
        );

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getModuleName()->willReturn('MyModule');

        $uploadImage->setModule($module->reveal());

        $columns[***REMOVED*** = $uploadImage;


        $columns[***REMOVED*** = new \Gear\Column\Varchar\Url(
            $this->prophesizeColumnNull('table', 'url_column_not_null', 'varchar')
        );



        $varcharColumn = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('varchar_column_not_null');
        $varcharColumn->getTableName()->willReturn('table');
        $varcharColumn->isNullable()->willReturn(false);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $column = new \Gear\Column\Varchar\Varchar($varcharColumn->reveal());
        //$column->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column_not_null'));

        $columns[***REMOVED*** = $column;


        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}