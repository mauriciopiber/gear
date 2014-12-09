<?php
namespace PiberNetwork\PiberNetworkTest\EntityTest;

class TipoServicoTest extends \PHPUnit_Framework_TestCase
{
    protected $tipoServico;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTipoServico()
    {
        if (!isset($this->tipoServico)) {
            $this->tipoServico =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Entity\TipoServicoEntity'
                );
        }
        return $this->tipoServico;
    }

    /**
     * @group PiberNetwork
     * @group TipoServico
     */
    public function testCallUsingServiceLocator()
    {
        $tipoServico = $this->getTipoServico();
        $this->assertInstanceOf('PiberNetwork\Entity\TipoServico', $tipoServico);
    }
}
