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

        $this->buildUpFunctional();

        $this->functionalCreate();
        $this->functionalEdit();
        $this->functionalList();
        $this->functionalDelete();
        $this->functionalView();
    }


    public function buildUpFunctional()
    {
        if (!is_file($this->getModule()->getTestFunctionalFolder().'/AbstractCest.php')) {
            $this->buildAbstractCest();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/FunctionalSteps.php')) {
            $this->buildFunctionalSteps();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/ListSteps.php')) {
            $this->buildListSteps();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/CreateSteps.php')) {
            $this->buildCreateSteps();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/EditSteps.php')) {
            $this->buildEditSteps();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/DeleteSteps.php')) {
            $this->buildDeleteSteps();
        }

        if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/ViewSteps.php')) {
            $this->buildViewSteps();
        }
    }

    public function buildAbstractCest()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/abstract-cest.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName('AbstractCest.php');
        return $file->render();
    }

    public function buildFunctionalSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/functional-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('FunctionalSteps.php');
        return $file->render();
    }

    public function buildListSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/list-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('ListSteps.php');
        return $file->render();
    }

    public function buildCreateSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/create-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('CreateSteps.php');
        return $file->render();
    }

    public function buildEditSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/edit-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('EditSteps.php');
        return $file->render();
    }

    public function buildDeleteSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/delete-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('DeleteSteps.php');
        return $file->render();
    }

    public function buildViewSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/view-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName('ViewSteps.php');
        return $file->render();
    }

    public function functionalCreate()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/action-create.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sCreateCest.php', $this->tableName));
        return $file->render();
    }

    public function functionalEdit()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase($file);


        $file->setView('template/test/functional/action-edit.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sEditCest.php', $this->tableName));
        return $file->render();
    }

    public function functionalView()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase($file, 1600);

        $this->viewSeeValues($file, 1600);
        $this->viewSeeLabels($file);

        $file->setView('template/test/functional/action-view.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sViewCest.php', $this->tableName));
        return $file->render();
    }


    public function viewSeeValues($file, $numberReference = 500, $placeholder = 'viewSeeValues')
    {
        $dbColumns = $this->getTableData();
        $seeInField = [***REMOVED***;

        $position = 1;

        foreach ($dbColumns as $i => $column) {

            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                $value = '$this->fixture';
            } else {
                $value = '\''.$column->getFixtureDefault($numberReference).'\'';
            }

            $seeInField[***REMOVED*** = array_merge(
                array(
                    'value' => $value,
                    'valuePosition' => ($position)
                ),
                $this->basicOptions()
            );

            $position += 1;
        }
        $file->addChildView(
            array(
                'template' => 'template/test/functional/collection/view-see-values.phtml',
                'config'   => array('values' => $seeInField),
                'placeholder' => $placeholder
            )
        );
    }



    public function viewSeeLabels($file, $placeholder = 'viewSeeLabels')
    {
        $dbColumns = $this->getTableData();
        $seeInField = [***REMOVED***;
        $position = 1;
        foreach ($dbColumns as $i => $column) {

            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                $value = 'ID';
            } else {
                $value = $this->str('label', $column->getColumn()->getName());
            }

            $seeInField[***REMOVED*** = array_merge(
                array(
                    'label' => $value,
                    'labelPosition' => ($position)
                ),
                $this->basicOptions()
            );

            $position += 1;
        }
        $file->addChildView(
            array(
                'template' => 'template/test/functional/collection/view-see-labels.phtml',
                'config'   => array('labels' => $seeInField),
                'placeholder' => $placeholder
            )
        );
    }



    public function functionalList()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/action-list.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sListCest.php', $this->tableName));
        return $file->render();
    }

    public function functionalDelete()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase($file);
        $file->setView('template/test/functional/action-delete.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sDeleteCest.php', $this->tableName));
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
