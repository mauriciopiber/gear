<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Mvc\Controller\AbstractControllerService;
use Gear\Module\BasicModuleStructure;
use Gear\Module\ModuleAwareTrait;
use GearBase\Util\String\StringService;
use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\Code;
use Gear\Creator\CodeTrait;
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
class ApiControllerService extends AbstractControllerService
{
    public function actionToController($insertMethods)
    {
        return false;
    }

    /**
     * Constructor
     *
     * @return ApiControllerService
     */
    public function __construct(
        BasicModuleStructure $module,
        FileCreator $fileCreator,
        StringService $stringService,
        Code $code
    ) {
        $this->module = $module;
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->code = $code;
        return $this;
    }

    public function module()
    {

    }

    public function moduleFactory()
    {


    }
}
