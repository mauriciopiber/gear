<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Mvc\Controller\Api\ApiControllerServiceFactory;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Mvc/Controller/Api
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait ApiControllerServiceTrait
{
    protected $apiControllerService;

    /**
     * Get Api Controller Service
     *
     * @return ApiControllerService
     */
    public function getApiControllerService()
    {
        return $this->apiControllerService;
    }

    /**
     * Set Api Controller Service
     *
     * @param ApiControllerService $apiControllerService Api Controller Service
     *
     * @return ApiControllerService
     */
    public function setApiControllerService(
        ApiControllerService $apiControllerService
    ) {
        $this->apiControllerService = $apiControllerService;
        return $this;
    }
}
