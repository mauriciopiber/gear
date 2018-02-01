<?php
namespace Gear\Module;

use Gear\Module\BasicModuleStructure;
use Gear\Edge\ComposerEdge;
use Gear\Edge\ComposerEdgeTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Util\Vector\ArrayService;
use Gear\Mvc\AbstractMvc;
use GearBase\Util\String\StringService;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class ComposerService extends AbstractMvc
{
    use ComposerEdgeTrait;

    /**
     * Constructor
     *
     * @param BasicModuleStructure $basicModuleStructure Basic Module Structure
     * @param ComposerEdge         $composerEdge         Composer Edge
     * @param FileCreator          $fileCreator          File Creator
     * @param ArrayService         $arrayService         Array Service
     *
     * @return ComposerService
     */
    public function __construct(
        BasicModuleStructure $basicModuleStructure,
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
                //'namespace' => $this->str('namespace', $this->getModule()->getModuleName()),
                'module' => str_replace('\\', '\\\\', $this->str('namespace', $this->getModule()->getModuleName())),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'require' => $this->getArrayService()->toJson($edge['require'***REMOVED***, 2),
                'requireDev' => $this->getArrayService()->toJson($edge['require-dev'***REMOVED***, 2)
            ),
            'composer.json',
            $this->getModule()->getMainFolder()
        );
    }

    public function createComposer()
    {
        $this->getFileCreator()->createFile(
            'template/module/composer.json.phtml',
            array(
                'module' => $this->str('class', $this->getModule()->getModuleName()),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'composer.json',
            $this->getModule()->getMainFolder()
        );


        $initAutoloader = $this->getFileCreator();
        $initAutoloader->setView('template/module/test/init_autoloader.phtml');
        $initAutoloader->setOptions(['test' => 1***REMOVED***);
        $initAutoloader->setFileName('init_autoloader.php');
        $initAutoloader->setLocation($this->getModule()->getMainFolder());
        $initAutoloader->render();

        return;
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
