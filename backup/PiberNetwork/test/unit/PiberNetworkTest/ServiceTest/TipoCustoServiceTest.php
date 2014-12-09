<?php
namespace PiberNetwork\PiberNetworkTest\ServiceTest;

class TipoCustoServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $tipoCustoService;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTipoCustoService()
    {
        if (!isset($this->tipoCustoService)) {
            $this->tipoCustoService =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Service\TipoCustoService'
                );
        }
        return $this->tipoCustoService;
    }

    /**
     * @group PiberNetwork
     * @group TipoCustoService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTipoCustoService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group TipoCustoService
    */
    public function testCallUsingServiceLocator()
    {
        $tipoCustoService = $this->getTipoCustoService();
        $this->assertInstanceOf('PiberNetwork\Service\TipoCustoService', $tipoCustoService);
    }

    /**
     * @group TipoCustoService     */
    public function testSetTipoCustoRepository()
    {
        $mock = $this->getMockBuilder('PiberNetwork\Repository\TipoCustoRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $tipoCustoService = $this->getTipoCustoService();
        $tipoCustoService->setTipoCustoRepository($mock);
        $this->assertInstanceOf('PiberNetwork\Repository\TipoCustoRepository', $mock);
        return $this;
    }

    /**
     * @group TipoCustoService     */
    public function testGetTipoCustoRepository()
    {
        $tipoCustoService = $this->getTipoCustoService();
        $tipoCustoReposito = $tipoCustoService->getTipoCustoRepository();
        $this->assertInstanceOf('PiberNetwork\Repository\TipoCustoRepository', $tipoCustoReposito);

    }
}
