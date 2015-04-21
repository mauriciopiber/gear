<?php
namespace TestUpload\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class TestUploadImageFixture extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        foreach ($this->getFixture() as $i => $fixture) {
            $reference = $i+1;
            $testUploadImage = new \TestUpload\Entity\TestUploadImage();
            $testUploadImage->setImage($fixture['image'***REMOVED***);
            $userReferenced = $this->getReferenceToEntity($reference);
            $testUploadImage->setCreated(new \DateTime('now'));
            $testUploadImage->setCreatedBy($userReferenced);
            $this->manager->persist($testUploadImage);
            $this->manager->flush();
            $this->addReference("test-upload-image-$reference", $testUploadImage);
        }

    }

/**
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */

    public function getFixture()
    {
        return array(
            array(
                'image' => '01Image',
            ),
            array(
                'image' => '02Image',
            ),
            array(
                'image' => '03Image',
            ),
            array(
                'image' => '04Image',
            ),
            array(
                'image' => '05Image',
            ),
            array(
                'image' => '06Image',
            ),
            array(
                'image' => '07Image',
            ),
            array(
                'image' => '08Image',
            ),
            array(
                'image' => '09Image',
            ),
            array(
                'image' => '10Image',
            ),
            array(
                'image' => '11Image',
            ),
            array(
                'image' => '12Image',
            ),
            array(
                'image' => '13Image',
            ),
            array(
                'image' => '14Image',
            ),
            array(
                'image' => '15Image',
            ),
            array(
                'image' => '16Image',
            ),
            array(
                'image' => '17Image',
            ),
            array(
                'image' => '18Image',
            ),
            array(
                'image' => '19Image',
            ),
            array(
                'image' => '20Image',
            ),
            array(
                'image' => '21Image',
            ),
            array(
                'image' => '22Image',
            ),
            array(
                'image' => '23Image',
            ),
            array(
                'image' => '24Image',
            ),
            array(
                'image' => '25Image',
            ),
            array(
                'image' => '26Image',
            ),
            array(
                'image' => '27Image',
            ),
            array(
                'image' => '28Image',
            ),
            array(
                'image' => '29Image',
            ),
            array(
                'image' => '30Image',
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
        return 9997;
    }
}
