<?php
namespace MyModuleTest\FormTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group MyModule
 * @group IntForeignKeyForm
 * @group Form
 */
class IntForeignKeyFormTest extends AbstractTestCase
{
    public function getIntForeignKeyForm()
    {
        if (!isset($this->intForeignKeyForm)) {
            $this->intForeignKeyForm = $this->bootstrap->getServiceLocator()->get(
                'MyModule\Form\IntForeignKeyForm'
            );
        }
        return $this->intForeignKeyForm;
    }

    /**
     * @group MyModule
     * @group IntForeignKeyForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getIntForeignKeyForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group MyModule
     * @group IntForeignKeyForm
     */
    public function testCallUsingServiceLocator()
    {
        $intForeignKeyForm = $this->getIntForeignKeyForm();
        $this->assertInstanceOf('MyModule\Form\IntForeignKeyForm', $intForeignKeyForm);
    }
}
