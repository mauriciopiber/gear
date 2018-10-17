<?php
namespace Gear\Docker;

use Gear\Docker\DockerServiceFactory;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Docker
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait DockerServiceTrait
{
    protected $dockerService;

    /**
     * Get Docker Service
     *
     * @return DockerService
     */
    public function getDockerService()
    {
        return $this->dockerService;
    }

    /**
     * Set Docker Service
     *
     * @param DockerService $dockerService Docker Service
     *
     * @return DockerService
     */
    public function setDockerService(
        DockerService $dockerService
    ) {
        $this->dockerService = $dockerService;
        return $this;
    }
}
