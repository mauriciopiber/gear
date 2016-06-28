<?php
namespace Gear\Module;

use Gear\Mvc\AbstractMvc;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class ComposerService extends AbstractMvc
{
    use \Gear\Edge\ComposerEdgeTrait;

    public function createComposerAsProject($type = 'web')
    {
        $edge = $this->getComposerEdge()->getComposerModule($type);

        return $this->getFileCreator()->createFile(
            'template/module/composer-as-project.json.phtml',
            array(
                'module' => $this->str('class', $this->getModule()->getModuleName()),
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
        $initAutoloader->setView('template/test/init_autoloader.phtml');
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
}
