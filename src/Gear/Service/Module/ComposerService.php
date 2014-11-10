<?php
namespace Gear\Service\Module;

use Gear\Service\AbstractService;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class ComposerService extends AbstractService
{
    public function createComposer()
    {
        $this->createFileFromTemplate(
            'template/composer.json.phtml',
            array(
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
            ),
            'composer.json',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule()
        );
    }

    public function getModuleComposerJson($moduleName)
    {
        $module = \Gear\Service\ProjectService::getProjectFolder().'/module/'.$moduleName;
        $composerJson = $module.'/composer.json';

        if (is_file($composerJson)) {
            return \Zend\Json\Json::decode(file_get_contents($composerJson), 1);
        } else {
            throw new \Exception(sprintf('Composer.json not found for %s', $this->getConfig()->getModule()));
        }
    }

    public function getModuleDependencies()
    {

        $module = $this->getModule()->getMainFolder();

        $composerJson = $module.'/composer.json';



    }

    public function getProjectDependencies($projectName)
    {

    }
}
