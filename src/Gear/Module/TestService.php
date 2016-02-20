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
        $this->createAbstractFile();
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

    public function createAbstractFile()
    {

        return $this->getFileCreator()->createFile(
            'template/test/unit/abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'AbstractTest.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
    }
}
