<?php
namespace Column\ColumnTest\EntityTest;

/**
 * @group Entity
 */
class ForeignKeysTest extends \PHPUnit_Framework_TestCase
{
    protected $foreignKeys;

    protected function setUp()
    {
        $this->bootstrap = new \Column\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getForeignKeys()
    {
        if (!isset($this->foreignKeys)) {
            $this->foreignKeys = $this->bootstrap->getServiceLocator()->get('Column\Entity\ForeignKeys');
        }
        return $this->foreignKeys;
    }

    /**
     * @group Column
     * @group ForeignKeys
     */
    public function testCallUsingServiceLocator()
    {
        $foreignKeys = $this->getForeignKeys();
        $this->assertInstanceOf('Column\Entity\ForeignKeys', $foreignKeys);
    }


    public function testGetterInitiateByNull()
    {
        $entity = $this->getForeignKeys();
        $this->assertNull($entity->getIdForeignKeys());
        $this->assertNull($entity->getName());
        $this->assertNull($entity->getCreated());
        $this->assertNull($entity->getUpdated());
        $this->assertNull($entity->getCreatedBy());
        $this->assertNull($entity->getUpdatedBy());
    }

    /**
     * @dataProvider getProvider
     */
    public function testSetterAndGet(
        $name,
        $created,
        $updated,
        $mockCreatedBy,
        $mockUpdatedBy
    ) {
        $entity = $this->getForeignKeys();
        $entity->setName($name);
        $this->assertEquals($name, $entity->getName());

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
                'Name',
                'Created',
                'Updated',
                $mockUserCreatedBy,
                $mockUserUpdatedBy
            )
        );
    }
}
