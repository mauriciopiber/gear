<?php
namespace Gear\Mvc\Controller\Api;

use Gear\Mvc\Controller\Api\ApiControllerTestServiceFactory;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Mvc/Controller/Api
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait ApiControllerTestServiceTrait
{
    protected $apiControllerTestService;

    /**
     * Get Api Controller Test Service
     *
     * @return ApiControllerTestService
     */
    public function getApiControllerTestService()
    {
        return $this->apiControllerTestService;
    }

    /**
     * Set Api Controller Test Service
     *
     * @param ApiControllerTestService $apiControllerTest Api Controller Test Service
     *
     * @return ApiControllerTestService
     */
    public function setApiControllerTestService(
        ApiControllerTestService $apiControllerTest
    ) {
        $this->apiControllerTestService = $apiControllerTest;
        return $this;
    }
}
