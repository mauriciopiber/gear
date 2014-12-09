<?php
namespace PiberNetwork\PiberNetworkTest\ServiceTest;

class StatusCustoServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $statusCustoService;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getStatusCustoService()
    {
        if (!isset($this->statusCustoService)) {
            $this->statusCustoService =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Service\StatusCustoService'
                );
        }
        return $this->statusCustoService;
    }

    /**
     * @group PiberNetwork
     * @group StatusCustoService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getStatusCustoService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group StatusCustoService
    */
    public function testCallUsingServiceLocator()
    {
        $statusCustoService = $this->getStatusCustoService();
        $this->assertInstanceOf('PiberNetwork\Service\StatusCustoService', $statusCustoService);
    }

    /**
     * @group StatusCustoService     */
    public function testSetStatusCustoRepository()
    {
        $mock = $this->getMockBuilder('PiberNetwork\Repository\StatusCustoRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $statusCustoService = $this->getStatusCustoService();
        $statusCustoService->setStatusCustoRepository($mock);
        $this->assertInstanceOf('PiberNetwork\Repository\StatusCustoRepository', $mock);
        return $this;
    }

    /**
     * @group StatusCustoService     */
    public function testGetStatusCustoRepository()
    {
        $statusCustoService = $this->getStatusCustoService();
        $statusCustoReposi = $statusCustoService->getStatusCustoRepository();
        $this->assertInstanceOf('PiberNetwork\Repository\StatusCustoRepository', $statusCustoReposi);

    }
}
