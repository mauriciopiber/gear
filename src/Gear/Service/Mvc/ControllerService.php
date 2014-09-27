<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractService;

class ControllerService extends AbstractService {

    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'src/simple.module',
            array(
                'module' => $this->getConfig()->getModule(),
            ),
            'IndexController.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/src/'.$this->getConfig()->getModule().'/Controller/'
        );
    }
}
