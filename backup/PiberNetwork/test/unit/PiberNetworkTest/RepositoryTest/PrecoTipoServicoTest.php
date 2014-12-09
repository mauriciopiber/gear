<?php
namespace PiberNetwork\PiberNetworkTest\RepositoryTest;

class PrecoTipoServicoTest extends \PHPUnit_Framework_TestCase
{
    protected $precoTipoServico;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getPrecoTipoServico()
    {
        if (!isset($this->precoTipoServico)) {
            $this->precoTipoServico =
                $this->bootstrap->getServiceLocator()->get('PiberNetwork\Repository\PrecoTipoServico');
        }
        return $this->precoTipoServico;
    }

    /**
     * @group PiberNetwork
     * @group PrecoTipoServico
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPrecoTipoServico()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group PiberNetwork
     * @group PrecoTipoServico
     */
    public function testCallUsingServiceLocator()
    {
        $precoTipoServico = $this->getPrecoTipoServico();
        $this->assertInstanceOf('PiberNetwork\Repository\PrecoTipoServico', $precoTipoServico);
    }
}
