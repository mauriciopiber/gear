<?php
namespace GearTest\MvcTest\ViewTest\AppTest;

use GearBaseTest\AbstractTestCase;

/**
 * @group Action
 */
class AppControllerSpecServiceTest extends AbstractTestCase
{

    public function testCreateBuild()
    {

        $app = new \Gear\Mvc\View\App\AppControllerSpecService();

        $file = $app->build();


    }

}
