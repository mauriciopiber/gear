<?php
namespace Teste\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Role extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        foreach ($this->getFixture() as $i => $fixture) {
            $reference = $i+1;
            $role = new \Teste\Entity\Role();
            $role->setName($fixture['name'***REMOVED***);
            $userReferenced = $this->getReferenceToEntity($reference);
            $role->setCreated(new \DateTime('now'));
            $role->setCreatedBy($userReferenced);
            $this->manager->persist($role);
            $this->manager->flush();
            $this->addReference("role-$reference", $role);
        }

    }

    public function getFixture()
    {
        return array(
            array(
                'name' => '1Name',
            ),
            array(
                'name' => '2Name',
            ),
            array(
                'name' => '3Name',
            ),
            array(
                'name' => '4Name',
            ),
            array(
                'name' => '5Name',
            ),
            array(
                'name' => '6Name',
            ),
            array(
                'name' => '7Name',
            ),
            array(
                'name' => '8Name',
            ),
            array(
                'name' => '9Name',
            ),
            array(
                'name' => '10Name',
            ),
            array(
                'name' => '11Name',
            ),
            array(
                'name' => '12Name',
            ),
            array(
                'name' => '13Name',
            ),
            array(
                'name' => '14Name',
            ),
            array(
                'name' => '15Name',
            ),
            array(
                'name' => '16Name',
            ),
            array(
                'name' => '17Name',
            ),
            array(
                'name' => '18Name',
            ),
            array(
                'name' => '19Name',
            ),
            array(
                'name' => '20Name',
            ),
            array(
                'name' => '21Name',
            ),
            array(
                'name' => '22Name',
            ),
            array(
                'name' => '23Name',
            ),
            array(
                'name' => '24Name',
            ),
            array(
                'name' => '25Name',
            ),
            array(
                'name' => '26Name',
            ),
            array(
                'name' => '27Name',
            ),
            array(
                'name' => '28Name',
            ),
            array(
                'name' => '29Name',
            ),
            array(
                'name' => '30Name',
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
        return 9996;
    }
}
