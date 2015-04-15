<?php
namespace Teste\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class EmailFixture extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        foreach ($this->getFixture() as $i => $fixture) {
            $reference = $i+1;
            $email = new \Teste\Entity\Email();
            $email->setRemetente($fixture['remetente'***REMOVED***);
            $email->setDestino($fixture['destino'***REMOVED***);
            $email->setAssunto($fixture['assunto'***REMOVED***);
            $email->setMensagem($fixture['mensagem'***REMOVED***);
            $userReferenced = $this->getReferenceToEntity($reference);
            $email->setCreated(new \DateTime('now'));
            $email->setCreatedBy($userReferenced);
            $this->manager->persist($email);
            $this->manager->flush();
            $this->addReference("email-$reference", $email);
        }

    }

/**
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */

    public function getFixture()
    {
        return array(
            array(
                'remetente' => '1Remetente',
                'destino' => '1Destino',
                'assunto' => '1Assunto',
                'mensagem' => '1Mensagem',
            ),
            array(
                'remetente' => '2Remetente',
                'destino' => '2Destino',
                'assunto' => '2Assunto',
                'mensagem' => '2Mensagem',
            ),
            array(
                'remetente' => '3Remetente',
                'destino' => '3Destino',
                'assunto' => '3Assunto',
                'mensagem' => '3Mensagem',
            ),
            array(
                'remetente' => '4Remetente',
                'destino' => '4Destino',
                'assunto' => '4Assunto',
                'mensagem' => '4Mensagem',
            ),
            array(
                'remetente' => '5Remetente',
                'destino' => '5Destino',
                'assunto' => '5Assunto',
                'mensagem' => '5Mensagem',
            ),
            array(
                'remetente' => '6Remetente',
                'destino' => '6Destino',
                'assunto' => '6Assunto',
                'mensagem' => '6Mensagem',
            ),
            array(
                'remetente' => '7Remetente',
                'destino' => '7Destino',
                'assunto' => '7Assunto',
                'mensagem' => '7Mensagem',
            ),
            array(
                'remetente' => '8Remetente',
                'destino' => '8Destino',
                'assunto' => '8Assunto',
                'mensagem' => '8Mensagem',
            ),
            array(
                'remetente' => '9Remetente',
                'destino' => '9Destino',
                'assunto' => '9Assunto',
                'mensagem' => '9Mensagem',
            ),
            array(
                'remetente' => '10Remetente',
                'destino' => '10Destino',
                'assunto' => '10Assunto',
                'mensagem' => '10Mensagem',
            ),
            array(
                'remetente' => '11Remetente',
                'destino' => '11Destino',
                'assunto' => '11Assunto',
                'mensagem' => '11Mensagem',
            ),
            array(
                'remetente' => '12Remetente',
                'destino' => '12Destino',
                'assunto' => '12Assunto',
                'mensagem' => '12Mensagem',
            ),
            array(
                'remetente' => '13Remetente',
                'destino' => '13Destino',
                'assunto' => '13Assunto',
                'mensagem' => '13Mensagem',
            ),
            array(
                'remetente' => '14Remetente',
                'destino' => '14Destino',
                'assunto' => '14Assunto',
                'mensagem' => '14Mensagem',
            ),
            array(
                'remetente' => '15Remetente',
                'destino' => '15Destino',
                'assunto' => '15Assunto',
                'mensagem' => '15Mensagem',
            ),
            array(
                'remetente' => '16Remetente',
                'destino' => '16Destino',
                'assunto' => '16Assunto',
                'mensagem' => '16Mensagem',
            ),
            array(
                'remetente' => '17Remetente',
                'destino' => '17Destino',
                'assunto' => '17Assunto',
                'mensagem' => '17Mensagem',
            ),
            array(
                'remetente' => '18Remetente',
                'destino' => '18Destino',
                'assunto' => '18Assunto',
                'mensagem' => '18Mensagem',
            ),
            array(
                'remetente' => '19Remetente',
                'destino' => '19Destino',
                'assunto' => '19Assunto',
                'mensagem' => '19Mensagem',
            ),
            array(
                'remetente' => '20Remetente',
                'destino' => '20Destino',
                'assunto' => '20Assunto',
                'mensagem' => '20Mensagem',
            ),
            array(
                'remetente' => '21Remetente',
                'destino' => '21Destino',
                'assunto' => '21Assunto',
                'mensagem' => '21Mensagem',
            ),
            array(
                'remetente' => '22Remetente',
                'destino' => '22Destino',
                'assunto' => '22Assunto',
                'mensagem' => '22Mensagem',
            ),
            array(
                'remetente' => '23Remetente',
                'destino' => '23Destino',
                'assunto' => '23Assunto',
                'mensagem' => '23Mensagem',
            ),
            array(
                'remetente' => '24Remetente',
                'destino' => '24Destino',
                'assunto' => '24Assunto',
                'mensagem' => '24Mensagem',
            ),
            array(
                'remetente' => '25Remetente',
                'destino' => '25Destino',
                'assunto' => '25Assunto',
                'mensagem' => '25Mensagem',
            ),
            array(
                'remetente' => '26Remetente',
                'destino' => '26Destino',
                'assunto' => '26Assunto',
                'mensagem' => '26Mensagem',
            ),
            array(
                'remetente' => '27Remetente',
                'destino' => '27Destino',
                'assunto' => '27Assunto',
                'mensagem' => '27Mensagem',
            ),
            array(
                'remetente' => '28Remetente',
                'destino' => '28Destino',
                'assunto' => '28Assunto',
                'mensagem' => '28Mensagem',
            ),
            array(
                'remetente' => '29Remetente',
                'destino' => '29Destino',
                'assunto' => '29Assunto',
                'mensagem' => '29Mensagem',
            ),
            array(
                'remetente' => '30Remetente',
                'destino' => '30Destino',
                'assunto' => '30Assunto',
                'mensagem' => '30Mensagem',
            ),

        );

    }

/**
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
    public function getReferenceToEntity($referenced = 1)
    {
        if ($referenced >= 1 && $referenced <= 5) {
            $userNumber = 1;
        } elseif ($referenced >= 6 && $referenced <= 10) {
            $userNumber = 2;
        } elseif ($referenced >= 11 && $referenced <= 15) {
            $userNumber = 3;
        } elseif ($referenced >= 16 && $referenced <= 20) {
            $userNumber = 4;
        } elseif ($referenced >= 21 && $referenced <= 25) {
            $userNumber = 5;
        } elseif ($referenced >= 26 && $referenced <= 30) {
            $userNumber = 6;
        }

        $referencedName = sprintf('usuariogear%d', $userNumber);
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
