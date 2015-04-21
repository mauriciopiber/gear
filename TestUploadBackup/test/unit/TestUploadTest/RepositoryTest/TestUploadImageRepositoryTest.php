<?php
namespace TestUploadTest\RepositoryTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Repository
 */
class TestUploadImageRepositoryTest extends \TestUploadTest\AbstractTest
{
    protected $testUploadImage;

    public function getTestUploadImage()
    {
        if (!isset($this->testUploadImage)) {
            $this->testUploadImage =
                $this->bootstrap->getServiceLocator()->get('TestUpload\Repository\TestUploadImageRepository');
        }
        return $this->testUploadImage;
    }

    /**
     * @group TestUpload
     * @group TestUploadImage
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTestUploadImage()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group TestUpload
     * @group TestUploadImage
     */
    public function testCallUsingServiceLocator()
    {
        $testUploadImage = $this->getTestUploadImage();
        $this->assertInstanceOf('TestUpload\Repository\TestUploadImageRepository', $testUploadImage);
    }


    public function testSelectAll()
    {
        $resultSet = $this->getTestUploadImage()->selectAll();
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }


    public function testSelectAllWithBasicFilter()
    {
        $resultSet = $this->getTestUploadImage()->selectAll(array('likeField' => ''));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
    }

    public function testSelectAllWithBasicFilterFoundNone()
    {
        $resultSet = $this->getTestUploadImage()->selectAll(array('likeField' => 'abcdefAhauhsdfguagdfaf'));
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(0, count($resultSet));
    }

    public function testSelectByIdReturnEntity()
    {
        $resultSet = $this->getTestUploadImage()->selectById(1);
        $this->assertNotNull($resultSet);
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);

        $this->assertEquals(1, $resultSet->getIdTestUploadImage());
    }

    public function testSelectByIdReturnNull()
    {
        $resultSet = $this->getTestUploadImage()->selectById(60000);
        $this->assertNull($resultSet);
    }

    public function testDeleteNoExistData()
    {
        $this->mockIdentity();
        $resultSet = $this->getTestUploadImage()->delete(6000);
        $this->assertFalse($resultSet);
    }

    public function testSelectOneByIdTestUploadImage()
    {
        $resultSet = $this->getTestUploadImage()->selectOneBy(array('idTestUploadImage' => 15));
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);
        $this->assertEquals(15, $resultSet->getIdTestUploadImage());
    }
    public function testSelectOneByImage()
    {
        $resultSet = $this->getTestUploadImage()->selectOneBy(array('image' => '15Image'));
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);
        $this->assertEquals('15Image', $resultSet->getImage());
    }

    public function testSelectAllOrderByIdTestUploadImageASC()
    {
        $resultSet = $this->getTestUploadImage()->selectAll(array(), 'idTestUploadImage', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01', $data['idTestUploadImage'***REMOVED***);
    }
    public function testSelectAllOrderByIdTestUploadImageDESC()
    {
        $resultSet = $this->getTestUploadImage()->selectAll(array(), 'idTestUploadImage', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30', $data['idTestUploadImage'***REMOVED***);
    }
    public function testSelectAllOrderByImageASC()
    {
        $resultSet = $this->getTestUploadImage()->selectAll(array(), 'image', 'ASC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('01Image', $data['image'***REMOVED***);
    }
    public function testSelectAllOrderByImageDESC()
    {
        $resultSet = $this->getTestUploadImage()->selectAll(array(), 'image', 'DESC');
        $this->assertTrue(is_array($resultSet));
        $this->assertEquals(30, count($resultSet));
        $data = array_shift($resultSet);
        $this->assertEquals('30Image', $data['image'***REMOVED***);
    }

    public function testCreateNewData()
    {
        $this->mockIdentity();
         $data = array(
            'image' => '/public/image',

        );
        $resultSet = $this->getTestUploadImage()->insert($data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
        $this->assertEquals('/public/image', $resultSet->getImage());
        return $resultSet;
    }


    public function maker()
    {
        $maker = new \GearBaseTest\UploadImageMock();
        return $maker->mockUploadFile(\TestUpload\Module::getLocation());
    }
    /**
     * @depends testCreateNewData
     */
    public function testUpdateExistData($entityToUpdate)
    {
        $this->mockIdentity();
         $data = array(
            'image' => '/public/image',

        );
        $resultSet = $this->getTestUploadImage()->update($entityToUpdate->getIdTestUploadImage(), $data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));
        $this->assertEquals('/public/image', $resultSet->getImage());
        return $resultSet;
    }


    /**
     * @depends testUpdateExistData
     */
    public function testDeleteExistData($entityToDelete)
    {
        $entity = $this->getTestUploadImage()->selectById($entityToDelete->getIdTestUploadImage());
        $this->mockIdentity();
        $resultSet = $this->getTestUploadImage()->delete($entity);
        $this->assertTrue($resultSet);
    }
}
