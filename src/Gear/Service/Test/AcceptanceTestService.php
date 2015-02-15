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

        $this->buildUpAcceptance();

        $this->acceptanceCreate();
        $this->acceptanceEdit();
        $this->acceptanceList();
        $this->acceptanceDelete();
        $this->acceptanceView();
    }


    public function buildUpAcceptance()
    {
        if (!is_file($this->getModule()->getTestAcceptanceFolder().'/AbstractCest.php')) {
            $this->buildAbstractCest();
        }

        if (!is_file($this->getModule()->getTestAcceptanceStepsFolder().'/AcceptanceSteps.php')) {
            $this->buildAcceptanceSteps();
        }

        if (!is_file($this->getModule()->getTestAcceptanceStepsFolder().'/ListSteps.php')) {
            $this->buildListSteps();
        }

        if (!is_file($this->getModule()->getTestAcceptanceStepsFolder().'/CreateSteps.php')) {
            $this->buildCreateSteps();
        }

        if (!is_file($this->getModule()->getTestAcceptanceStepsFolder().'/EditSteps.php')) {
            $this->buildEditSteps();
        }

        if (!is_file($this->getModule()->getTestAcceptanceStepsFolder().'/DeleteSteps.php')) {
            $this->buildDeleteSteps();
        }

        if (!is_file($this->getModule()->getTestAcceptanceStepsFolder().'/ViewSteps.php')) {
            $this->buildViewSteps();
        }
    }


    public function buildListSteps()
    {

        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/list-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('ListSteps.php');
        return $file->render();
    }

    public function buildCreateSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/create-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('CreateSteps.php');
        return $file->render();
    }

    public function buildEditSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/edit-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('EditSteps.php');
        return $file->render();
    }

    public function buildDeleteSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/delete-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('DeleteSteps.php');
        return $file->render();
    }

    public function buildViewSteps()
    {



        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/view-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('ViewSteps.php');
        return $file->render();
    }

    public function buildAbstractCest()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/abstract-cest.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName('AbstractCest.php');
        return $file->render();
    }

    public function buildAcceptanceSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/acceptance-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('AcceptanceSteps.php');
        return $file->render();
    }


    public function acceptanceCreate()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->seeInField($file, 1200);
        $this->fillField($file, 1200);

        $file->setView('template/test/acceptance/action-create.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sCreateCest.php', $this->tableName));
        return $file->render();
    }


    public function seeLabels(&$file, $numberReference = 999, $placeholder = 'seeLabels')
    {
        $dbColumns = $this->getTableData();

        foreach ($dbColumns as $i => $column) {
            $fixtureHaveInDatabase[***REMOVED*** = array(
                'label' => $this->str('label', $column->getColumn()->getName()),
            );
        }
        $file->addChildView(
            array(
                'template' => 'template/test/acceptance/collection/seeLabels.phtml',
                'config'   => array('fixture' => $fixtureHaveInDatabase),
                'placeholder' => 'seeLabels'
            )
        );
    }

    public function seeValues(&$file, $numberReference = 999, $placeholder = 'seeValues')
    {
        $dbColumns = $this->getTableData();

        foreach ($dbColumns as $i => $column) {
            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                continue;
            }
            $fixtureHaveInDatabase[***REMOVED*** = array(
                'value' => $column->getFixtureDefault($numberReference)
            );
        }
        $file->addChildView(
            array(
                'template' => 'template/test/acceptance/collection/seeValues.phtml',
                'config'   => array('fixture' => $fixtureHaveInDatabase),
                'placeholder' => 'seeValues'
            )
        );
    }

    public function seeInField(&$file, $numberReference = 999, $placeholder = 'seeInFields')
    {
        $dbColumns = $this->getTableData();
        $seeInField = [***REMOVED***;
        foreach ($dbColumns as $i => $column) {
            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                continue;
            }
            $seeInField[***REMOVED*** = array_merge(array(
                'name' => $column->getIdFormElement(),
                'value' => $column->getFixtureDefault($numberReference),


            ), $this->basicOptions());
        }
        $file->addChildView(
            array(
                'template' => 'template/test/acceptance/seeInField.phtml',
                'config'   => array('fixture' => $seeInField),
                'placeholder' => $placeholder
            )
        );


    }

    public function fillField(&$file, $numberReference = 1500, $placeholder = 'fillField')
    {
        $dbColumns = $this->getTableData();
        $seeInField = [***REMOVED***;
        foreach ($dbColumns as $i => $column) {
            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                continue;
            }
            $seeInField[***REMOVED*** = array_merge(array(
                'name' => $column->getIdFormElement(),
                'value' => $column->getFixtureDefault($numberReference),
            ), $this->basicOptions());
        }

        $file->addChildView(
            array(
                'template' => 'template/test/acceptance/fillField.phtml',
                'config'   => array('fixture' => $seeInField),
                'placeholder' => $placeholder
            )
        );
    }

    public function acceptanceEdit()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase($file);

        $this->seeInField($file, 999);
        $this->fillField($file, 1500);
        $this->seeInField($file, 1500, 'seeInFieldAfterFill');


        $file->setView('template/test/acceptance/action-edit.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sEditCest.php', $this->tableName));
        return $file->render();
    }

    public function acceptanceView()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase($file, 1300);
        $this->seeLabels($file);
        $this->seeValues($file, 1300);

        $file->setView('template/test/acceptance/action-view.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sViewCest.php', $this->tableName));
        return $file->render();
    }

    public function acceptanceList()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $mapping = $this->getServiceLocator()->get('RepositoryService\MappingService');
        $mapping->setAliaseStack(array('e'));
        $mapping->getRepositoryMapping();
        $tableCount = $mapping->getCountTableHead();

        $file->setView('template/test/acceptance/action-list.phtml');
        $file->setOptions(array_merge(array('tableHeadCount' => $tableCount+1), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sListCest.php', $this->tableName));
        return $file->render();
    }

    public function acceptanceDelete()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase($file);
        $mapping = $this->getServiceLocator()->get('RepositoryService\MappingService');
        $mapping->getRepositoryMapping();

        $file->setView('template/test/acceptance/action-delete.phtml');
        $file->setOptions(array_merge(array('actionRow' => $mapping->getCountTableHead()+1), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName(sprintf('%sDeleteCest.php', $this->tableName));
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
