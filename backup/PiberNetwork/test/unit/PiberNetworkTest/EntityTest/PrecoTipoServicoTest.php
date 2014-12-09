<?php
namespace PiberNetwork\PiberNetworkTest\EntityTest;

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
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Entity\PrecoTipoServicoEntity'
                );
        }
        return $this->precoTipoServico;
    }

    /**
     * @group PiberNetwork
     * @group PrecoTipoServico
     */
    public function testCallUsingServiceLocator()
    {
        $precoTipoServico = $this->getPrecoTipoServico();
        $this->assertInstanceOf('PiberNetwork\Entity\PrecoTipoServico', $precoTipoServico);
    }
}
