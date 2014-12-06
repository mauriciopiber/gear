<?php
namespace PiberNetwork\PiberNetworkTest\FormTest;

class PrecoTipoServicoFormTest extends \PHPUnit_Framework_TestCase
{
    protected $precoTipoServicoF;

    protected function setUp()
    {
        $this->bootstrap = new \PiberNetwork\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getPrecoTipoServicoForm()
    {
        if (!isset($this->precoTipoServicoF)) {
            $this->precoTipoServicoF = $this->bootstrap->getServiceLocator()->get(
                'PiberNetwork\Form\PrecoTipoServicoForm'
            );
        }
        return $this->precoTipoServicoF;
    }

    /**
     * @group PiberNetwork
     * @group PrecoTipoServicoForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPrecoTipoServicoForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group PiberNetwork
     * @group PrecoTipoServicoForm
     */
    public function testCallUsingServiceLocator()
    {
        $precoTipoServicoF = $this->getPrecoTipoServicoForm();
        $this->assertInstanceOf('PiberNetwork\Form\PrecoTipoServicoForm', $precoTipoServicoF);
    }
}
