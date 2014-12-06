<?php
namespace PiberNetwork\PiberNetworkTest\RepositoryTest;

class StatusCustoTest extends \PHPUnit_Framework_TestCase
{
    protected $statusCusto;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getStatusCusto()
    {
        if (!isset($this->statusCusto)) {
            $this->statusCusto =
                $this->bootstrap->getServiceLocator()->get('PiberNetwork\Repository\StatusCusto');
        }
        return $this->statusCusto;
    }

    /**
     * @group PiberNetwork
     * @group StatusCusto
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getStatusCusto()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group PiberNetwork
     * @group StatusCusto
     */
    public function testCallUsingServiceLocator()
    {
        $statusCusto = $this->getStatusCusto();
        $this->assertInstanceOf('PiberNetwork\Repository\StatusCusto', $statusCusto);
    }
}
