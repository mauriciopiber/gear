<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractService;

class PageTestService extends AbstractService
{
    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'test/page/simple.module',
            array(
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'module' => $this->getConfig()->getModule()
            ),
            'ModuleMainPage.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/Pages/'
        );
    }
}
