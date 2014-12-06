<?php
namespace PiberNetwork\PiberNetworkTest\FormTest;

class CustoFormTest extends \PHPUnit_Framework_TestCase
{
    protected $custoForm;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getCustoForm()
    {
        if (!isset($this->custoForm)) {
            $this->custoForm = $this->bootstrap->getServiceLocator()->get(
                'PiberNetwork\Form\CustoForm'
            );
        }
        return $this->custoForm;
    }

    /**
     * @group PiberNetwork
     * @group CustoForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getCustoForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group CustoForm
     */
    public function testCallUsingServiceLocator()
    {
        $custoForm = $this->getCustoForm();
        $this->assertInstanceOf('PiberNetwork\Form\CustoForm', $custoForm);
    }
}
