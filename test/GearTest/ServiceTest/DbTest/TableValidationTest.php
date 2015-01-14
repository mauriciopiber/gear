<?php
namespace Gear\ServiceTest;

use GearTest\AbstractGearTest;

class TableValidationTest extends AbstractGearTest
{

    /**
     * @group Table
     */
    public function testMyDick()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
            ->disableOriginalConstructor()
            ->getMock();

        $mockTable->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('Testing'));

        $mockTable->expects($this->any())
            ->method('getColumns')
            ->will($this->returnValue($this->getColumns()));

        $this->assertEquals('Testing', $mockTable->getName());
        $this->assertEquals(1, count($mockTable->getColumns()));
    }

    /**
     * @group UpdatedBy
     */
    public function testUpdatedByNotFound()
    {
        $mockTable = $this->getTable();
        $validation = new \Gear\Service\Db\TableValidation($mockTable);
        $this->assertEquals('not found' , $validation->getUpdatedBy());
    }

    /**
     * @group CreatedBy
     */
    public function testCreatedByNotFound()
    {
        $mockTable = $this->getTable();
        $validation = new \Gear\Service\Db\TableValidation($mockTable);
        $this->assertEquals('not found' , $validation->getCreatedBy());
    }

    /**
     * @group UpdatedBy
     */
    public function testUpdatedByWithoutForeignKey()
    {
        $mockTable = $this->getTable();

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockUpdatedBy()
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('missing foreign key;' , $validation->getUpdatedBy());
    }

    /**
     * @group CreatedBy
     */
    public function testCreatedByWithoutForeignKey()
    {
        $mockTable = $this->getTable();

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockCreatedBy()
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('missing foreign key;' , $validation->getCreatedBy());
    }

    /**
     * @group UpdatedBy
     */
    public function testUpdatedByWrongUpdateRule()
    {
        $mockTable = $this->getTable();

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockUpdatedBy()
                )
            )
        );

        $mockTable->expects($this->any())
        ->method('getConstraints')
        ->will(
            $this->returnValue(
                array(
                    $this->mockForeignKeyConstraint('testing_1', array('updated_by'), 'user', array('id_user'), 'NO ACTION', 'CASCADE')
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('wrong update rule;' , $validation->getUpdatedBy());
    }

    /**
     * @group CreatedBy
     */
    public function testCreatedByWrongUpdateRule()
    {
        $mockTable = $this->getTable();

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockCreatedBy()
                )
            )
        );

        $mockTable->expects($this->any())
        ->method('getConstraints')
        ->will(
            $this->returnValue(
                array(
                    $this->mockForeignKeyConstraint('testing_1', array('created_by'), 'user', array('id_user'), 'NO ACTION', 'CASCADE')
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('wrong update rule;' , $validation->getCreatedBy());
    }

    /**
     * @group UpdatedBy
     */
    public function testUpdatedByWrongDeleteRule()
    {
        $mockTable = $this->getTable();

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockUpdatedBy()
                )
            )
        );

        $mockTable->expects($this->any())
        ->method('getConstraints')
        ->will(
            $this->returnValue(
                array(
                    $this->mockForeignKeyConstraint('testing_1', array('updated_by'), 'user', array('id_user'), 'CASCADE' , 'NO ACTION')
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('wrong delete rule;' , $validation->getUpdatedBy());
    }

    /**
     * @group CreatedBy
     */
    public function testCreatedByWrongDeleteRule()
    {
        $mockTable = $this->getTable();

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockCreatedBy()
                )
            )
        );

        $mockTable->expects($this->any())
        ->method('getConstraints')
        ->will(
            $this->returnValue(
                array(
                    $this->mockForeignKeyConstraint('testing_1', array('created_by'), 'user', array('id_user'), 'CASCADE' , 'NO ACTION')
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('wrong delete rule;' , $validation->getCreatedBy());
    }


    public function getTable()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('Testing'));

        return $mockTable;
    }

    /**
     * @group UpdatedBy
     */
    public function testUpdatedBy()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('Testing'));

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockUpdatedBy()
                )
            )
        );


        $mockTable->expects($this->any())
        ->method('getConstraints')
        ->will(
            $this->returnValue(
                array(
                    $this->mockForeignKeyConstraint('testing_1', array('updated_by'), 'user', array('id_user'), 'CASCADE', 'CASCADE')
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('ok' , $validation->getUpdatedBy());
    }

    /**
     * @group CreatedBy
     */
    public function testCreatedBy()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('Testing'));

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockCreatedBy()
                )
            )
        );


        $mockTable->expects($this->any())
        ->method('getConstraints')
        ->will(
            $this->returnValue(
                array(
                    $this->mockForeignKeyConstraint('testing_1', array('created_by'), 'user', array('id_user'), 'CASCADE', 'CASCADE')
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('ok' , $validation->getCreatedBy());
    }

    /**
     * @group Table
     */
    public function testUserRoleLinker()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('user_role_linker'));

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('ok' , $validation->getCreatedBy());
        $this->assertEquals('ok' , $validation->getUpdatedBy());
        $this->assertEquals('ok' , $validation->getUpdated());
        $this->assertEquals('ok' , $validation->getCreated());
    }

    /**
     * @group Table
     */
    public function testOk()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('Testing'));

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockCreatedBy(),
                    $this->getMockUpdatedBy(),
                    $this->getMockCreated(),
                    $this->getMockUpdated()
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('ok' , $validation->getCreatedBy());
        $this->assertEquals('ok' , $validation->getUpdatedBy());
        $this->assertEquals('ok' , $validation->getUpdated());
        $this->assertEquals('ok' , $validation->getCreated());
    }

    /**
     * @group Table
     */
    public function testFixWhenCreatedByIsNull()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('Testing'));

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockCreatedByNull(),
                    $this->getMockUpdatedBy(),
                    $this->getMockCreated(),
                    $this->getMockUpdated()
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('fix' , $validation->getCreatedBy());
        $this->assertEquals('ok' , $validation->getUpdatedBy());
        $this->assertEquals('ok' , $validation->getUpdated());
        $this->assertEquals('ok' , $validation->getCreated());
    }

    /**
     * @group Table
     */
    public function testFixWhenUpdatedByIsNotNull()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('Testing'));

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                    $this->getMockCreatedBy(),
                    $this->getMockUpdatedByNotNull(),
                    $this->getMockCreated(),
                    $this->getMockUpdated()
                )
            )
        );

        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('ok' , $validation->getCreatedBy());
        $this->assertEquals('fix nullable to null;' , $validation->getUpdatedBy());
        $this->assertEquals('ok' , $validation->getUpdated());
        $this->assertEquals('ok' , $validation->getCreated());
    }

    /**
     * @group Table
     */
    public function testFixAllColumns()
    {
        $mockTable = $this->getMockBuilder('Zend\Db\Metadata\Object\TableObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockTable->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('Testing'));

        $mockTable->expects($this->any())
        ->method('getColumns')
        ->will(
            $this->returnValue(
                array(
                )
            )
        );


        $validation = new \Gear\Service\Db\TableValidation($mockTable);

        $this->assertEquals('not found' , $validation->getCreatedBy());
        $this->assertEquals('not found' , $validation->getUpdatedBy());
        $this->assertEquals('not found' , $validation->getUpdated());
        $this->assertEquals('not found' , $validation->getCreated());
    }

    //tabela padrão

    //created e updated --- devem ser datetime
    //created deve ser not null.
    //updated deve ser null.


    //substituir created e updated por created_at e updated_at


    //created_by
    //deve ser int, com foreign key para a tabela usuário.
    //deve ser not null, a foreign key deve ser CASCADE e CASCADE respectivamente.

    //updated_by
    //deve ser int, com foreign key para a tabela usuário.
    //deve ser null, a foreign key deve ser CASCADE e CASCADE respectivamente.

    //tabela user

    //tabela user role linker

    public function getMockCreated()
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('created'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('Testing'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(false));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue('datetime'));

        return $mockColumns;
    }

    public function mockForeignKeyConstraint($name, $columns, $referencedTable, $referencedColumns, $updateRule, $deleteRule)
    {


        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ConstraintObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue($name));

        $mockColumns->expects($this->any())
        ->method('getType')
        ->will($this->returnValue('FOREIGN KEY'));

        $mockColumns->expects($this->any())
        ->method('getColumns')
        ->will($this->returnValue($columns));

        $mockColumns->expects($this->any())
        ->method('getReferencedTableName')
        ->will($this->returnValue($referencedTable));

        $mockColumns->expects($this->any())
        ->method('getReferencedColumns')
        ->will($this->returnValue($referencedColumns));

        $mockColumns->expects($this->any())
        ->method('getUpdateRule')
        ->will($this->returnValue($updateRule));

        $mockColumns->expects($this->any())
        ->method('getDeleteRule')
        ->will($this->returnValue($deleteRule));

        return $mockColumns;
    }

    public function getMockCreatedBy()
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('created_by'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('Testing'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(false));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue('int'));

        return $mockColumns;
    }

    public function getMockCreatedByNull()
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('created_by'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('Testing'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(true));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue('int'));

        return $mockColumns;
    }

    public function getMockUpdatedBy()
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('updated_by'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('Testing'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(true));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue('int'));

        return $mockColumns;
    }

    public function getMockUpdatedByNotNull()
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('updated_by'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('Testing'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(false));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue('int'));

        return $mockColumns;
    }

    public function getMockUpdated()
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
        ->disableOriginalConstructor()
        ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('updated'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('Testing'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(true));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue('datetime'));

        return $mockColumns;
    }



    public function getColumns()
    {
        $mockColumns = $this->getMockBuilder('Zend\Db\Metadata\Object\ColumnObject')
            ->disableOriginalConstructor()
            ->getMock();

        $mockColumns->expects($this->any())
        ->method('getName')
        ->will($this->returnValue('id_teste'));

        $mockColumns->expects($this->any())
        ->method('getTableName')
        ->will($this->returnValue('estado'));

        $mockColumns->expects($this->any())
        ->method('isNullable')
        ->will($this->returnValue(false));

        $mockColumns->expects($this->any())
        ->method('getDataType')
        ->will($this->returnValue('int'));


        return array($mockColumns);


    }
}
