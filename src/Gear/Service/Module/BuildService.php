<?php
namespace Gear\Service\Module;

use Gear\Service\AbstractService;
/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class BuildService extends AbstractService
{
    public function getBuildFileFromModule()
    {

    }

    public function getBuildScriptFromModule()
    {

    }

    public function copyBuildXmlFile()
    {
        copy(__DIR__.'/../../Shared/build.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.xml');
    }

    public function copy()
    {

        $this->copyBuildXmlFile();

        copy(__DIR__.'/../../Shared/build.sh', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.sh');

        copy(__DIR__.'/../../Shared/jenkins/phpmd.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpmd.xml');

        copy(
        __DIR__.'/../../Shared/jenkins/phpunit-fast-coverage.xml',
        $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit-fast-coverage.xml'
            );

        copy(__DIR__.'/../../Shared/jenkins/phpunit.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit.xml');
        copy(__DIR__.'/../../Shared/jenkins/phpunitci.xml', $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunitci.xml');

        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/build.sh');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpmd.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunit-fast-coverage.xml');
        $this->getFileService()->chmod(0777, $this->getConfig()->getLocal() . '/module/' . $this->getConfig()->getModule() . '/config/jenkins/phpunitci.xml');

        return true;
    }

    /**
     * Executa build completa a cada execução
     * @param string $build
     * @return string
     */
    public function build($build = 'dev')
    {
        $buildFile = $this->getConfig()->getModuleFolder().'/build.xml';

        if (!is_file($buildFile)) {
            return sprintf('Build.xml file in module %s is missing', $this->getConfig()->getModule());
        }

        $scriptFile = $this->getConfig()->getModuleFolder().'/build.sh';

        if (!is_file($scriptFile)) {
            return sprintf('Build.sh file in module %s is missing', $this->getConfig()->getModule());
        }

        $cmd = sprintf('%s %s', $scriptFile, $build);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $shell = $scriptService->run($cmd);
        return $shell;
    }
}
