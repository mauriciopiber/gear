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

    /**
     * @return A valid Gear shared folder with jenkins and build contents
     */
    public function getShared()
    {
        return realpath(__DIR__.'/../../Shared/');
    }

    public function getModuleBuildXml()
    {
        return $this->getModule()->getMainFolder() . '/build.xml';
    }

    public function getSharedBuildXml()
    {
        return $this->getShared().'/build.xml';
    }

    public function getModuleBuildSh()
    {
        return $this->getModule()->getMainFolder() . '/build.sh';
    }

    public function getSharedBuildSh()
    {
        return $this->getShared().'/build.sh';
    }



    public function copyBuildXmlFile()
    {

        $view = $this->getServiceLocator()->get('ViewTemplatePathStack');

        $this->createFileFromTemplate(
            'template/build.xml.phtml',
            array(
                'moduleName' => $this->str('url', $this->getConfig()->getModule()),
            ),
            'build.xml',
            $this->getModule()->getMainFolder()
        );

        //var_dump($view->resolve('template/build.xml.phtml'));die();
        //pegar xml do template
        //mudar/inserir os valores que eu quero
        //salvar corretamente
        //rodar build


        //copy($this->getSharedBuildXml(), $this->getModuleBuildXml());
        $this->getFileService()->chmod(0777, $this->getModuleBuildXml());
    }

    public function copyBuildShFile()
    {
        copy($this->getSharedBuildSh(), $this->getModuleBuildSh());
        $this->getFileService()->chmod(0777, $this->getModuleBuildSh());
    }


    public function copy()
    {
        $this->copyBuildXmlFile();
        $this->copyBuildShFile();
        $this->copyphpmd();
        $this->copyphpunitfast();
        $this->copyphpunitcoverage();
        $this->copyphpunit();
        return true;
    }

    public function copyphpmd()
    {
        copy($this->getSharedphpmd(), $this->getModulephpmd());
        $this->getFileService()->chmod(0777, $this->getModulephpmd());

    }

    public function copyphpunitfast()
    {
        copy($this->getSharedphpunitfast(), $this->getModulephpunitfast());
        $this->getFileService()->chmod(0777, $this->getModulephpunitfast());
    }

    public function copyphpunitcoverage()
    {
        copy($this->getSharedphpunitcoverage(), $this->getModulephpunitcoverage());
        $this->getFileService()->chmod(0777, $this->getmodulephpunitcoverage());

    }

    public function copyphpunit()
    {
        copy($this->getSharedphpunit(), $this->getModulephpunit());
        $this->getFileService()->chmod(0777, $this->getModulephpunit());

    }

    public function getSharedphpunitcoverage()
    {

        return $this->getShared().'/jenkins/phpunitci.xml';
    }

    public function getSharedphpunitfast()
    {
        return $this->getShared().'/jenkins/phpunit-fast-coverage.xml';
    }

    public function getSharedphpunit()
    {
        return $this->getShared().'/jenkins/phpunit.xml';
    }

    public function getSharedphpmd()
    {
        return $this->getShared().'/jenkins/phpmd.xml';
    }


    public function getModulephpmd()
    {
        return $this->getModule()->getConfigJenkinsFolder().'/phpmd.xml';
    }

    public function getModulephpunitcoverage()
    {
        return $this->getModule()->getConfigJenkinsFolder().'/phpunitci.xml';

    }

    public function getModulephpunitfast()
    {
        return $this->getModule()->getConfigJenkinsFolder().'/phpunit-fast-coverage.xml';
    }

    public function getModulephpunit()
    {
        return $this->getModule()->getConfigJenkinsFolder().'/phpunit.xml';
    }


    /**
     * Executa build completa a cada execução
     * @param string $build
     * @return string
     */
    public function build($build = 'dev', $extra)
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

        if (false !== $extra) {
            $cmd = sprintf('%s -Ds=%s', $cmd, $extra);

            //echo $cmd;die();
        }

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $shell = $scriptService->run($cmd);
        return $shell;
    }
}
