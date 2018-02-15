<?php
namespace GearTest\MvcTest\ControllerTest\ApiTest;

use PHPUnit\Framework\TestCase;
use Gear\Mvc\Controller\Api\ApiControllerService;
use Gear\Module\BasicModuleStructure;
use GearBase\Util\String\StringService;
use Gear\Creator\Code;
use Gear\Creator\FileCreator\FileCreator;

/**
 * @group Service
 */
class ApiControllerServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->module = $this->prophesize(BasicModuleStructure::class);
        $this->string = new StringService();
        $this->code = $this->prophesize(Code::class);
        $this->fileCreator = $this->prophesize(FileCreator::class);

        $this->service = new ApiControllerService(
            $this->module->reveal(),
            $this->fileCreator->reveal(),
            $this->string,
            $this->code->reveal()
        );
    }

    public function testCreateModule()
    {
        $fileName = 'module/src/Controller/IndexController.php';

        $this->module->getModuleName()->willReturn('MyModule')->shouldBeCalled();
        $this->fileCreator->render()->willReturn($fileName)->shouldBeCalled();

        $file = $this->service->module();

        $this->assertEquals($fileName, $file);

    }

    public function testCreateModuleFactory()
    {

    }
}
