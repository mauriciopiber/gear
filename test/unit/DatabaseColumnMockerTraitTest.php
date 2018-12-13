<?php
namespace GearTest;

use PHPUnit\Framework\TestCase;
use GearTest\DatabaseColumnsMockerTrait;

class DatabaseColumnMockerTraitTest extends TestCase
{
    use DatabaseColumnsMockerTrait;

    public function testCreateColumns()
    {
        $moduleName = 'MyModule';
        $tableName = 'my_table';

        $columnsData = [
            [
                'name' => 'column_varchar',
                'type' => 'varchar',
                'class' => 'Varchar\Varchar',
                'nullable' => true
            ***REMOVED***,
            [
                'name' => 'column_upload_image',
                'type' => 'varchar',
                'class' => 'Varchar\UploadImage',
                'nullable' => true
            ***REMOVED***
        ***REMOVED***;

        $columns = $this->getColumns($moduleName, $tableName, $columnsData);

        $this->assertCount(count($columnsData), $columns);


        foreach ($columns as $index => $column) {
            $this->assertInstanceOf(sprintf('Gear\Column\%s', $columnsData[$index***REMOVED***['class'***REMOVED***), $column);
            $this->assertEquals($columnsData[$index***REMOVED***['name'***REMOVED***, $column->getColumn()->getName());
        }

    }
}
