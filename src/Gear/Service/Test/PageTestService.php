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


        if ($this->verifyUploadImageAssociation($table->getTable())) {
            $this->uploadImagePage();
        }
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

            if ($column instanceof \Gear\Service\Column\Varchar\PasswordVerify) {
                $elements[***REMOVED*** = array(
            	    'element' => $column->getIdFormElement().'Verify'
                );
            }
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

            if ($column instanceof \Gear\Service\Column\Varchar\PasswordVerify) {
                $elements[***REMOVED*** = array(
                    'element' => $column->getIdFormElement().'Verify'
                );
            }
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

    public function uploadImagePage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/page/action-upload-image.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestPagesFolder());
        $file->setFileName(sprintf('%sUploadImagePage.php', $this->tableName));
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
}
