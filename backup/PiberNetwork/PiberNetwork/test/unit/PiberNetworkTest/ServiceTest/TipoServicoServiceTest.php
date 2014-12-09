<?php
namespace PiberNetwork\PiberNetworkTest\ServiceTest;

class TipoServicoServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $tipoServicoService;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTipoServicoService()
    {
        if (!isset($this->tipoServicoService)) {
            $this->tipoServicoService =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Service\TipoServicoService'
                );
        }
        return $this->tipoServicoService;
    }

    /**
     * @group PiberNetwork
     * @group TipoServicoService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTipoServicoService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group TipoServicoService
    */
    public function testCallUsingServiceLocator()
    {
        $tipoServicoService = $this->getTipoServicoService();
        $this->assertInstanceOf('PiberNetwork\Service\TipoServicoService', $tipoServicoService);
    }

    /**
     * @group TipoServicoService     */
    public function testSetTipoServicoRepository()
    {
        $mock = $this->getMockBuilder('PiberNetwork\Repository\TipoServicoRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $tipoServicoService = $this->getTipoServicoService();
        $tipoServicoService->setTipoServicoRepository($mock);
        $this->assertInstanceOf('PiberNetwork\Repository\TipoServicoRepository', $mock);
        return $this;
    }

    /**
     * @group TipoServicoService     */
    public function testGetTipoServicoRepository()
    {
        $tipoServicoService = $this->getTipoServicoService();
        $tipoServicoReposi = $tipoServicoService->getTipoServicoRepository();
        $this->assertInstanceOf('PiberNetwork\Repository\TipoServicoRepository', $tipoServicoReposi);

    }
}
