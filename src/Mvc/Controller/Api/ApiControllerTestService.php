<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Mvc\Controller\AbstractControllerTestService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use GearBase\Util\String\StringService;
use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\CodeTest;
use Gear\Creator\CodeTestTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Mvc/Controller/Api
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ApiControllerTestService extends AbstractControllerTestService
{
    use ModuleStructureTrait;
    use StringServiceTrait;
    use CodeTestTrait;
    use FileCreatorTrait;


    /**
     * Constructor
     *
     * @return ApiControllerTestService
     */
    public function __construct(
        ModuleStructure $module,
        FileCreator $fileCreator,
        StringService $stringService,
        CodeTest $codeTest
    ) {
        $this->module = $module;
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->codeTest = $codeTest;
        return $this;
    }

    public function module()
    {
        $file = $this->getFileCreator();
        $file->setOptions($this->getConfig());
        $file->setTemplate('template/module/mvc/rest-test/module/controller.phtml');
        $file->setFileName('IndexControllerTest.php');
        $file->setLocation($this->module->getTestControllerFolder());

        return $file->render();
    }

    public function moduleFactory()
    {
        $file = $this->getFileCreator();
        $file->setOptions($this->getConfig());
        $file->setTemplate('template/module/mvc/rest-test/module/controller-factory.phtml');
        $file->setFileName('IndexControllerFactoryTest.php');
        $file->setLocation($this->module->getTestControllerFolder());

        return $file->render();
    }

    private function getConfig() {
        return [
            'module' => $this->str('class', $this->getModule()->getModuleName()),
        ***REMOVED***;
    }

    public function buildController()
    {
        return true;
    }
}
