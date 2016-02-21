<?php
namespace GearTest\MvcTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group module
 * @group module-mvc
 * @group module-mvc-controller
 */
class ControllerServiceTest extends AbstractTestCase
{
    public function testServiceManager()
    {
        $this->assertInstanceOf(
            'Gear\Mvc\Controller\ControllerService',
            $this->getServiceLocator()->get('Gear\Mvc\Controller\Controller')
        );
    }

    public function createCreateControllerDb()
    {
        //um db.
        //um mock de tabela.
        //
    }
}