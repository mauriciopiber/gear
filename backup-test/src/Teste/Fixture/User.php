<?php
namespace Teste\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class User extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        foreach ($this->getFixture() as $i => $fixture) {
            $reference = $i+1;
            $user = new \Teste\Entity\User();
            $user->setEmail($fixture['email'***REMOVED***);
            $user->setPassword($fixture['password'***REMOVED***);
            $user->setUsername($fixture['username'***REMOVED***);
            $user->setState($fixture['state'***REMOVED***);
            $user->setUid($fixture['uid'***REMOVED***);
            $userReferenced = $this->getReferenceToEntity($reference);
            $user->setCreated(new \DateTime('now'));
            $user->setCreatedBy($userReferenced);
            $this->manager->persist($user);
            $this->manager->flush();
            $this->addReference("user-$reference", $user);
        }

    }

    public function getFixture()
    {
        return array(
            array(
                'email' => '1Email',
                'password' => '1Password',
                'username' => '1Username',
                'state' => '1',
                'uid' => '1Uid',
            ),
            array(
                'email' => '2Email',
                'password' => '2Password',
                'username' => '2Username',
                'state' => '2',
                'uid' => '2Uid',
            ),
            array(
                'email' => '3Email',
                'password' => '3Password',
                'username' => '3Username',
                'state' => '3',
                'uid' => '3Uid',
            ),
            array(
                'email' => '4Email',
                'password' => '4Password',
                'username' => '4Username',
                'state' => '4',
                'uid' => '4Uid',
            ),
            array(
                'email' => '5Email',
                'password' => '5Password',
                'username' => '5Username',
                'state' => '5',
                'uid' => '5Uid',
            ),
            array(
                'email' => '6Email',
                'password' => '6Password',
                'username' => '6Username',
                'state' => '6',
                'uid' => '6Uid',
            ),
            array(
                'email' => '7Email',
                'password' => '7Password',
                'username' => '7Username',
                'state' => '7',
                'uid' => '7Uid',
            ),
            array(
                'email' => '8Email',
                'password' => '8Password',
                'username' => '8Username',
                'state' => '8',
                'uid' => '8Uid',
            ),
            array(
                'email' => '9Email',
                'password' => '9Password',
                'username' => '9Username',
                'state' => '9',
                'uid' => '9Uid',
            ),
            array(
                'email' => '10Email',
                'password' => '10Password',
                'username' => '10Username',
                'state' => '10',
                'uid' => '10Uid',
            ),
            array(
                'email' => '11Email',
                'password' => '11Password',
                'username' => '11Username',
                'state' => '11',
                'uid' => '11Uid',
            ),
            array(
                'email' => '12Email',
                'password' => '12Password',
                'username' => '12Username',
                'state' => '12',
                'uid' => '12Uid',
            ),
            array(
                'email' => '13Email',
                'password' => '13Password',
                'username' => '13Username',
                'state' => '13',
                'uid' => '13Uid',
            ),
            array(
                'email' => '14Email',
                'password' => '14Password',
                'username' => '14Username',
                'state' => '14',
                'uid' => '14Uid',
            ),
            array(
                'email' => '15Email',
                'password' => '15Password',
                'username' => '15Username',
                'state' => '15',
                'uid' => '15Uid',
            ),
            array(
                'email' => '16Email',
                'password' => '16Password',
                'username' => '16Username',
                'state' => '16',
                'uid' => '16Uid',
            ),
            array(
                'email' => '17Email',
                'password' => '17Password',
                'username' => '17Username',
                'state' => '17',
                'uid' => '17Uid',
            ),
            array(
                'email' => '18Email',
                'password' => '18Password',
                'username' => '18Username',
                'state' => '18',
                'uid' => '18Uid',
            ),
            array(
                'email' => '19Email',
                'password' => '19Password',
                'username' => '19Username',
                'state' => '19',
                'uid' => '19Uid',
            ),
            array(
                'email' => '20Email',
                'password' => '20Password',
                'username' => '20Username',
                'state' => '20',
                'uid' => '20Uid',
            ),
            array(
                'email' => '21Email',
                'password' => '21Password',
                'username' => '21Username',
                'state' => '21',
                'uid' => '21Uid',
            ),
            array(
                'email' => '22Email',
                'password' => '22Password',
                'username' => '22Username',
                'state' => '22',
                'uid' => '22Uid',
            ),
            array(
                'email' => '23Email',
                'password' => '23Password',
                'username' => '23Username',
                'state' => '23',
                'uid' => '23Uid',
            ),
            array(
                'email' => '24Email',
                'password' => '24Password',
                'username' => '24Username',
                'state' => '24',
                'uid' => '24Uid',
            ),
            array(
                'email' => '25Email',
                'password' => '25Password',
                'username' => '25Username',
                'state' => '25',
                'uid' => '25Uid',
            ),
            array(
                'email' => '26Email',
                'password' => '26Password',
                'username' => '26Username',
                'state' => '26',
                'uid' => '26Uid',
            ),
            array(
                'email' => '27Email',
                'password' => '27Password',
                'username' => '27Username',
                'state' => '27',
                'uid' => '27Uid',
            ),
            array(
                'email' => '28Email',
                'password' => '28Password',
                'username' => '28Username',
                'state' => '28',
                'uid' => '28Uid',
            ),
            array(
                'email' => '29Email',
                'password' => '29Password',
                'username' => '29Username',
                'state' => '29',
                'uid' => '29Uid',
            ),
            array(
                'email' => '30Email',
                'password' => '30Password',
                'username' => '30Username',
                'state' => '30',
                'uid' => '30Uid',
            ),

        );

    }

    public function getReferenceToEntity($referenced = 1)
    {
        $referenced = 1;
        $referencedName = sprintf('usuariogear%d', $referenced);

        $userId = $this->getReference($referencedName);
        return $this->manager->getRepository('Teste\Entity\User')->findOneBy(array('idUser' => $userId->getIdUser()));
    }

    public function getOrder()
    {
        return 9951;
    }
}
