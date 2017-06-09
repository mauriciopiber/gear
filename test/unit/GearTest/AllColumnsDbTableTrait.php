<?php
namespace GearTest;

use Gear\Column\Varchar\UploadImage;

trait AllColumnsDbTableTrait
{
    public function prophesizeColumn($tableName, $columnName, $columnType)
    {
        $column = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $column->getDataType()->willReturn($columnType)->shouldBeCalled();
        $column->getName()->willReturn($columnName);
        $column->getTableName()->willReturn($tableName);
        $column->isNullable()->willReturn(true);

        return $column->reveal();
    }

    public function prophesizeForeignKey($tableName, $columnName, $foreignType, $tableReference = false)
    {
        $foreignKey = $this->prophesize('Zend\Db\Metadata\Object\ConstraintObject');
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

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getModuleName()->willReturn('MyModule');

        $this->string = new \GearBase\Util\String\StringService();

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

    public function getAllPossibleColumns()
    {
        $this->string = new \GearBase\Util\String\StringService();

        $columns = [***REMOVED***;

        $columns[***REMOVED*** = new \Gear\Column\Integer\PrimaryKey(
            $this->prophesizeColumn('my_controller', 'id_my_controller', 'int'),
            $this->prophesizeForeignKey('my_controller', 'id_my_controller', 'PRIMARY KEY')
        );

        //date
        $columns[***REMOVED*** = new \Gear\Column\Date\Date($this->prophesizeColumn('table', 'date_column', 'date'));
        $columns[***REMOVED*** = new \Gear\Column\Date\DatePtBr($this->prophesizeColumn('table', 'date_pt_br_column', 'date'));

        //datetime
        $columns[***REMOVED*** = new \Gear\Column\Datetime\Datetime(
            $this->prophesizeColumn('table', 'datetime_column', 'datetime')
        );
        $columns[***REMOVED*** = new \Gear\Column\Datetime\DatetimePtBr(
            $this->prophesizeColumn('table', 'datetime_pt_br_column', 'datetime')
        );

        //time
        $columns[***REMOVED*** = new \Gear\Column\Time\Time(
            $this->prophesizeColumn('table', 'time_column', 'time')
        );

        $columns[***REMOVED*** = new \Gear\Column\Decimal\Decimal(
            $this->prophesizeColumn('table', 'decimal_column', 'decimal')
        );

        $columns[***REMOVED*** = new \Gear\Column\Decimal\MoneyPtBr(
            $this->prophesizeColumn('table', 'money_pt_br_column', 'decimal')
        );

        $columns[***REMOVED*** = new \Gear\Column\Integer\Checkbox(
            $this->prophesizeColumn('table', 'checkbox_column', 'int')
        );

        $foreignKey = new \Gear\Column\Integer\ForeignKey(
            $this->prophesizeColumn('table', 'id_foreign_key_column', 'int'),
            $this->prophesizeForeignKey('table', 'id_foreign_key_column', 'FOREIGN KEY', 'foreign_key_column')
        );

        $schema = $this->prophesize('Gear\Table\TableService\TableService');
        $schema->getReferencedTableValidColumnName('foreign_key_column')
        ->willReturn('foreign_key_column');

        $foreignKey->setTableService($schema->reveal());

        $columns[***REMOVED*** = $foreignKey;

        $columns[***REMOVED*** = new \Gear\Column\Integer\Integer(
            $this->prophesizeColumn('table', 'int_column', 'int')
        );

        $columns[***REMOVED*** = new \Gear\Column\Text\Html(
            $this->prophesizeColumn('table', 'html_column', 'text')
        );

        $columns[***REMOVED*** = new \Gear\Column\Text\Text(
            $this->prophesizeColumn('table', 'text_column', 'text')
        );

        $columns[***REMOVED*** = new \Gear\Column\Tinyint\Tinyint(
            $this->prophesizeColumn('table', 'tinyint_column', 'tinyint')
        );

        $columns[***REMOVED*** = new \Gear\Column\Tinyint\Checkbox(
            $this->prophesizeColumn('table', 'checkbox_column', 'tinyint')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Email(
            $this->prophesizeColumn('table', 'email_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\PasswordVerify(
            $this->prophesizeColumn('table', 'password_verify_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Telephone(
            $this->prophesizeColumn('table', 'telephone_column', 'varchar')
        );

        $columns[***REMOVED*** = new \Gear\Column\Varchar\UniqueId(
            $this->prophesizeColumn('table', 'unique_id_column', 'varchar')
        );

        $uploadImage = new \Gear\Column\Varchar\UploadImage(
            $this->prophesizeColumn('table', 'upload_image_column', 'varchar')
        );

        $module = $this->prophesize('Gear\Module\BasicModuleStructure');
        $module->getModuleName()->willReturn('MyModule');

        $uploadImage->setModule($module->reveal());

        $columns[***REMOVED*** = $uploadImage;

        $columns[***REMOVED*** = new \Gear\Column\Varchar\Url(
            $this->prophesizeColumn('table', 'url_column', 'varchar')
        );


        $varcharColumn = $this->prophesize('Zend\Db\Metadata\Object\ColumnObject');
        $varcharColumn->getDataType()->willReturn('varchar')->shouldBeCalled();
        $varcharColumn->getName()->willReturn('varchar_column');
        $varcharColumn->getTableName()->willReturn('table');
        $varcharColumn->isNullable()->willReturn(true);
        $varcharColumn->getCharacterMaximumLength()->willReturn(45);

        $column = new \Gear\Column\Varchar\Varchar($varcharColumn->reveal());
        //$column->setUniqueConstraint($this->prophesizeUnique('table', 'varchar_column'));


        $columns[***REMOVED*** = $column;

        //varchar

        foreach ($columns as $column) {
            $column->setStringService($this->string);
        }

        return $columns;

    }
}