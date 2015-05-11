<?php
namespace GearTest\ControllerTest;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

/**
 * @group DB
 */
class DbControllerTest extends AbstractConsoleControllerTestCase
{
    const CREATE_TABLE      = 'gear database create table %s';
    const CREATE_COLUMN     = 'gear database create column %s %s';
    const CREATE_PRIMARY    = 'gear database create constraint %s %s %s %s %s %s %s';
    const CREATE_FOREIGN    = 'gear database create constraint %s %s %s %s %s %s %s';

    const DROP_TABLE        = 'gear database drop table %s';
    const DROP_COLUMN       = 'gear database drop column %s %s';
    const DROP_CONSTRAINT   = 'gear database drop constraint %s %s';

    public function testCreateTable()
    {

        $table = 'Piber';

        $this->dispatch(sprintf(self::CREATE_TABLE, $table));

    }

    /**
     * @depends testCreateTable
     */
    public function testCreateColumn($tableName)
    {

        $column = 'id_piber';
        $dataType = 'int';

        $this->dispatch(sprintf(self::CREATE_COLUMN, $tableName, $column, $dataType));


    }

    public function testCreateConstraint()
    {
        $table  = 'Piber';
        $column = 'id_piber';
        $type   = 'PRIMARY KEY';

        $this->dispatch(sprintf(self::CREATE_PRIMARY, $tableName, $column, $dataType));
    }
}
