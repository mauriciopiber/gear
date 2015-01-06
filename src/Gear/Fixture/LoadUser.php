<?php
namespace Gear\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Security\Entity\User;
use Zend\Crypt\Password\Bcrypt;

class LoadUser extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    public function fixtureUser($manager, $email, $password)
    {
        $userGearCli = new \Security\Entity\User();
        $userGearCli->setEmail($email);
        $bcrypt = new Bcrypt();
        $bcrypt->setCost(14);

        $userGearCli->setPassword($bcrypt->create($password));
        $userGearCli->setCreated(new \DateTime('now'));
        $userGearCli->setState(1);

        $userGearCli->setUsername('');
        $userGearCli->setUid(uniqid(true, true));

        $manager->persist($userGearCli);
        $manager->flush();

        $userGearCli->setCreatedBy($userGearCli);
        $userGearCli->setUpdated(new \DateTime('now'));
        $userGearCli->setUpdatedBy($userGearCli);

        $manager->persist($userGearCli);
        $manager->flush();

        return $userGearCli;
    }

    public function load(ObjectManager $manager)
    {
        $this->addReference('admin-user', $this->fixtureUser($manager, 'mauriciopiber@gmail.com', 'gearcli'));
        $this->addReference('um-user', $this->fixtureUser($manager, 'clienteum@gmail.com', 'gearum'));
        $this->addReference('dois-user', $this->fixtureUser($manager, 'clientedois@gmail.com', 'geardois'));
        $this->addReference('tres-user', $this->fixtureUser($manager, 'clientetres@gmail.com', 'geartres'));
    }

    public function getOrder()
    {
        return 1; // number in which order to load fixtures
    }
}
