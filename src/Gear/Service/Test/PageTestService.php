<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class PageTestService extends AbstractJsonService
{
    public function generateForEmptyModule()
    {
        $this->createFileFromTemplate(
            'template/test/page/simple.module.phtml',
            array(
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'module' => $this->getConfig()->getModule()
            ),
            'ModuleMainPage.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/Pages/'
        );
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);
        $this->createPage();
        $this->editPage();
        $this->listPage();
        $this->deletePage();
    }



    public function createPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/page/action-create.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sCreatePage.php', $this->tableName));
        return $file->render();
    }

    public function editPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/page/action-edit.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sEditPage.php', $this->tableName));
        return $file->render();
    }

    public function listPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/page/action-list.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sListPage.php', $this->tableName));
        return $file->render();
    }

    public function deletePage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/page/action-delete.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sDeletePage.php', $this->tableName));
        return $file->render();
    }

    public function createFromPage(\Gear\ValueObject\Action $page)
    {
        $name = sprintf('%s%s', $this->str('class', $page->getController()->getName()), $this->str('class', $page->getName ()));


        $this->createFileFromTemplate(
            'template/test/page/simple.page.phtml',
            array(
                'pageUrl' => sprintf(
                    '/%s/%s/%s',
                    $this->str('url', $this->getConfig()->getModule()),
                    $this->str('url', $page->getController()->getNameOff()),
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
