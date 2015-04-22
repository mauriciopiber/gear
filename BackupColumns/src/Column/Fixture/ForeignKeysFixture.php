<?php
namespace Column\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ForeignKeysFixture extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        foreach ($this->getFixture() as $i => $fixture) {
            $reference = $i+1;
            $foreignKeys = new \Column\Entity\ForeignKeys();
            $foreignKeys->setName($fixture['name'***REMOVED***);
            $userReferenced = $this->getReferenceToEntity($reference);
            $foreignKeys->setCreated(new \DateTime('now'));
            $foreignKeys->setCreatedBy($userReferenced);
            $this->manager->persist($foreignKeys);
            $this->manager->flush();
            $this->addReference("foreign-keys-$reference", $foreignKeys);
        }

    }

/**
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */

    public function getFixture()
    {
        return array(
            array(
                'name' => '01Name',
            ),
            array(
                'name' => '02Name',
            ),
            array(
                'name' => '03Name',
            ),
            array(
                'name' => '04Name',
            ),
            array(
                'name' => '05Name',
            ),
            array(
                'name' => '06Name',
            ),
            array(
                'name' => '07Name',
            ),
            array(
                'name' => '08Name',
            ),
            array(
                'name' => '09Name',
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

/**
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
    public function getReferenceToEntity($referenced = 1)
    {
        $referenced = 1;
        $referencedName = sprintf('usuariogear%d', $referenced);

        $userId = $this->getReference($referencedName);
        return $this->manager
          ->getRepository('Security\Entity\User')
          ->findOneBy(array('idUser' => $userId->getIdUser()));
    }

    public function getOrder()
    {
        return 9994;
    }
}
