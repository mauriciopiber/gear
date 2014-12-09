<?php
namespace PiberNetwork\PiberNetworkTest\EntityTest;

class StatusCustoTest extends \PHPUnit_Framework_TestCase
{
    protected $statusCusto;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getStatusCusto()
    {
        if (!isset($this->statusCusto)) {
            $this->statusCusto =
                $this->bootstrap->getServiceLocator()->get(
                    'PiberNetwork\Entity\StatusCustoEntity'
                );
        }
        return $this->statusCusto;
    }

    /**
     * @group PiberNetwork
     * @group StatusCusto
     */
    public function testCallUsingServiceLocator()
    {
        $statusCusto = $this->getStatusCusto();
        $this->assertInstanceOf('PiberNetwork\Entity\StatusCusto', $statusCusto);
    }
}
