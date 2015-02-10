<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;

class FunctionalTestService extends AbstractJsonService
{
    protected $timeTest;

    public function generateForEmptyModule()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'template/test/functional/simple.module.functionaltest.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleLabel' => $this->str('label', $this->getConfig()->getModule()),
                'version' => $config['version'***REMOVED***
            ),
            'ModuleMainPageCept.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/test/functional/'
        );
    }

    public function introspectFromTable($table)
    {
        $this->loadTable($table);

        $this->buildUpSteps();

        $this->functionalCreate();
        $this->functionalEdit();
        $this->functionalList();
        $this->functionalDelete();
        $this->functionalView();
    }


    public function buildUpSteps()
    {
        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/Breadscrumb.php')) {
            $this->buildBreadcrumbSteps();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/Filter.php')) {
            $this->buildFilterSteps();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/Paginator.php')) {
            $this->buildPaginatorSteps();
        }
    }

    public function buildBreadcrumbSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/breadcrumb.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('BreadcrumbSteps.php');
        return $file->render();
    }

    public function buildFilterSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/filter.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('FilterSteps.php');
        return $file->render();
    }

    public function buildPaginatorSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/paginator.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('PaginatorSteps.php');
        return $file->render();
    }

    public function functionalCreate()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/action-create.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sCreateCept.php', $this->tableName));
        return $file->render();
    }

    public function functionalEdit()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/action-edit.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sEditCept.php', $this->tableName));
        return $file->render();
    }

    public function functionalView()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/action-view.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sViewCept.php', $this->tableName));
        return $file->render();
    }

    public function functionalList()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/action-list.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sListCept.php', $this->tableName));
        return $file->render();
    }

    public function functionalDelete()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/action-delete.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sDeleteCept.php', $this->tableName));
        return $file->render();
    }

    public function createFromPage(\Gear\ValueObject\Action $page)
    {
        $name = sprintf('%s%s', $this->str('class', $page->getController()->getName()), $this->str('class', $page->getName()));

        $this->createFileFromTemplate(
            'template/test/functional/page.phtml',
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
            $this->getModule()->getTestFunctionalFolder()
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
