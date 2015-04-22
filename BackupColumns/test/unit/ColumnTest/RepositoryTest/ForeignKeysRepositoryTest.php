<?php
namespace ColumnTest\RepositoryTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Repository
 */
class ForeignKeysRepositoryTest extends \ColumnTest\AbstractTest
{
    protected $foreignKeys;

    public function getForeignKeys()
    {
        if (!isset($this->foreignKeys)) {
            $this->foreignKeys =
                $this->bootstrap->getServiceLocator()->get('Column\Repository\ForeignKeysRepository');
        }
        return $this->foreignKeys;
    }

    /**
     * @group Column
     * @group ForeignKeys
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getForeignKeys()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group Column
     * @group ForeignKeys
     */
    public function testCallUsingServiceLocator()
    {
        $foreignKeys = $this->getForeignKeys();
        $this->assertInstanceOf('Column\Repository\ForeignKeysRepository', $foreignKeys);
    }


    public function testSelectAll()
    {
        $resultSet = $this->getForeignKeys()->selectAll();
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }


    public function testSelectAllWithBasicFilter()
    {
        $resultSet = $this->getForeignKeys()->selectAll(array('likeField' => ''));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }

    public function testSelectAllWithBasicFilterFoundNone()
    {
        $resultSet = $this->getForeignKeys()->selectAll(array('likeField' => 'abcdefAhauhsdfguagdfaf'));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(0, count($resultSet));
    }

    public function testSelectByIdReturnEntity()
    {
        $resultSet = $this->getForeignKeys()->selectById(1);
        $this->assertNotNull($resultSet);
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);

        $this->assertEquals(1, $resultSet->getIdForeignKeys());
    }

    public function testSelectByIdReturnNull()
    {
        $resultSet = $this->getForeignKeys()->selectById(60000);
        $this->assertNull($resultSet);
    }

    public function testDeleteNoExistData()
    {
        $this->mockIdentity();
        $resultSet = $this->getForeignKeys()->delete(6000);
        $this->assertFalse($resultSet);
    }
        
    public function testSelectOneByIdForeignKeys()
    {
        $resultSet = $this->getForeignKeys()->selectOneBy(array('idForeignKeys' => 15));
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);
        $this->assertEquals(15, $resultSet->getIdForeignKeys());
    }
    public function testSelectOneByName()
    {
        $resultSet = $this->getForeignKeys()->selectOneBy(array('name' => '15Name'));
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);
        $this->assertEquals('15Name', $resultSet->getName());
    }
    
    public function testSelectAllOrderByIdForeignKeysASC()
    {
        $resultSet = $this->getForeignKeys()->selectAll(array(), 'idForeignKeys', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01', $data['idForeignKeys'***REMOVED***);
    }
    public function testSelectAllOrderByIdForeignKeysDESC()
    {
        $resultSet = $this->getForeignKeys()->selectAll(array(), 'idForeignKeys', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30', $data['idForeignKeys'***REMOVED***);
    }
    public function testSelectAllOrderByNameASC()
    {
        $resultSet = $this->getForeignKeys()->selectAll(array(), 'name', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01Name', $data['name'***REMOVED***);
    }
    public function testSelectAllOrderByNameDESC()
    {
        $resultSet = $this->getForeignKeys()->selectAll(array(), 'name', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30Name', $data['name'***REMOVED***);
    }

    public function testCreateNewData()
    {
        $this->mockIdentity();
        $data = array(
            'name' => 'insert Name',        );
        $resultSet = $this->getForeignKeys()->insert($data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
            $this->assertEquals('insert Name', $resultSet->getName());        return $resultSet;
    }

    /**
     * @depends testCreateNewData
     */
    public function testUpdateExistData($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'name' => 'update Name',        );

        $resultSet = $this->getForeignKeys()->update($entityToUpdate->getIdForeignKeys(), $data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));
            $this->assertEquals('update Name', $resultSet->getName());        return $resultSet;
    }


    /**
     * @depends testUpdateExistData
     */
    public function testDeleteExistData($entityToDelete)
    {
        $entity = $this->getForeignKeys()->selectById($entityToDelete->getIdForeignKeys());
        $this->mockIdentity();
        $resultSet = $this->getForeignKeys()->delete($entity);
        $this->assertTrue($resultSet);
    }
}
