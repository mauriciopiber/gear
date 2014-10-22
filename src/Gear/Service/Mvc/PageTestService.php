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

    public function createFromPage(\Gear\ValueObject\Page $page)
    {
        $name = sprintf('%s%s', $this->str('class', $page->getController()->getName()), $this->str('class', $page->getAction()));


        $this->createFileFromTemplate(
            'template/test/page/simple.page.phtml',
            array(
                'pageUrl' => sprintf(
                    '/%s/%s/%s',
                    $this->str('url', $this->getConfig()->getModule()),
                    $this->str('url', $page->getController()->getName()),
                    $page->getRoute()
                ),
                'pageName' => $name,
                'module' => $this->getConfig()->getModule()
            ),
            sprintf('%sPage.php', $name),
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/Pages/'
        );

    }

}
