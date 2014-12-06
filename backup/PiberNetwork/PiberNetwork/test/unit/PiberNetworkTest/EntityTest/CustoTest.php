<?php
namespace PiberNetwork\PiberNetworkTest\EntityTest;

class CustoTest extends \PHPUnit_Framework_TestCase
{
    protected $custo;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getCusto()
    {
        if (!isset($this->custo)) {
            $this->custo =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Entity\CustoEntity'
                );
        }
        return $this->custo;
    }

    /**
     * @group PiberNetwork
     * @group Custo
     */
    public function testCallUsingServiceLocator()
    {
        $custo = $this->getCusto();
        $this->assertInstanceOf('PiberNetwork\Entity\Custo', $custo);
    }
}
