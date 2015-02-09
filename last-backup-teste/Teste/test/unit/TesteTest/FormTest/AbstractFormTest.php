<?php
namespace Teste\TesteTest\FormTest;

/**
 * @group Form
 */
class AbstractFormTest extends \PHPUnit_Framework_TestCase
{
    protected $pais;

    protected function setUp()
    {
        $this->bootstrap = new \Teste\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }


    public function testSetServiceLocator()
    {
        $abstract = $this->getMockBuilder('Teste\Form\AbstractForm')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setServiceLocator($this->bootstrap->getServiceLocator());

        $this->assertEquals($this->bootstrap->getServiceLocator(), $abstract->getServiceLocator());
    }

    public function testSetEntityManager()
    {
        $abstract = $this->getMockBuilder('Teste\Form\AbstractForm')
          ->disableOriginalConstructor()
          ->getMockForAbstractClass();

        $this->bootstrap
          ->getServiceManager()
          ->setAllowOverride(true);

        $this->bootstrap
          ->getServiceManager()
          ->get('ServiceManager')
          ->setService('doctrine.entitymanager.orm_default', $this->bootstrap->getEntityManager());

        $abstract->setServiceLocator($this->bootstrap->getServiceLocator());

        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $abstract->getEntityManager());

        $abstract->setEntityManager($this->bootstrap->getEntityManager());

        $this->assertEquals($this->bootstrap->getEntityManager(), $abstract->getEntityManager());
    }
}
