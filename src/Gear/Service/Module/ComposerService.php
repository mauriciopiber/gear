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
}
