<?php
namespace PiberNetwork\PiberNetworkTest\ServiceTest;

class CustoServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $custoService;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getCustoService()
    {
        if (!isset($this->custoService)) {
            $this->custoService =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Service\CustoService'
                );
        }
        return $this->custoService;
    }

    /**
     * @group PiberNetwork
     * @group CustoService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getCustoService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group CustoService
    */
    public function testCallUsingServiceLocator()
    {
        $custoService = $this->getCustoService();
        $this->assertInstanceOf('PiberNetwork\Service\CustoService', $custoService);
    }

    /**
     * @group CustoService     */
    public function testSetCustoRepository()
    {
        $mock = $this->getMockBuilder('PiberNetwork\Repository\CustoRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $custoService = $this->getCustoService();
        $custoService->setCustoRepository($mock);
        $this->assertInstanceOf('PiberNetwork\Repository\CustoRepository', $mock);
        return $this;
    }

    /**
     * @group CustoService     */
    public function testGetCustoRepository()
    {
        $custoService = $this->getCustoService();
        $custoRepository = $custoService->getCustoRepository();
        $this->assertInstanceOf('PiberNetwork\Repository\CustoRepository', $custoRepository);

    }
}
