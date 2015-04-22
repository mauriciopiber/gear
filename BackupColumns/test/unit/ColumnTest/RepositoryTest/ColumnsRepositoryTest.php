<?php
namespace ColumnTest\RepositoryTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Repository
 */
class ColumnsRepositoryTest extends \ColumnTest\AbstractTest
{
    protected $columns;

    public function getColumns()
    {
        if (!isset($this->columns)) {
            $this->columns =
                $this->bootstrap->getServiceLocator()->get('Column\Repository\ColumnsRepository');
        }
        return $this->columns;
    }

    /**
     * @group Column
     * @group Columns
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getColumns()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group Column
     * @group Columns
     */
    public function testCallUsingServiceLocator()
    {
        $columns = $this->getColumns();
        $this->assertInstanceOf('Column\Repository\ColumnsRepository', $columns);
    }


    public function testSelectAll()
    {
        $resultSet = $this->getColumns()->selectAll();
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }


    public function testSelectAllWithBasicFilter()
    {
        $resultSet = $this->getColumns()->selectAll(array('likeField' => ''));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }

    public function testSelectAllWithBasicFilterFoundNone()
    {
        $resultSet = $this->getColumns()->selectAll(array('likeField' => 'abcdefAhauhsdfguagdfaf'));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(0, count($resultSet));
    }

    public function testSelectByIdReturnEntity()
    {
        $resultSet = $this->getColumns()->selectById(1);
        $this->assertNotNull($resultSet);
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);

        $this->assertEquals(1, $resultSet->getIdColumns());
    }

    public function testSelectByIdReturnNull()
    {
        $resultSet = $this->getColumns()->selectById(60000);
        $this->assertNull($resultSet);
    }

    public function testDeleteNoExistData()
    {
        $this->mockIdentity();
        $resultSet = $this->getColumns()->delete(6000);
        $this->assertFalse($resultSet);
    }
        
    public function testSelectOneByIdColumns()
    {
        $resultSet = $this->getColumns()->selectOneBy(array('idColumns' => 15));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals(15, $resultSet->getIdColumns());
    }
    public function testSelectOneByColumnVarchar()
    {
        $resultSet = $this->getColumns()->selectOneBy(array('columnVarchar' => '15Column Varchar'));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('15Column Varchar', $resultSet->getColumnVarchar());
    }
    public function testSelectOneByColumnText()
    {
        $resultSet = $this->getColumns()->selectOneBy(array('columnText' => '15Column Text'));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('15Column Text', $resultSet->getColumnText());
    }
    public function testSelectOneByColumnVarcharEmail()
    {
        $resultSet = $this->getColumns()->selectOneBy(array('columnVarcharEmail' => 'column.varchar.email15@gmail.com'
));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('column.varchar.email15@gmail.com'
, $resultSet->getColumnVarcharEmail());
    }
    public function testSelectOneByColumnVarcharUploadImage()
    {
        $resultSet = $this->getColumns()->selectOneBy(array('columnVarcharUploadImage' => '15Column Varchar Upload Image'));
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);
        $this->assertEquals('15Column Varchar Upload Image', $resultSet->getColumnVarcharUploadImage());
    }
    
    public function testSelectAllOrderByIdColumnsASC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'idColumns', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01', $data['idColumns'***REMOVED***);
    }
    public function testSelectAllOrderByIdColumnsDESC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'idColumns', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30', $data['idColumns'***REMOVED***);
    }
    public function testSelectAllOrderByColumnVarcharASC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnVarchar', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01Column Varchar', $data['columnVarchar'***REMOVED***);
    }
    public function testSelectAllOrderByColumnVarcharDESC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnVarchar', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30Column Varchar', $data['columnVarchar'***REMOVED***);
    }
    public function testSelectAllOrderByColumnTextASC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnText', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01Column Text', $data['columnText'***REMOVED***);
    }
    public function testSelectAllOrderByColumnTextDESC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnText', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30Column Text', $data['columnText'***REMOVED***);
    }
    public function testSelectAllOrderByColumnVarcharEmailASC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnVarcharEmail', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('column.varchar.email01@gmail.com'
, $data['columnVarcharEmail'***REMOVED***);
    }
    public function testSelectAllOrderByColumnVarcharEmailDESC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnVarcharEmail', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('column.varchar.email30@gmail.com'
, $data['columnVarcharEmail'***REMOVED***);
    }
    public function testSelectAllOrderByColumnVarcharUploadImageASC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnVarcharUploadImage', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01Column Varchar Upload Image', $data['columnVarcharUploadImage'***REMOVED***);
    }
    public function testSelectAllOrderByColumnVarcharUploadImageDESC()
    {
        $resultSet = $this->getColumns()->selectAll(array(), 'columnVarcharUploadImage', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30Column Varchar Upload Image', $data['columnVarcharUploadImage'***REMOVED***);
    }

    public function testCreateNewData()
    {
        $this->mockIdentity();
        $data = array(
            'columnDate' => '2015-04-22',
            'columnDatetime' => '2015-04-22 00:37:39',
            'columnTime' => '00:37:39',
            'columnInt' => 51549,
            'columnTinyint' => 70106,
            'columnDecimal' => 1822.22,
            'columnVarchar' => 'insert Column Varchar',            'columnLongtext' => 'insert Column Longtext',            'columnText' => 'insert Column Text',            'columnDatetimePtBr' => '22/04/2015 00:37:39',
            'columnDatePtBr' => '22/04/2015',
            'columnDecimalPtBr' => 'R$ 1088,88',
            'columnIntCheckbox' => 1,
            'columnTinyintCheckbox' => 1,
            'columnVarcharEmail' => 'insert Column Varchar Email',            'columnVarcharUploadImage' => '/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage363197insert.gif',
            'columnForeignKey' => '1',
        );
        $resultSet = $this->getColumns()->insert($data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
        $this->assertEquals('2015-04-22', $resultSet->getColumnDate()->format('Y-m-d'));
        $this->assertEquals('2015-04-22 00:37:39', $resultSet->getColumnDatetime()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:37:39', $resultSet->getColumnTime()->format('H:i:s'));
        $this->assertEquals(51549, $resultSet->getColumnInt());
        $this->assertEquals(70106, $resultSet->getColumnTinyint());
        $this->assertEquals(1822.22, $resultSet->getColumnDecimal());
            $this->assertEquals('insert Column Varchar', $resultSet->getColumnVarchar());            $this->assertEquals('insert Column Longtext', $resultSet->getColumnLongtext());            $this->assertEquals('insert Column Text', $resultSet->getColumnText());        $this->assertEquals('2015-04-22 00:37:39', $resultSet->getColumnDatetimePtBr()->format('Y-m-d H:i:s'));
        $this->assertEquals('2015-04-22', $resultSet->getColumnDatePtBr()->format('Y-m-d'));
        $this->assertEquals(1088.88, $resultSet->getColumnDecimalPtBr());
        $this->assertEquals(1, $resultSet->getColumnIntCheckbox());
        $this->assertEquals(1, $resultSet->getColumnTinyintCheckbox());
            $this->assertEquals('insert Column Varchar Email', $resultSet->getColumnVarcharEmail());        $this->assertEquals('/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage363197insert.gif', $resultSet->getColumnVarcharUploadImage());
        $this->assertEquals('1', $resultSet->getColumnForeignKey()->getIdForeignKeys());
        return $resultSet;
    }

    /**
     * @depends testCreateNewData
     */
    public function testUpdateExistData($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'columnDate' => '2015-05-22',
            'columnDatetime' => '2015-05-22 00:37:39',
            'columnTime' => '00:37:39',
            'columnInt' => 51599,
            'columnTinyint' => 70156,
            'columnDecimal' => 1822.22,
            'columnVarchar' => 'update Column Varchar',            'columnLongtext' => 'update Column Longtext',            'columnText' => 'update Column Text',            'columnDatetimePtBr' => '22/05/2015 00:37:39',
            'columnDatePtBr' => '22/05/2015',
            'columnDecimalPtBr' => 'R$ 1088,88',
            'columnIntCheckbox' => 1,
            'columnTinyintCheckbox' => 1,
            'columnVarcharEmail' => 'update Column Varchar Email',            'columnVarcharUploadImage' => '/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage363197update.gif',
            'columnForeignKey' => '5',
        );

        $resultSet = $this->getColumns()->update($entityToUpdate->getIdColumns(), $data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\Columns', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));
        $this->assertEquals('2015-05-22', $resultSet->getColumnDate()->format('Y-m-d'));
        $this->assertEquals('2015-05-22 00:37:39', $resultSet->getColumnDatetime()->format('Y-m-d H:i:s'));
        $this->assertEquals('00:37:39', $resultSet->getColumnTime()->format('H:i:s'));
        $this->assertEquals(51599, $resultSet->getColumnInt());
        $this->assertEquals(70156, $resultSet->getColumnTinyint());
        $this->assertEquals(1822.22, $resultSet->getColumnDecimal());
            $this->assertEquals('update Column Varchar', $resultSet->getColumnVarchar());            $this->assertEquals('update Column Longtext', $resultSet->getColumnLongtext());            $this->assertEquals('update Column Text', $resultSet->getColumnText());        $this->assertEquals('2015-05-22 00:37:39', $resultSet->getColumnDatetimePtBr()->format('Y-m-d H:i:s'));
        $this->assertEquals('2015-05-22', $resultSet->getColumnDatePtBr()->format('Y-m-d'));
        $this->assertEquals(1088.88, $resultSet->getColumnDecimalPtBr());
        $this->assertEquals(1, $resultSet->getColumnIntCheckbox());
        $this->assertEquals(1, $resultSet->getColumnTinyintCheckbox());
            $this->assertEquals('update Column Varchar Email', $resultSet->getColumnVarcharEmail());        $this->assertEquals('/public/upload/columns-columnVarcharUploadImage/%scolumnVarcharUploadImage363197update.gif', $resultSet->getColumnVarcharUploadImage());
        $this->assertEquals('5', $resultSet->getColumnForeignKey()->getIdForeignKeys());
        return $resultSet;
    }


    /**
     * @depends testUpdateExistData
     */
    public function testDeleteExistData($entityToDelete)
    {
        $entity = $this->getColumns()->selectById($entityToDelete->getIdColumns());
        $this->mockIdentity();
        $resultSet = $this->getColumns()->delete($entity);
        $this->assertTrue($resultSet);
    }
}
