<?php
namespace Gear\Docker;

use Gear\Util\String\StringServiceTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Util\String\StringService;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;

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

    use ModuleStructureTrait;

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
        $this->setStringService($stringService);
        $this->fileCreator = $fileCreator;
        $this->module = $module;

        return $this;
    }

    public function createDockerComposeFile()
    {
        $type = $this->module->getType();

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/docker/docker-compose-%s.phtml', $type));
        $file->setOptions([
            'module' => $this->str('uline', $this->getModule()->getModuleName())
        ***REMOVED***);
        $file->setLocation($this->module->getMainFolder());
        $file->setFileName('docker-compose.yml');
        $render = $file->render();
        return $render;
    }

    public function createDockerfile()
    {
        $type = $this->module->getType();

        if (in_array($type, ['src'***REMOVED***)) {
            return;
        }

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/docker/dockerfile-%s.yml', $type));
        $file->setOptions([***REMOVED***);
        $file->setLocation($this->module->getMainFolder());
        $file->setFileName('Dockerfile');
        $render = $file->render();
        return $render;
    }
}
