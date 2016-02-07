<?php
namespace GearTest\ServiceTest\ConstructorTest;

use GearBaseTest\AbstractTestCase;
use Gear\Constructor\Service\AppService;

/**
 * @group Constructor
 * @group Constructor-Service
 */
class AppServiceTest extends AbstractTestCase
{

    public function testServiceLocator()
    {

    }

    public function testCreateController()
    {
        $appService = new \Gear\Constructor\Service\AppService();
        $controller = $appService->createController();

    }


    public function testCreateService()
    {

    }

}

