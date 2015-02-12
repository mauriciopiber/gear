<?php
namespace Teste\TesteTest\FormTest;

/**
 * @group Form
 */
class EmailFormTest extends \PHPUnit_Framework_TestCase
{
    protected $emailForm;

    protected function setUp()
    {
        $this->bootstrap = new \Teste\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getEmailForm()
    {
        if (!isset($this->emailForm)) {
            $this->emailForm = $this->bootstrap->getServiceLocator()->get(
                'Teste\Factory\EmailFactory'
            );
        }
        return $this->emailForm;
    }

    /**
     * @group Teste
     * @group EmailForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getEmailForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Teste
     * @group EmailForm
     */
    public function testCallUsingServiceLocator()
    {
        $emailForm = $this->getEmailForm();
        $this->assertInstanceOf('Teste\Form\EmailForm', $emailForm);
    }
}
