<?php
namespace Column\ColumnTest\FormTest;

/**
 * @group Form
 */
class ColumnsFormTest extends \PHPUnit_Framework_TestCase
{
    protected $columnsForm;

    protected function setUp()
    {
        $this->bootstrap = new \Column\ZendServiceLocator();
    }

    protected function tearDown()
    {
        unset($this->bootstrap);
    }

    public function getColumnsForm()
    {
        if (!isset($this->columnsForm)) {
            $this->columnsForm = $this->bootstrap->getServiceLocator()->get(
                'Column\Factory\ColumnsFactory'
            );
        }
        return $this->columnsForm;
    }

    /**
     * @group Column
     * @group ColumnsForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getColumnsForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group Column
     * @group ColumnsForm
     */
    public function testCallUsingServiceLocator()
    {
        $columnsForm = $this->getColumnsForm();
        $this->assertInstanceOf('Column\Form\ColumnsForm', $columnsForm);
    }
}
