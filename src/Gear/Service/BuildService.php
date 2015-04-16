<?php
namespace Gear\Service;

use Gear\Service\AbstractService;

/**
 * @author Mauricio Piber mauriciopiber@gmail.com
 * Classe responsável por rodar as builds do sistema
 */
class BuildService extends AbstractService
{


    /**
     * @return A valid Gear shared folder with jenkins and build contents
     */
    public function getShared()
    {
        return realpath(__DIR__.'/../../../view/template/shared/');
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
        $this->createFileFromTemplate(
            'template/module.build.xml.phtml',
            array(
                'moduleName' => $this->str('url', $this->getConfig()->getModule()),
            ),
            'build.xml',
            $this->getModule()->getMainFolder()
        );

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
        $this->copyphpdox();


        $this->copyphpunitfast();
        $this->copyphpunitcoverage();
        $this->copyphpunit();
        return true;
    }

    public function copyphpdox()
    {

        $this->createFileFromTemplate(
            'template/shared/jenkins/phpdox.xml.phtml',
            array(
                'module' => $this->str('url', $this->getConfig()->getModule()),
            ),
            'phpdox.xml',
            $this->getModule()->getMainFolder()
        );

        $this->getFileService()->chmod(0777, $this->getModulephpdox());

    }


    public function copyphpmd()
    {

        $this->createFileFromTemplate(
            'template/shared/jenkins/phpmd.xml.phtml',
            array(
                'moduleName' => $this->str('label', $this->getConfig()->getModule()),
            ),
            'phpmd.xml',
            $this->getModule()->getConfigJenkinsFolder()
        );

        $this->getFileService()->chmod(0777, $this->getModulephpmd());

    }

    public function copyphpunitfast()
    {
        $this->createFileFromTemplate(
            'template/shared/jenkins/phpunit-fast-coverage.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getConfig()->getModule()),
            ),
            'phpunit-fast-coverage.xml',
            $this->getModule()->getConfigJenkinsFolder()
        );
        $this->getFileService()->chmod(0777, $this->getModulephpunitfast());
    }

    public function copyphpunitcoverage()
    {
        $this->createFileFromTemplate(
            'template/shared/jenkins/phpunitci.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getConfig()->getModule()),
            ),
            'phpunitci.xml',
            $this->getModule()->getConfigJenkinsFolder()
        );
        $this->getFileService()->chmod(0777, $this->getmodulephpunitcoverage());

    }

    public function copyphpunit()
    {
        $this->createFileFromTemplate(
            'template/shared/jenkins/phpunit.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getConfig()->getModule()),
            ),
            'phpunit.xml',
            $this->getModule()->getConfigJenkinsFolder()
        );
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


    public function getModulephpdox()
    {
        return $this->getModule()->getMainFolder().'/phpdox.xml';
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


    public function getParams()
    {

    }
    /**
     * Executa build completa a cada execução
     * @param string $build
     * @return string
     */
    public function build()
    {
        $this->trigger = $this->getRequest()->getParam('trigger', null);
        $this->domain  = $this->getRequest()->getParam('domain', null);


        $build = ($this->trigger !== null) ? $this->trigger : 'dev';
        $extra = ($this->domain !== null) ? $this->domain : false;

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
        }

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $shell = $scriptService->run($cmd);


        echo $shell;
        if ($shell) {

            return true;
        } else {
            return false;
        }
    }

    public function buildProject()
    {


        $this->trigger = $this->getRequest()->getParam('trigger', null);

        $build = ($this->trigger !== null) ? $this->trigger : '';


        $buildFile = \GearBase\Module::getProjectFolder().'/build.xml';

        if (!is_file($buildFile)) {
            return sprintf('Build.xml file in module %s is missing', $this->getConfig()->getModule());
        }

        $scriptFile = \GearBase\Module::getProjectFolder().'/build.sh';

        if (!is_file($scriptFile)) {
            return sprintf('Build.sh file in module %s is missing', $this->getConfig()->getModule());
        }

        $cmd = sprintf('%s %s', $scriptFile, $build);

        $scriptService = $this->getServiceLocator()->get('scriptService');
        $scriptService->setLocation(\GearBase\Module::getProjectFolder());
        $shell = $scriptService->run($cmd);

        echo $shell;
        if ($shell) {

            return true;
        } else {
            return false;
        }

    }
}
