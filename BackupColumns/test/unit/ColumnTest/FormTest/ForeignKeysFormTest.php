<?php
namespace Column\ColumnTest\FormTest;

/**
 * @group Form
 */
class ForeignKeysFormTest extends \PHPUnit_Framework_TestCase
{
    protected $foreignKeysForm;

    protected function setUp()
    {
        $this->bootstrap = new \Column\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getForeignKeysForm()
    {
        if (!isset($this->foreignKeysForm)) {
            $this->foreignKeysForm = $this->bootstrap->getServiceLocator()->get(
                'Column\Factory\ForeignKeysFactory'
            );
        }
        return $this->foreignKeysForm;
    }

    /**
     * @group Column
     * @group ForeignKeysForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getForeignKeysForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Column
     * @group ForeignKeysForm
     */
    public function testCallUsingServiceLocator()
    {
        $foreignKeysForm = $this->getForeignKeysForm();
        $this->assertInstanceOf('Column\Form\ForeignKeysForm', $foreignKeysForm);
    }
}
