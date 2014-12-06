<?php
namespace PiberNetwork\PiberNetworkTest\RepositoryTest;

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
                $this->bootstrap->getServiceLocator()->get('PiberNetwork\Repository\TipoCusto');
        }
        return $this->tipoCusto;
    }

    /**
     * @group PiberNetwork
     * @group TipoCusto
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getTipoCusto()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group PiberNetwork
     * @group TipoCusto
     */
    public function testCallUsingServiceLocator()
    {
        $tipoCusto = $this->getTipoCusto();
        $this->assertInstanceOf('PiberNetwork\Repository\TipoCusto', $tipoCusto);
    }
}
