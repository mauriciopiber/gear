<?php
namespace Gear\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Security\Entity\User;
use Zend\Crypt\Password\Bcrypt;

class LoadRole extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $this->getReference('admin-user');

        $roleGuest = new \Security\Entity\Role();

        $roleGuest->setName('guest');
        $roleGuest->setCreated(new \DateTime('now'));
        $roleGuest->setCreatedBy($user);
        $manager->persist($roleGuest);
        $manager->flush();

        $roleAdmin = new \Security\Entity\Role();

        $roleAdmin->setName('admin');
        $roleAdmin->setIdParent($roleGuest);
        $roleAdmin->setCreated(new \DateTime('now'));
        $roleAdmin->setCreatedBy($user);
        $manager->persist($roleAdmin);
        $manager->flush();

        $this->setReference('role-admin', $roleAdmin);
    }

    public function getOrder()
    {
        return 10; // number in which order to load fixtures
    }
}
