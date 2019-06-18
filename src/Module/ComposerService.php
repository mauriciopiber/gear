<?php
namespace Gear\Module;

use Gear\Module\Structure\ModuleStructure;
use Gear\Edge\Composer\ComposerEdge;
use Gear\Edge\Composer\ComposerEdgeTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\Vector\ArrayService;
use Gear\Util\Vector\ArrayServiceTrait;
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

    use ArrayServiceTrait;

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

        $namespace = $this->getModule()->getNamespace();
        $namespace = preg_replace('/\\\\/i', '\\\\\\\\', $namespace);

        return $this->getFileCreator()->createFile(
            'template/module/composer-as-project.json.phtml',
            array(
                'module' => $namespace,
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

    public function getProjectComposer()
    {
        $project = \GearBase\Module::getProjectFolder();

        $composer = $project . '/composer.json';

        if (!is_file($composer)) {
            throw new \Gear\Exception\FileNotFoundException();
        }

        $composerData = \Zend\Json\Json::decode(file_get_contents($composer), 1);

        return $composerData;
    }

    /*
    public function getModuleComposerJson($moduleName)
    {
        $module = \GearBase\Module::getProjectFolder().'/module/'.$moduleName;
        $composerJson = $module.'/composer.json';

        if (is_file($composerJson)) {
            return \Zend\Json\Json::decode(file_get_contents($composerJson), 1);
        } else {
            throw new \Exception(sprintf('Composer.json not found for %s', $this->getModule()->getModuleName()));
        }
    }
    */
}
