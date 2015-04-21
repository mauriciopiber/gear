<?php
namespace TestUpload\TestUploadTest\ServiceTest;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @group Service
 */
class TestUploadImageServiceTest extends \TestUploadTest\AbstractTest
{
    protected $testUploadImageSer;

    public function getTestUploadImageService()
    {
        if (!isset($this->testUploadImageSer)) {
            $this->testUploadImageSer =
                $this->bootstrap->getServiceLocator()->get(
                    'TestUpload\Service\TestUploadImageService'
                );
        }
        return $this->testUploadImageSer;
    }

    /**
     * @group TestUpload
     * @group TestUploadImageService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTestUploadImageService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group TestUpload
     * @group TestUploadImageService
    */
    public function testCallUsingServiceLocator()
    {
        $testUploadImageSer = $this->getTestUploadImageService();
        $this->assertInstanceOf('TestUpload\Service\TestUploadImageService', $testUploadImageSer);
    }

    /**
     * @group TestUploadImageService     */
    public function testSetTestUploadImageRepository()
    {
        $mock = $this->getMockBuilder('TestUpload\Repository\TestUploadImageRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $testUploadImageSe = $this->getTestUploadImageService();
        $testUploadImageSe->setTestUploadImageRepository($mock);
        $this->assertInstanceOf('TestUpload\Repository\TestUploadImageRepository', $mock);
        return $this;
    }

    /**
     * @group TestUploadImageService     */
    public function testGetTestUploadImageRepository()
    {
        $testUploadImageSe = $this->getTestUploadImageService();
        $testUploadImageRe = $testUploadImageSe->getTestUploadImageRepository();
        $this->assertInstanceOf('TestUpload\Repository\TestUploadImageRepository', $testUploadImageRe);

    }


    public function testSetSelectAllCache()
    {
        $this->mockIdentity();

        $this->getTestUploadImageService()->setSessionName('testing');

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem('testingResult')) {
            $cache->removeItem('testingResult');
        }

        $data = $this->getTestUploadImageService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
        $data = $this->getTestUploadImageService()->setSelectAllCache(array('data' => true));
        $this->assertEquals(array('data' => true), $data);
    }

    public function testSelectAllCacheWithCache()
    {
        $this->mockIdentity();

        $this->getTestUploadImageService()->setRouteMatch($this->getRouteMatch(1, 'image', 'DESC'));

        $this->assertEquals('image', $this->getTestUploadImageService()->getOrderBy());
        $this->assertEquals('DESC', $this->getTestUploadImageService()->getOrder());

        $resultSet = $this->getTestUploadImageService()->selectAll();
        $resultSet = $this->getTestUploadImageService()->selectAll();

        $this->getTestUploadImageService()->setRouteMatch($this->getRouteMatch(1, 'image', 'ASC'));

        $this->assertEquals('image', $this->getTestUploadImageService()->getOrderBy());
        $this->assertEquals('ASC', $this->getTestUploadImageService()->getOrder());

        $cache = $this->bootstrap->getServiceLocator()->get('memcached');

        if ($cache->hasItem($this->getTestUploadImageService()->getSessionName())) {
            $cache->removeItem($this->getTestUploadImageService()->getSessionName());
        }

        $this->getTestUploadImageService()->setRouteMatch($this->getRouteMatch(1, 'idTestUploadImage', 'DESC'));
        $this->assertEquals('idTestUploadImage', $this->getTestUploadImageService()->getOrderBy());
        $this->assertEquals('DESC', $this->getTestUploadImageService()->getOrder());
    }

    public function testSelectById()
    {
        $testUploadImageSer = $this->getTestUploadImageService();

        $resultSet = $testUploadImageSer->selectById(1);
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);
        $this->assertEquals(1, $resultSet->getIdTestUploadImage());
    }


    public function testSelectOneByIdTestUploadImage()
    {
        $resultSet = $this->getTestUploadImageService()->selectOneBy(array('idTestUploadImage' => 15));
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);
        $this->assertEquals(15, $resultSet->getIdTestUploadImage());
    }
    public function testSelectOneByImage()
    {
        $resultSet = $this->getTestUploadImageService()->selectOneBy(array('image' => '15Image'));
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);
        $this->assertEquals('15Image', $resultSet->getImage());
    }
    /**
     * @group Service.Create
     */
    public function testCreate()
    {
        $this->mockIdentity();
        $data = array(
            'image' => array(
                'error' => 0,
                'name' => 'image.jpg',
                'tmp_name' => __DIR__.'/_files/test-image.jpg',
                'type'      =>  'image/jpeg',
                'size'      =>  42,
            ),
        );
        $resultSet = $this->getTestUploadImageService()->create($data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(is_null($resultSet->getUpdated()));
        $this->assertEquals('/public/upload/test-upload-image-image/%simage.jpg', $resultSet->getImage());
        return $resultSet;
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($entityToUpdate)
    {
        $this->mockIdentity();
        $data = array(
            'image' => 'update Image',
        );
        $resultSet = $this->getTestUploadImageService()->update($entityToUpdate->getIdTestUploadImage(), $data);
        $this->bootstrap->getEntityManager()->refresh($resultSet);
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $resultSet);

        $this->assertTrue(!is_null($resultSet->getCreatedBy()));
        $this->assertTrue(!is_null($resultSet->getCreated()));
        $this->assertTrue(!is_null($resultSet->getUpdatedBy()));
        $this->assertTrue(!is_null($resultSet->getUpdated()));
        $this->assertEquals('update Image', $resultSet->getImage());
        return $resultSet;
    }

    /**
     * @depends testUpdate
     */
    public function testDelete($entityToDelete)
    {

        $testUploadImageSer = $this->getTestUploadImageService();

        $resultSet = $testUploadImageSer->delete($entityToDelete->getIdTestUploadImage());
        $this->assertTrue($resultSet);
    }

    public function getRouteMatch($page, $orderBy = 'idTestUploadImage', $order = 'DESC')
    {
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch(array(
            'controller' => 'TestUpload\Controller\TestUploadImage',
            'action'     => 'list',
            'page' => $page,
            'orderBy' => $orderBy,
            'order' => $order
        ));

        $routeMatch->setMatchedRouteName('test-upload/test-upload-image');
        return $routeMatch;
    }
}
