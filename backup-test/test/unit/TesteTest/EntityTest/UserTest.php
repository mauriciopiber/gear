<?php
namespace Teste\TesteTest\EntityTest;

/**
 * @group Entity
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    protected $user;

    protected function setUp()
    {
        $this->bootstrap = new \Teste\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getUser()
    {
        if (!isset($this->user)) {
            $this->user = $this->bootstrap->getServiceLocator()->get('Teste\Entity\User');
        }
        return $this->user;
    }

    /**
     * @group Teste
     * @group User
     */
    public function testCallUsingServiceLocator()
    {
        $user = $this->getUser();
        $this->assertInstanceOf('Teste\Entity\User', $user);
    }


    public function testGetterInitiateByNull()
    {
        $entity = $this->getUser();
        $this->assertNull($entity->getIdUser());
        $this->assertNull($entity->getEmail());
        $this->assertNull($entity->getPassword());
        $this->assertNull($entity->getUsername());
        $this->assertNull($entity->getState());
        $this->assertNull($entity->getUid());
        $this->assertNull($entity->getCreated());
        $this->assertNull($entity->getUpdated());
        $this->assertNull($entity->getCreatedBy());
        $this->assertNull($entity->getUpdatedBy());
        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection',$entity->getIdRole());
    }

    /**
     * @dataProvider getProvider
     */
    public function testSetterAndGet($email, $password, $username, $state, $uid, $created, $updated, $mockCreatedBy, $mockUpdatedBy, $mockIdRole)
    {
        $entity = $this->getUser();
        $entity->setEmail($email);
        $this->assertEquals($email, $entity->getEmail());

        $entity->setPassword($password);
        $this->assertEquals($password, $entity->getPassword());

        $entity->setUsername($username);
        $this->assertEquals($username, $entity->getUsername());

        $entity->setState($state);
        $this->assertEquals($state, $entity->getState());

        $entity->setUid($uid);
        $this->assertEquals($uid, $entity->getUid());

        $entity->setCreated($created);
        $this->assertEquals($created, $entity->getCreated());

        $entity->setUpdated($updated);
        $this->assertEquals($updated, $entity->getUpdated());

        $entity->setCreatedBy($mockCreatedBy);
        $this->assertEquals($mockCreatedBy, $entity->getCreatedBy());

        $entity->setUpdatedBy($mockUpdatedBy);
        $this->assertEquals($mockUpdatedBy, $entity->getUpdatedBy());

        $entity->addIdRole($mockIdRole);
        $entity->removeIdRole($mockIdRole);
    }

    public function getProvider()
    {
        $mockUserCreatedBy = $this->getMockBuilder('Teste\Entity\User')->getMock();

        $mockUserUpdatedBy = $this->getMockBuilder('Teste\Entity\User')->getMock();

        $mockIdRole = $this->getMockBuilder('Teste\Entity\Role')->getMock();

        return array(
            array('Email', 'Password', 'Username', 'State', 'Uid', 'Created', 'Updated', $mockUserCreatedBy, $mockUserUpdatedBy, $mockIdRole)
        );
    }
}
