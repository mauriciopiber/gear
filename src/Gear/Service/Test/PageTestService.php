<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractFixtureService;

class PageTestService extends AbstractFixtureService
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

    public function layoutPage()
    {
        if (!is_file($this->getModule()->getTestPagesFolder().'/LayoutPage.php')) {

            $file = $this->getServiceLocator()->get('fileCreator');
            $file->setView('template/test/page/layout-page.phtml');
            $file->setOptions(array_merge(array(), $this->basicOptions()));
            $file->setLocation($this->getModule()->getTestPagesFolder());
            $file->setFileName('LayoutPage.php');
            return $file->render();
        }
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $this->layoutPage();

        $this->createPage();
        $this->editPage();
        $this->listPage();
        $this->deletePage();
        $this->viewPage();
    }

    public function createPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');


        $dbColumns = $this->getTableData();
        $elements = [***REMOVED***;
        foreach ($dbColumns as $i => $column) {

            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                continue;
            }

            $elements[***REMOVED*** = array(
            	'element' => $column->getIdFormElement()
            );
        }
        $file->addChildView(
            array(
        	   'template' => 'template/test/page/formitens.phtml',
               'placeholder' => 'formitens',
               'config' => array('elements' => $elements)
            )
        );

        $file->setView('template/test/page/action-create.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sCreatePage.php', $this->tableName));
        return $file->render();
    }

    public function editPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $dbColumns = $this->getTableData();
        $elements = [***REMOVED***;
        foreach ($dbColumns as $i => $column) {
            $elements[***REMOVED*** = array(
                'element' => $column->getIdFormElement()
            );
        }
        $file->addChildView(
            array(
                'template' => 'template/test/page/formitens.phtml',
                'placeholder' => 'formitens',
                'config' => array('elements' => $elements)
            )
        );

        $file->setView('template/test/page/action-edit.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sEditPage.php', $this->tableName));
        return $file->render();
    }

    public function viewPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/page/action-view.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sViewPage.php', $this->tableName));
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
