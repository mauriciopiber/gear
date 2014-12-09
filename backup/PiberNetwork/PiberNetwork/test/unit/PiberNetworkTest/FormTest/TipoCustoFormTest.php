<?php
namespace PiberNetwork\PiberNetworkTest\FormTest;

class TipoCustoFormTest extends \PHPUnit_Framework_TestCase
{
    protected $tipoCustoForm;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTipoCustoForm()
    {
        if (!isset($this->tipoCustoForm)) {
            $this->tipoCustoForm = $this->bootstrap->getServiceLocator()->get(
                'PiberNetwork\Form\TipoCustoForm'
            );
        }
        return $this->tipoCustoForm;
    }

    /**
     * @group PiberNetwork
     * @group TipoCustoForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTipoCustoForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group TipoCustoForm
     */
    public function testCallUsingServiceLocator()
    {
        $tipoCustoForm = $this->getTipoCustoForm();
        $this->assertInstanceOf('PiberNetwork\Form\TipoCustoForm', $tipoCustoForm);
    }
}
