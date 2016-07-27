<?php
namespace MyModule;

use GearBaseTest\AbstractTestCase;

/**
 * @group MyModule
 * @group IntForeignKeySearchForm
 * @group Search
 */
class IntForeignKeySearchFormTest extends AbstractTestCase
{
    public function getIntForeignKeySearchForm()
    {
        if (!isset($this->intForeignKeySearch)) {
            $this->intForeignKeySearch = $this->bootstrap->getServiceLocator()->get(
                'MyModule\Form\Search\IntForeignKeySearchForm'
            );
        }
        return $this->intForeignKeySearch;
    }

    /**
     * @group MyModule
     * @group IntForeignKeySearchForm
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getIntForeignKeySearchForm()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group MyModule
     * @group IntForeignKeySearchForm
     */
    public function testCallUsingServiceLocator()
    {
        $intForeignKeySearch = $this->getIntForeignKeySearchForm();
        $this->assertInstanceOf('MyModule\Form\Search\IntForeignKeySearchForm', $intForeignKeySearch);
    }
}
