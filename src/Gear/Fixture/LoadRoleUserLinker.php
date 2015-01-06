<?php
namespace Gear\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Security\Entity\User;
use Zend\Crypt\Password\Bcrypt;

class LoadRoleUserLinker extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $user = $this->getReference('admin-user');
        $user->addIdRole($this->getReference('role-admin'));
        $manager->persist($user);
        $manager->flush();

        $user = $this->getReference('um-user');
        $user->addIdRole($this->getReference('role-admin'));
        $manager->persist($user);
        $manager->flush();

        $user = $this->getReference('dois-user');
        $user->addIdRole($this->getReference('role-admin'));
        $manager->persist($user);
        $manager->flush();

        $user = $this->getReference('tres-user');
        $user->addIdRole($this->getReference('role-admin'));
        $manager->persist($user);
        $manager->flush();
    }


    public function getOrder()
    {
        return 12; // number in which order to load fixtures
    }
}
