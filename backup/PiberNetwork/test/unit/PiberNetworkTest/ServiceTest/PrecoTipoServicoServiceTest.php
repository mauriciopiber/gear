<?php
namespace PiberNetwork\PiberNetworkTest\ServiceTest;

class PrecoTipoServicoServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $precoTipoServicoSe;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getPrecoTipoServicoService()
    {
        if (!isset($this->precoTipoServicoSe)) {
            $this->precoTipoServicoSe =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Service\PrecoTipoServicoService'
                );
        }
        return $this->precoTipoServicoSe;
    }

    /**
     * @group PiberNetwork
     * @group PrecoTipoServicoService
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPrecoTipoServicoService()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group PrecoTipoServicoService
    */
    public function testCallUsingServiceLocator()
    {
        $precoTipoServicoSe = $this->getPrecoTipoServicoService();
        $this->assertInstanceOf('PiberNetwork\Service\PrecoTipoServicoService', $precoTipoServicoSe);
    }

    /**
     * @group PrecoTipoServicoService     */
    public function testSetPrecoTipoServicoRepository()
    {
        $mock = $this->getMockBuilder('PiberNetwork\Repository\PrecoTipoServicoRepository')
          ->disableOriginalConstructor()
          ->getMock();
        $precoTipoServicoS = $this->getPrecoTipoServicoService();
        $precoTipoServicoS->setPrecoTipoServicoRepository($mock);
        $this->assertInstanceOf('PiberNetwork\Repository\PrecoTipoServicoRepository', $mock);
        return $this;
    }

    /**
     * @group PrecoTipoServicoService     */
    public function testGetPrecoTipoServicoRepository()
    {
        $precoTipoServicoS = $this->getPrecoTipoServicoService();
        $precoTipoServicoR = $precoTipoServicoS->getPrecoTipoServicoRepository();
        $this->assertInstanceOf('PiberNetwork\Repository\PrecoTipoServicoRepository', $precoTipoServicoR);

    }
}
