<?php
namespace TestUntil\TestUntilTest\RepositoryTest;

class AbstractFilterTest extends \PHPUnit_Framework_TestCase
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

    public function testEmailAdressValidator()
    {

        $abstract = $this->getMockBuilder('TestUntil\Filter\AbstractFilter')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setTranslate($this->bootstrap->getServiceLocator()->get('MvcTranslator'));


        $validator = $abstract->getEmailAddressValidator('E-mail');

        $this->assertArrayHasKey('name', $validator);
        $this->assertArrayHasKey('options', $validator);
        $this->assertArrayHasKey('break_chain_on_failure', $validator);
        $this->assertContains('EmailAddress', $validator);

    }


    public function testNoEmptyValidator()
    {
        $abstract = $this->getMockBuilder('TestUntil\Filter\AbstractFilter')
        ->disableOriginalConstructor()
        ->getMockForAbstractClass();

        $abstract->setTranslate($this->bootstrap->getServiceLocator()->get('MvcTranslator'));


        $validator = $abstract->getEmailAddressValidator('E-mail');

        $this->assertArrayHasKey('name', $validator);
        $this->assertArrayHasKey('options', $validator);
        $this->assertArrayHasKey('break_chain_on_failure', $validator);
        $this->assertContains('NotEmpty', $validator);
    }
}
