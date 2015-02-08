<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class AcceptanceTestService extends AbstractJsonService
{
    protected $timeTest;

    public function generateForEmptyModule()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'template/test/acceptance/simple.module.acceptancetest.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleLabel' => $this->str('label', $this->getConfig()->getModule()),
                'version' => $config['version'***REMOVED***
            ),
            'ModuleMainPageCept.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/acceptance/'
        );
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);
        $this->acceptanceCreate();
        $this->acceptanceEdit();
        $this->acceptanceList();
        $this->acceptanceDelete();
        $this->acceptanceView();
    }

    public function acceptanceCreate()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/action-create.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sCreateCept.php', $this->tableName));
        return $file->render();
    }

    public function acceptanceEdit()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/action-edit.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sEditCept.php', $this->tableName));
        return $file->render();
    }

    public function acceptanceView()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/action-view.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sViewCept.php', $this->tableName));
        return $file->render();
    }

    public function acceptanceList()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/action-list.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sListCept.php', $this->tableName));
        return $file->render();
    }

    public function acceptanceDelete()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/action-delete.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sDeleteCept.php', $this->tableName));
        return $file->render();
    }


    public function createFromPage(\Gear\ValueObject\Action $page)
    {
        $name = sprintf('%s%s', $this->str('class', $page->getController()->getName()), $this->str('class', $page->getName()));


        $this->createFileFromTemplate(
            'template/test/acceptance/page.phtml',
            array(
                'pageUrl' => $this->str('url', $page->getRoute()),
                'pageName' => $name,
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $page->getController()->getName()),
                'action' => $this->str('class', $page->getName()),
                'version' => $this->getVersion(),
                'date' => $this->getTimeTest()->format('d-m-Y H:i:s')
            ),
            sprintf('%sCept.php', $name),
            $this->getModule()->getTestAcceptanceFolder()
        );
    }

    public function getTimeTest()
    {
        return $this->timeTest;
    }

    public function setTimeTest($timeTest)
    {
        $this->timeTest = $timeTest;
        return $this;
    }
}
