<?php
namespace Gear\Module;

use Gear\Mvc\AbstractMvc;
//use Gear\Edge\AntEdge\AntEdgeTrait;
use Gear\Upgrade\AntUpgradeTrait;

/**
 *
 * @author Mauricio Piber mauriciopiber@gmail.com
 *         Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 *         Bem como a classe Module.php e suas dependências
 */
class TestService extends AbstractMvc
{
    use AntUpgradeTrait;


    public function createTestsModuleAsProject($type = 'web')
    {
        $this->createBootstrapModuleAsProject();
        $this->copyBuildXmlFile($type);
        $this->copyphpdox();
        $this->copyphpmd();
        $this->copyphpunit();
        $this->copyphpunitcoverage();
        $this->copyphpunitfast();
        $this->copyDocSniff();
        $this->copyphpunitbenchmark();
        $this->copyphpunitcoveragebenchmark();
       // $this->createAbstractFile();
        return true;
    }

    public function createTests()
    {
        $this->createBootstrap();
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

        return $this->getFileCreator()->createFile(
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

        return $this->getFileCreator()->createFile(
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
        return $this->getFileCreator()->createFile(
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
        return $this->getFileCreator()->createFile(
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
        return $this->getFileCreator()->createFile(
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
        return $this->getFileCreator()->createFile(
            'template/module/test/phpunit-coverage-benchmark.xml.phtml',
            array(
                'module' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpunit-coverage-benchmark.xml',
            $this->getModule()->getTestFolder()
        );
    }


    public function copyphpunitbenchmark()
    {
        return $this->getFileCreator()->createFile(
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
        return $this->getFileCreator()->createFile(
            'template/module/test/phpunit.xml.phtml',
            array(
                'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            ),
            'phpunit.xml',
            $this->getModule()->getTestFolder()
        );
    }


    public function createBuildFile()
    {
        return $this->getFileCreator()->createFile(
            'template/module/build.xml.phtml',
            array(
                'moduleName' => $this->str('url', $this->getModule()->getModuleName()),
            ),
            'build.xml',
            $this->getModule()->getMainFolder()
        );
    }


    public function copyBuildXmlFile($type = 'web')
    {
        //$edge = $this->getAntEdge()->getAntModule('web');
        $file = $this->createBuildFile();

        $this->getAntUpgrade()->getConsolePrompt()->setForce(true);
        $this->getAntUpgrade()->upgradeModule($type);

        return $file;
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
