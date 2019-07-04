<?php
namespace Gear\Kube;

use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Creator\FileCreator\FileCreatorTrait;
use Gear\Util\String\StringServiceTrait;
use Gear\Code\CodeTrait;
use Gear\Module\Structure\ModuleStructure;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\String\StringService;
use Gear\Code\Code;

/**
 * PHP Version 5
 *
 * @category Service
 * @package Gear/Kube
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class KubeService
{
    use ModuleStructureTrait;

    use FileCreatorTrait;

    use StringServiceTrait;

    use CodeTrait;

    /**
     * Constructor
     *
     * @param ModuleStructure $moduleStructure Module Structure
     * @param FileCreator     $fileCreator     File Creator
     * @param StringService   $stringService   String Service
     * @param Code            $code            Code
     *
     * @return KubeService
     */
    public function __construct(
        ModuleStructure $moduleStructure,
        FileCreator $fileCreator,
        StringService $stringService,
        Code $code
    ) {
        $this->module = $moduleStructure;
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->code = $code;

        return $this;
    }

    public function createKube()
    {
        $type = $this->module->getType();

        $options = [
            'module' => $this->str('url', $this->getModule()->getModuleName()),
            'moduleLine' => $this->str('uline', $this->getModule()->getModuleName()),
            'version' => '0.1.0'
        ***REMOVED***;


        $options['deployment'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/kube/deployment.phtml',
            $options
        );

        $options['deploymentDev'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/kube/deployment.dev.phtml',
            $options
        );

        $options['service'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/kube/service.phtml',
            $options
        );

        $options['serviceDev'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/kube/service.dev.phtml',
            $options
        );


        $options['ingress'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/kube/ingress.phtml',
            $options
        );

        $options['ingressDev'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/kube/ingress.dev.phtml',
            $options
        );

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/kube/kube-%s.phtml', $type));
        $file->setOptions($options);
        $file->setLocation($this->module->getMainFolder());
        $file->setFileName('kube.yaml');
        $render = $file->render();


        $temp = file_get_contents($render);
        $temp = trim($temp);
        file_put_contents($render, $temp);
        return $render;
    }
}
