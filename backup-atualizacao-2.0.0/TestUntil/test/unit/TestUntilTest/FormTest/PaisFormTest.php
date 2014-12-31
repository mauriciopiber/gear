<?php
namespace TestUntil\TestUntilTest\FormTest;

class PaisFormTest extends \PHPUnit_Framework_TestCase
{
    protected $paisForm;

    protected function setUp()
    {
        $this->bootstrap = new \TestUntil\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getPaisForm()
    {
        if (!isset($this->paisForm)) {
            $this->paisForm = $this->bootstrap->getServiceLocator()->get(
                'TestUntil\Factory\PaisFactory'
            );
        }
        return $this->paisForm;
    }

    /**
     * @group TestUntil
     * @group PaisForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getPaisForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group TestUntil
     * @group PaisForm
     */
    public function testCallUsingServiceLocator()
    {
        $paisForm = $this->getPaisForm();
        $this->assertInstanceOf('TestUntil\Form\PaisForm', $paisForm);
    }
}
