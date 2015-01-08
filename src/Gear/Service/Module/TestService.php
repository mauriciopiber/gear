<?php
namespace Gear\Service\Module;

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
    public function createTests()
    {
        $this->zendServiceLocator();
        return true;
    }

    public function zendServiceLocator()
    {
        return $this->createFileFromTemplate(
            'template/test/zend-service-locator.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
            ),
            'ZendServiceLocator.php',
            $this->getModule()->getTestFolder()
        );
    }
}
