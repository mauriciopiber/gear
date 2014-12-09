<?php
namespace PiberNetwork\PiberNetworkTest\FormTest;

class TipoServicoFormTest extends \PHPUnit_Framework_TestCase
{
    protected $tipoServicoForm;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTipoServicoForm()
    {
        if (!isset($this->tipoServicoForm)) {
            $this->tipoServicoForm = $this->bootstrap->getServiceLocator()->get(
                'PiberNetwork\Form\TipoServicoForm'
            );
        }
        return $this->tipoServicoForm;
    }

    /**
     * @group PiberNetwork
     * @group TipoServicoForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTipoServicoForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group TipoServicoForm
     */
    public function testCallUsingServiceLocator()
    {
        $tipoServicoForm = $this->getTipoServicoForm();
        $this->assertInstanceOf('PiberNetwork\Form\TipoServicoForm', $tipoServicoForm);
    }
}
