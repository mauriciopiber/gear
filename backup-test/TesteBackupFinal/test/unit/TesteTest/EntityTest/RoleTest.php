<?php
namespace Teste\TesteTest\EntityTest;

/**
 * @group Entity
 */
class RoleTest extends \PHPUnit_Framework_TestCase
{
    protected $role;

    protected function setUp()
    {
        $this->bootstrap = new \Teste\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getRole()
    {
        if (!isset($this->role)) {
            $this->role = $this->bootstrap->getServiceLocator()->get('Teste\Entity\Role');
        }
        return $this->role;
    }

    /**
     * @group Teste
     * @group Role
     */
    public function testCallUsingServiceLocator()
    {
        $role = $this->getRole();
        $this->assertInstanceOf('Teste\Entity\Role', $role);
    }


    public function testGetterInitiateByNull()
    {
        $entity = $this->getRole();
        $this->assertNull($entity->getIdRole());
        $this->assertNull($entity->getIdParent());
        $this->assertNull($entity->getName());
        $this->assertNull($entity->getCreated());
        $this->assertNull($entity->getUpdated());
        $this->assertNull($entity->getCreatedBy());
        $this->assertNull($entity->getUpdatedBy());
        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection',$entity->getIdUser());
    }

    /**
     * @dataProvider getProvider
     */
    public function testSetterAndGet($mockIdParent, $name, $created, $updated, $mockCreatedBy, $mockUpdatedBy, $mockIdUser)
    {
        $entity = $this->getRole();
        $entity->setIdParent($mockIdParent);
        $this->assertEquals($mockIdParent, $entity->getIdParent());

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

        $entity->addIdUser($mockIdUser);
        $entity->removeIdUser($mockIdUser);
    }

    public function getProvider()
    {
        $mockRoleIdParent = $this->getMockBuilder('Teste\Entity\Role')->getMock();

        $mockUserCreatedBy = $this->getMockBuilder('Teste\Entity\User')->getMock();

        $mockUserUpdatedBy = $this->getMockBuilder('Teste\Entity\User')->getMock();

        $mockIdUser = $this->getMockBuilder('Teste\Entity\User')->getMock();

        return array(
            array($mockRoleIdParent, 'Name', 'Created', 'Updated', $mockUserCreatedBy, $mockUserUpdatedBy, $mockIdUser)
        );
    }
}
