<?php
namespace Gear\Module;

use Gear\Mvc\AbstractMvc;

/**
 *
 * @author Mauricio Piber mauriciopiber@gmail.com
 *         Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 *         Bem como a classe Module.php e suas dependências
 */
class TestService extends AbstractMvc
{

    public function createTestsModuleAsProject()
    {
        $this->createBootstrapModuleAsProject();
        $this->copyBuildXmlFile();
        $this->copyphpdox();
        $this->copyphpmd();
        $this->copyphpunit();
        $this->copyphpunitcoverage();
        $this->copyphpunitfast();
        $this->copyDocSniff();
        $this->copyphpunitbenchmark();
       // $this->createAbstractFile();
        return true;
    }

    public function createTests()
    {

        $this->createBootstrap();
        $this->createAbstractFile();
        return true;
    }

    public function createBootstrapModuleAsProject()
    {
        return $this->getFileCreator()->createFile(
            'template/module/test/zend-service-locator.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'ZendServiceLocator.php',
            $this->getModule()->getTestFolder()
        );
    }

    public function createBootstrap()
    {
        return $this->getFileCreator()->createFile(
            'template/test/zend-service-locator.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'ZendServiceLocator.php',
            $this->getModule()->getTestFolder()
        );
    }


    public function copyphpdox()
    {

        $this->getFileCreator()->createFile(
            'template/module/phpdox.xml.phtml',
            array(
                'module' => $this->str('url', $this->getModule()->getModuleName()),
            ),
            'phpdox.xml',
            $this->getModule()->getMainFolder()
        );
    }


    public function copyphpmd()
    {

        $this->getFileCreator()->createFile(
            'template/module/test/phpmd.xml.phtml',
            array(
                'moduleName' => $this->str('label', $this->getModule()->getModuleName()),
            ),
            'phpmd.xml',
            $this->getModule()->getTestFolder()
        );


    }

    public function copyphpunitfast()
    {
        $this->getFileCreator()->createFile(
            'template/module/test/phpunit-fast-coverage.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpunit-fast-coverage.xml',
            $this->getModule()->getTestFolder()
        );
    }

    public function copyphpunitcoverage()
    {
        $this->getFileCreator()->createFile(
            'template/module/test/phpunitci.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpunitci.xml',
            $this->getModule()->getTestFolder()
        );

    }

    public function copyDocSniff()
    {
        $this->getFileCreator()->createFile(
            'template/module/test/docs-phpcs.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpcs-docs.xml',
            $this->getModule()->getTestFolder()
        );
    }

    public function copyphpunitcoveragebenchmark()
    {
        $this->getFileCreator()->createFile(
            'template/module/test/phpunit-coverage-benchmark.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpunit-coverage-benchmark.xml',
            $this->getModule()->getTestFolder()
        );
    }


    public function copyphpunitbenchmark()
    {
        $this->getFileCreator()->createFile(
            'template/module/test/phpunit-benchmark.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpunit-benchmark.xml',
            $this->getModule()->getTestFolder()
        );
    }



    public function copyphpunit()
    {
        $this->getFileCreator()->createFile(
            'template/module/test/phpunit.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpunit.xml',
            $this->getModule()->getTestFolder()
        );
    }


    public function copyBuildXmlFile()
    {
        $this->getFileCreator()->createFile(
            'template/module/build.xml.phtml',
            array(
                'moduleName' => $this->str('url', $this->getModule()->getModuleName()),
            ),
            'build.xml',
            $this->getModule()->getMainFolder()
        );
    }

   /*  public function createAbstractFile()
    {

        return $this->getFileCreator()->createFile(
            'template/test/unit/abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'AbstractTest.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
    } */
}
