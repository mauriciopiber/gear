<?php
namespace Gear\Module;

use Gear\Module\Structure\ModuleStructure;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Edge\Composer\ComposerEdgeTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\Vector\ArrayService;
use Gear\Mvc\AbstractMvc;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class ComposerService extends AbstractMvc
{
    use StringServiceTrait;

    use ComposerEdgeTrait;

    /**
     * Constructor
     *
     * @param ModuleStructure $basicModuleStructure Basic Module Structure
     * @param ComposerEdge         $composerEdge         Composer Edge
     * @param FileCreator          $fileCreator          File Creator
     * @param ArrayService         $arrayService         Array Service
     *
     * @return ComposerService
     */
    public function __construct(
        ModuleStructure $basicModuleStructure,
        ComposerEdge $composerEdge,
        FileCreator $fileCreator,
        ArrayService $arrayService,
        StringService $stringService
    ) {
        $this->module = $basicModuleStructure;
        $this->composerEdge = $composerEdge;
        $this->fileCreator = $fileCreator;
        $this->arrayService = $arrayService;
        $this->stringService = $stringService;

        return $this;
    }


    public function createComposerAsProject($type = 'web')
    {
        $edge = $this->getComposerEdge()->getComposerModule($type);

        return $this->getFileCreator()->createFile(
            'template/module/composer-as-project.json.phtml',
            array(
                'module' => $this->getModuleNamespace(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'require' => $this->getArrayService()->toJson($edge['require'***REMOVED***, 2),
                'requireDev' => $this->getArrayService()->toJson($edge['require-dev'***REMOVED***, 2)
            ),
            'composer.json',
            $this->getModule()->getMainFolder()
        );
    }

    public function getName()
    {
        $file = $this->getProjectComposer();
        return $file['name'***REMOVED***;
    }
}
