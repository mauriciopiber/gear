<?php
namespace PiberNetwork\PiberNetworkTest\FormTest;

class GrupoCustoFormTest extends \PHPUnit_Framework_TestCase
{
    protected $grupoCustoForm;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getGrupoCustoForm()
    {
        if (!isset($this->grupoCustoForm)) {
            $this->grupoCustoForm = $this->bootstrap->getServiceLocator()->get(
                'PiberNetwork\Form\GrupoCustoForm'
            );
        }
        return $this->grupoCustoForm;
    }

    /**
     * @group PiberNetwork
     * @group GrupoCustoForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getGrupoCustoForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group GrupoCustoForm
     */
    public function testCallUsingServiceLocator()
    {
        $grupoCustoForm = $this->getGrupoCustoForm();
        $this->assertInstanceOf('PiberNetwork\Form\GrupoCustoForm', $grupoCustoForm);
    }
}
