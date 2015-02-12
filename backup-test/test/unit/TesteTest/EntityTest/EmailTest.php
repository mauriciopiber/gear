<?php
namespace Teste\TesteTest\EntityTest;

/**
 * @group Entity
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{
    protected $email;

    protected function setUp()
    {
        $this->bootstrap = new \Teste\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getEmail()
    {
        if (!isset($this->email)) {
            $this->email = $this->bootstrap->getServiceLocator()->get('Teste\Entity\Email');
        }
        return $this->email;
    }

    /**
     * @group Teste
     * @group Email
     */
    public function testCallUsingServiceLocator()
    {
        $email = $this->getEmail();
        $this->assertInstanceOf('Teste\Entity\Email', $email);
    }


    public function testGetterInitiateByNull()
    {
        $entity = $this->getEmail();
        $this->assertNull($entity->getIdEmail());
        $this->assertNull($entity->getRemetente());
        $this->assertNull($entity->getDestino());
        $this->assertNull($entity->getAssunto());
        $this->assertNull($entity->getMensagem());
        $this->assertNull($entity->getCreated());
        $this->assertNull($entity->getUpdated());
        $this->assertNull($entity->getCreatedBy());
        $this->assertNull($entity->getUpdatedBy());
    }

    /**
     * @dataProvider getProvider
     */
    public function testSetterAndGet($remetente, $destino, $assunto, $mensagem, $created, $updated, $mockCreatedBy, $mockUpdatedBy)
    {
        $entity = $this->getEmail();
        $entity->setRemetente($remetente);
        $this->assertEquals($remetente, $entity->getRemetente());

        $entity->setDestino($destino);
        $this->assertEquals($destino, $entity->getDestino());

        $entity->setAssunto($assunto);
        $this->assertEquals($assunto, $entity->getAssunto());

        $entity->setMensagem($mensagem);
        $this->assertEquals($mensagem, $entity->getMensagem());

        $entity->setCreated($created);
        $this->assertEquals($created, $entity->getCreated());

        $entity->setUpdated($updated);
        $this->assertEquals($updated, $entity->getUpdated());

        $entity->setCreatedBy($mockCreatedBy);
        $this->assertEquals($mockCreatedBy, $entity->getCreatedBy());

        $entity->setUpdatedBy($mockUpdatedBy);
        $this->assertEquals($mockUpdatedBy, $entity->getUpdatedBy());

    }

    public function getProvider()
    {
        $mockUserCreatedBy = $this->getMockBuilder('Teste\Entity\User')->getMock();

        $mockUserUpdatedBy = $this->getMockBuilder('Teste\Entity\User')->getMock();

        return array(
            array('Remetente', 'Destino', 'Assunto', 'Mensagem', 'Created', 'Updated', $mockUserCreatedBy, $mockUserUpdatedBy)
        );
    }
}
