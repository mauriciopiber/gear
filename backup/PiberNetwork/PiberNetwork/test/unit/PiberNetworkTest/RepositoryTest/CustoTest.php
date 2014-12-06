<?php
namespace PiberNetwork\PiberNetworkTest\RepositoryTest;

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
                $this->bootstrap->getServiceLocator()->get('PiberNetwork\Repository\Custo');
        }
        return $this->custo;
    }

    /**
     * @group PiberNetwork
     * @group Custo
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getCusto()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group PiberNetwork
     * @group Custo
     */
    public function testCallUsingServiceLocator()
    {
        $custo = $this->getCusto();
        $this->assertInstanceOf('PiberNetwork\Repository\Custo', $custo);
    }
}
