<?php
namespace MyModuleTest\FilterTest;

use GearBaseTest\FilterTest\AbstractFilterTestCase;

/**
 * @group MyModule
 * @group IntForeignKeyFilter
 * @group Filter
 */
class IntForeignKeyFilterTest extends AbstractFilterTestCase
{
    protected $intForeignKeyFilter;

    public function getIntForeignKeyFilter()
    {
        if (!isset($this->intForeignKeyFilter)) {
            $this->intForeignKeyFilter = $this->bootstrap
              ->getServiceLocator()
              ->get('MyModule\Filter\IntForeignKeyFilter');

            $this->intForeignKeyFilter
              ->setAdapter($this->bootstrap->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
        }
        return $this->intForeignKeyFilter;
    }

    /**
     * @group MyModule
     * @group IntForeignKeyFilter
     */
    public function testServiceLocator()
    {
        $serviceLocator = $this->getIntForeignKeyFilter()->getServiceLocator();
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $serviceLocator);
    }

    /**
     * @group MyModule
     * @group IntForeignKeyFilter
     */
    public function testCallUsingServiceLocator()
    {
        $intForeignKeyFilter = $this->getIntForeignKeyFilter();
        $this->assertInstanceOf('MyModule\Filter\IntForeignKeyFilter', $intForeignKeyFilter);
    }

    /**
     * @group MyModule
     * @group IntForeignKeyFilter
    */
    public function testGetInputFilter()
    {
        $intForeignKeyFilter = $this->getIntForeignKeyFilter();
        $className = $intForeignKeyFilter->getInputFilter();
        $this->assertInstanceOf('MyModule\Filter\IntForeignKeyFilter', $className);
    }

    /**
     * @group MyModule
     * @group IntForeignKeyFilter
     */
    public function testGetRequiredInvalidPost()
    {
        $intForeignKeyFilter = $this->getIntForeignKeyFilter();
        $inputFilter = $intForeignKeyFilter->getInputFilter();
        $inputFilter->setData(array());
        $this->assertFalse($inputFilter->isValid());
        $this->messages = $inputFilter->getMessages();

        $this->assertFilterHasMessage(
            'depName',
            'isEmpty',
            'O valor é obrigatório e não pode estar vazio'
        );
    }

    public function validPost()
    {
        return array(
            array(
                array(
                    'idIntForeignKey' => '99',
                    'depName' => '99Dep Name',
                ),
            ),
        );
    }

    /**
     * @group MyModule
     * @group IntForeignKeyFilter
     * @dataProvider validPost
     */
    public function testReturnTrueWithValidPost($data)
    {
        $intForeignKeyFilter = $this->getIntForeignKeyFilter();
        $inputFilter = $intForeignKeyFilter->getInputFilter();
        $inputFilter->setData($data);
        $this->assertTrue($inputFilter->isValid());
    }
}
