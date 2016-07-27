<?php
namespace MyModule\MyModuleTest\EntityTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group MyModule
 * @group IntForeignKey
 * @group Entity
 */
class IntForeignKeyTest extends AbstractTestCase
{
    protected $intForeignKey;

    public function getIntForeignKey()
    {
        if (!isset($this->intForeignKey)) {
            $this->intForeignKey = $this->bootstrap->getServiceLocator()->get(
                'MyModule\Entity\IntForeignKey'
            );
        }
        return $this->intForeignKey;
    }

    /**
     * @group MyModule
     * @group IntForeignKey
     */
    public function testCallUsingServiceLocator()
    {
        $intForeignKey = $this->getIntForeignKey();
        $this->assertInstanceOf('MyModule\Entity\IntForeignKey', $intForeignKey);
    }


    public function testGetterInitiateByNull()
    {
        $entity = $this->getIntForeignKey();
        $this->assertNull($entity->getIdIntForeignKey());
        $this->assertNull($entity->getDepName());
        $this->assertNull($entity->getCreated());
        $this->assertNull($entity->getUpdated());
        $this->assertNull($entity->getCreatedBy());
        $this->assertNull($entity->getUpdatedBy());
    }

    /**
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @dataProvider getProvider
     */
    public function testSetterAndGet(
        $depName,
        $created,
        $updated,
        $createdBy,
        $updatedBy
    ) {
        $entity = $this->getIntForeignKey();
        $entity->setDepName($depName);
        $this->assertEquals($depName, $entity->getDepName());

        $entity->setCreated($created);
        $this->assertEquals($created, $entity->getCreated());

        $entity->setUpdated($updated);
        $this->assertEquals($updated, $entity->getUpdated());

        $entity->setCreatedBy($createdBy);
        $this->assertEquals($createdBy, $entity->getCreatedBy());

        $entity->setUpdatedBy($updatedBy);
        $this->assertEquals($updatedBy, $entity->getUpdatedBy());

    }

    public function getProvider()
    {
        $userCreatedBy = $this->getMockBuilder('GearAdmin\Entity\User')->getMock();

        $userUpdatedBy = $this->getMockBuilder('GearAdmin\Entity\User')->getMock();

        return array(
            array(
                'Dep Name',
                'Created',
                'Updated',
                $userCreatedBy,
                $userUpdatedBy
            )
        );
    }
}
