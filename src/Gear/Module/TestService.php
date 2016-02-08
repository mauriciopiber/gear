<?php
namespace Gear\Module;

use Gear\ValueObject\Config\Config;

use Gear\Service\AbstractService;

/**
 *
 * @author Mauricio Piber mauriciopiber@gmail.com
 *         Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 *         Bem como a classe Module.php e suas dependências
 */
class TestService extends AbstractService
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
        return $this->createFileFromTemplate(
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
        return $this->createFileFromTemplate(
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

        return $this->createFileFromTemplate(
            'template/test/unit/abstract.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'AbstractTest.php',
            $this->getModule()->getTestUnitModuleFolder()
        );
    }
}