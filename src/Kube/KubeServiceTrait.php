<?php
namespace Gear\Kube;

use Gear\Kube\KubeService;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Kube
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait KubeServiceTrait
{
    protected $kubeService;

    /**
     * Get Kube Service
     *
     * @return KubeService
     */
    public function getKubeService()
    {
        return $this->kubeService;
    }

    /**
     * Set Kube Service
     *
     * @param KubeService $kubeService Kube Service
     *
     * @return KubeService
     */
    public function setKubeService(
        KubeService $kubeService
    ) {
        $this->kubeService = $kubeService;
        return $this;
    }
}
