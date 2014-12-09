<?php
namespace PiberNetwork\PiberNetworkTest\ServiceTest;

class GrupoCustoServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $grupoCustoService;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getGrupoCustoService()
    {
        if (!isset($this->grupoCustoService)) {
            $this->grupoCustoService =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Service\GrupoCustoService'
                );
        }
        return $this->grupoCustoService;
    }

    /**
     * @group PiberNetwork
     * @group GrupoCustoService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getGrupoCustoService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group GrupoCustoService
    */
    public function testCallUsingServiceLocator()
    {
        $grupoCustoService = $this->getGrupoCustoService();
        $this->assertInstanceOf('PiberNetwork\Service\GrupoCustoService', $grupoCustoService);
    }

    /**
     * @group GrupoCustoService     */
    public function testSetGrupoCustoRepository()
    {
        $mock = $this->getMockBuilder('PiberNetwork\Repository\GrupoCustoRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $grupoCustoService = $this->getGrupoCustoService();
        $grupoCustoService->setGrupoCustoRepository($mock);
        $this->assertInstanceOf('PiberNetwork\Repository\GrupoCustoRepository', $mock);
        return $this;
    }

    /**
     * @group GrupoCustoService     */
    public function testGetGrupoCustoRepository()
    {
        $grupoCustoService = $this->getGrupoCustoService();
        $grupoCustoReposit = $grupoCustoService->getGrupoCustoRepository();
        $this->assertInstanceOf('PiberNetwork\Repository\GrupoCustoRepository', $grupoCustoReposit);

    }
}
