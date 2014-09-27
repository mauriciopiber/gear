<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractService;

class ControllerTestService extends AbstractService {

    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'test/simple.module.unittest',
            array(
        	    'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
            ),
            'IndexControllerTest.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/tests/unit/'.$this->getConfig()->getModule().'/ControllerTest/'
        );
    }
}
