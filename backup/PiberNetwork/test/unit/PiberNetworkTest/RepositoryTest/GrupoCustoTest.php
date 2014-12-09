<?php
namespace PiberNetwork\PiberNetworkTest\RepositoryTest;

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
                $this->bootstrap->getServiceLocator()->get('PiberNetwork\Repository\GrupoCusto');
        }
        return $this->grupoCusto;
    }

    /**
     * @group PiberNetwork
     * @group GrupoCusto
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getGrupoCusto()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }


    /**
     * @group PiberNetwork
     * @group GrupoCusto
     */
    public function testCallUsingServiceLocator()
    {
        $grupoCusto = $this->getGrupoCusto();
        $this->assertInstanceOf('PiberNetwork\Repository\GrupoCusto', $grupoCusto);
    }
}
