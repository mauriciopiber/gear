<?php
namespace TestUntil\TestUntilTest\EntityTest;

class PaisTest extends \PHPUnit_Framework_TestCase
{
    protected $pais;

    protected function setUp()
    {
        $this->bootstrap = new \TestUntil\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getPais()
    {
        if (!isset($this->pais)) {
            $this->pais =
                $this->bootstrap->getServiceLocator()->get(
                    'TestUntil\Entity\PaisEntity'
                );
        }
        return $this->pais;
    }

    /**
     * @group TestUntil
     * @group Pais
     */
    public function testCallUsingServiceLocator()
    {
        $pais = $this->getPais();
        $this->assertInstanceOf('TestUntil\Entity\Pais', $pais);
    }
}
