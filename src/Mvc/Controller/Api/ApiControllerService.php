<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Mvc\Controller\AbstractControllerService;

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
    public function __construct()
    {
        return $this;
    }
}
