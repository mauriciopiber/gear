<?php
namespace GearTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__.'/../../../../../config/application.config.php'
        );

        parent::setUp();
    }

    public function testDB()
    {
        $this->assertTrue(true);
    }
}