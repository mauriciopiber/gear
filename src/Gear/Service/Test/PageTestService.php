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

        $this->formPage();
        $this->createPage();
        $this->editPage();

        $this->standardListPage();

        $this->listPage();
        $this->deletePage();
        $this->viewPage();


        if ($this->verifyUploadImageAssociation($table->getTable())) {
            $this->uploadImagePage();
        }
    }

    public function standardListPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');


        $file->setView('template/test/page/standard-list.phtml');

        $file->setOptions(
            array_merge(
                array(),
                $this->basicOptions()
            )
        );

        $file->setLocation($this->getModule()->getTestPagesFolder());

        $file->setFileName('ListLayoutPage.php');
        return $file->render();
    }

    public function formPage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');


        $file->setView('template/test/page/form.phtml');

        $file->setOptions(
            array_merge(
                array(
        	        'elements' => $this->getFormElements()
                ),
                $this->basicOptions()
            )
        );

        $file->setLocation($this->getModule()->getTestPagesFolder());

        $file->setFileName(sprintf('%sFormPage.php', $this->tableName));
        return $file->render();
    }

    public function getFormElements()
    {
        $formElements = '';

        $dbColumns = $this->getTableData();

        foreach ($dbColumns as $i => $column) {

            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                continue;
            }

            $formElements .= <<<EOS
    public static \${$column->getIdFormElement()} = '#{$column->getIdFormElement()}';


EOS;

            if ($column instanceof \Gear\Service\Column\Varchar\PasswordVerify) {

                $elements = $column->getIdFormElement().'Verify';
                $formElements .= <<<EOS
    public static \${$elements} = '#{$elements}';


EOS;

            }
        }

        return $formElements;
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
