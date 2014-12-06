<?php
namespace PiberNetwork\PiberNetworkTest\FormTest;

class StatusCustoFormTest extends \PHPUnit_Framework_TestCase
{
    protected $statusCustoForm;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getStatusCustoForm()
    {
        if (!isset($this->statusCustoForm)) {
            $this->statusCustoForm = $this->bootstrap->getServiceLocator()->get(
                'PiberNetwork\Form\StatusCustoForm'
            );
        }
        return $this->statusCustoForm;
    }

    /**
     * @group PiberNetwork
     * @group StatusCustoForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getStatusCustoForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group StatusCustoForm
     */
    public function testCallUsingServiceLocator()
    {
        $statusCustoForm = $this->getStatusCustoForm();
        $this->assertInstanceOf('PiberNetwork\Form\StatusCustoForm', $statusCustoForm);
    }
}
