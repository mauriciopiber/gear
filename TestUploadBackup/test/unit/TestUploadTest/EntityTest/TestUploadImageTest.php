<?php
namespace TestUpload\TestUploadTest\EntityTest;

/**
 * @group Entity
 */
class TestUploadImageTest extends \PHPUnit_Framework_TestCase
{
    protected $testUploadImage;

    protected function setUp()
    {
        $this->bootstrap = new \TestUpload\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTestUploadImage()
    {
        if (!isset($this->testUploadImage)) {
            $this->testUploadImage = $this->bootstrap->getServiceLocator()->get('TestUpload\Entity\TestUploadImage');
        }
        return $this->testUploadImage;
    }

    /**
     * @group TestUpload
     * @group TestUploadImage
     */
    public function testCallUsingServiceLocator()
    {
        $testUploadImage = $this->getTestUploadImage();
        $this->assertInstanceOf('TestUpload\Entity\TestUploadImage', $testUploadImage);
    }


    public function testGetterInitiateByNull()
    {
        $entity = $this->getTestUploadImage();
        $this->assertNull($entity->getIdTestUploadImage());
        $this->assertNull($entity->getImage());
        $this->assertNull($entity->getCreated());
        $this->assertNull($entity->getUpdated());
        $this->assertNull($entity->getCreatedBy());
        $this->assertNull($entity->getUpdatedBy());
    }

    /**
     * @dataProvider getProvider
     */
    public function testSetterAndGet(
        $image,
        $created,
        $updated,
        $mockCreatedBy,
        $mockUpdatedBy
    ) {
        $entity = $this->getTestUploadImage();
        $entity->setImage($image);
        $this->assertEquals($image, $entity->getImage());

        $entity->setCreated($created);
        $this->assertEquals($created, $entity->getCreated());

        $entity->setUpdated($updated);
        $this->assertEquals($updated, $entity->getUpdated());

        $entity->setCreatedBy($mockCreatedBy);
        $this->assertEquals($mockCreatedBy, $entity->getCreatedBy());

        $entity->setUpdatedBy($mockUpdatedBy);
        $this->assertEquals($mockUpdatedBy, $entity->getUpdatedBy());

    }

    public function getProvider()
    {
        $mockUserCreatedBy = $this->getMockBuilder('Security\Entity\User')->getMock();

        $mockUserUpdatedBy = $this->getMockBuilder('Security\Entity\User')->getMock();

        return array(
            array(
                'Image',
                'Created',
                'Updated',
                $mockUserCreatedBy,
                $mockUserUpdatedBy
            )
        );
    }
}
