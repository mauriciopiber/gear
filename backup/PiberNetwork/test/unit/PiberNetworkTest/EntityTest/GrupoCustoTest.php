<?php
namespace PiberNetwork\PiberNetworkTest\EntityTest;

class GrupoCustoTest extends \PHPUnit_Framework_TestCase
{
    protected $grupoCusto;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getGrupoCusto()
    {
        if (!isset($this->grupoCusto)) {
            $this->grupoCusto =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Entity\GrupoCustoEntity'
                );
        }
        return $this->grupoCusto;
    }

    /**
     * @group PiberNetwork
     * @group GrupoCusto
     */
    public function testCallUsingServiceLocator()
    {
        $grupoCusto = $this->getGrupoCusto();
        $this->assertInstanceOf('PiberNetwork\Entity\GrupoCusto', $grupoCusto);
    }
}
