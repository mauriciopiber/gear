<?php
namespace PiberNetwork\PiberNetworkTest\EntityTest;

class TipoCustoTest extends \PHPUnit_Framework_TestCase
{
    protected $tipoCusto;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getTipoCusto()
    {
        if (!isset($this->tipoCusto)) {
            $this->tipoCusto =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Entity\TipoCustoEntity'
                );
        }
        return $this->tipoCusto;
    }

    /**
     * @group PiberNetwork
     * @group TipoCusto
     */
    public function testCallUsingServiceLocator()
    {
        $tipoCusto = $this->getTipoCusto();
        $this->assertInstanceOf('PiberNetwork\Entity\TipoCusto', $tipoCusto);
    }
}
