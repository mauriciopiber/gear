<?php
namespace Gear\Docker;

use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;
use GearBase\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Docker
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class DockerService
{
    use StringServiceTrait;

    use FileCreatorTrait;

    /**
     * Constructor
     *
     * @param StringService $stringService String Service
     * @param FileCreator   $fileCreator   File Creator
     *
     * @return DockerService
     */
    public function __construct(
        StringService $stringService,
        FileCreator $fileCreator,
        ModuleStructure $module
    ) {
        $this->stringService = $stringService;
        $this->fileCreator = $fileCreator;
        $this->module = $module;

        return $this;
    }

    public function createDockerComposeFile()
    {
        $type = $this->module->getType();

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/docker/docker-compose-%s.yml', $type));
        $file->setOptions([***REMOVED***);
        $file->setLocation($this->module->getMainFolder());
        $file->setFileName('docker-compose.yml');
        $render = $file->render();
        return $render;
    }
}
