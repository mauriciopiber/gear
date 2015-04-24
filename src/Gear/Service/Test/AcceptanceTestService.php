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

        if ($this->verifyUploadImageAssociation($table->getTable())) {
            $this->acceptanceUploadImage();
        }
    }

    public function acceptanceUploadImage()
    {

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

            if (in_array(get_class($column, array(
            	'Gear\Service\Column\Varchar\PasswordVerify',
                'Gear\Service\Column\Varchar\UniqueId',
            )))) {

                continue;

            }

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
        $fillFieldCheckbox   = [***REMOVED***;
        $fillFieldSelect = [***REMOVED***;
        foreach ($dbColumns as $i => $column) {
            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey
             || $column instanceof \Gear\Service\Column\Text) {
                continue;
            }

            if ($column instanceof \Gear\Service\Column\AbstractCheckbox) {
                $fillFieldCheckbox[***REMOVED*** = array_merge(array(
                    'name' => $column->getIdFormElement(),
                    'value' => $column->getFixtureDefault($numberReference),
                ), $this->basicOptions());
                continue;
            }

            if ($column instanceof \Gear\Service\Column\Int\ForeignKey) {
                $fillFieldSelect[***REMOVED*** = array_merge(array(
                    'name' => $column->getIdFormElement(),
                    'value' => $column->getFixtureDefault($numberReference),
                ), $this->basicOptions());
                continue;
            }


            if ($column instanceof \Gear\Service\Column\Decimal) {
                $fillField[***REMOVED*** = array_merge(array(
                    'name' => $column->getIdFormElement(),
                    'value' => $column->getFixtureDefaultDb($numberReference),
                ), $this->basicOptions());
                continue;
            }

            $seeInField[***REMOVED*** = array_merge(array(
                'name' => $column->getIdFormElement(),
                'value' => $column->getFixtureDefault($numberReference),


            ), $this->basicOptions());
        }

        if (count($seeInField)>0) {
            $file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/seeInField.phtml',
                    'config'   => array('fixture' => $seeInField),
                    'placeholder' => $placeholder
                )
            );
        }

        if (count($fillFieldCheckbox)>0) {

            $file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/seeInFieldCheckbox.phtml',
                    'config'   => array('fixture' => $fillFieldCheckbox),
                    'placeholder' => $placeholder.'Checkbox'
                )
            );
        }

        if (count($fillFieldSelect)>0) {

            $file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/seeInFieldSelect.phtml',
                    'config'   => array('fixture' => $fillFieldSelect),
                    'placeholder' => $placeholder.'Select'
                )
            );
        }

    }

    public function fillField(&$file, $numberReference = 1500, $placeholder = 'fillField')
    {
        $dbColumns = $this->getTableData();
        $fillField = [***REMOVED***;
        $fillFieldCheckbox = [***REMOVED***;
        $fillFieldJs = [***REMOVED***;
        $fillFieldForeignKey = [***REMOVED***;
        foreach ($dbColumns as $i => $column) {
            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey
             || $column instanceof \Gear\Service\Column\Text) {
                continue;
            }

            if ($column instanceof \Gear\Service\Column\AbstractDateTime) {
                $fillFieldJs[***REMOVED*** = array_merge(array(
                    'name' => $column->getIdFormElement(),
                    'value' => $column->getFixtureDefault($numberReference),
                ), $this->basicOptions());
                continue;
            }

            if ($column instanceof \Gear\Service\Column\AbstractCheckbox) {
                $fillFieldCheckbox[***REMOVED*** = array_merge(array(
                    'name' => $column->getIdFormElement(),
                    'value' => $column->getFixtureDefault($numberReference),
                ), $this->basicOptions());
                continue;
            }

            if ($column instanceof \Gear\Service\Column\Int\ForeignKey) {
                $fillFieldForeignKey[***REMOVED*** = array_merge(array(
                    'name' => $column->getIdFormElement(),
                    'value' => $column->getFixtureDefault($numberReference),
                ), $this->basicOptions());
                continue;
            }

            if ($column instanceof \Gear\Service\Column\Decimal) {
                $fillField[***REMOVED*** = array_merge(array(
                    'name' => $column->getIdFormElement(),
                    'value' => $column->getFixtureDefaultDb($numberReference),
                ), $this->basicOptions());
                continue;
            }

            $fillField[***REMOVED*** = array_merge(array(
                'name' => $column->getIdFormElement(),
                'value' => $column->getFixtureDefault($numberReference),
            ), $this->basicOptions());
        }

        if (count($fillField)>0) {
            $file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillField.phtml',
                    'config'   => array('fixture' => $fillField),
                    'placeholder' => $placeholder
                )
            );
        }

        if (count($fillFieldCheckbox)>0) {
            $file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillFieldCheckbox.phtml',
                    'config'   => array('fixture' => $fillFieldCheckbox),
                    'placeholder' => $placeholder.'Checkbox'
                )
            );
        }

        if (count($fillFieldJs)) {
            $file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillFieldJS.phtml',
                    'config'   => array('fixture' => $fillFieldJs),
                    'placeholder' => $placeholder.'JS'
                )
            );
        }

        if (count($fillFieldForeignKey)) {
            $file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillFieldSelect.phtml',
                    'config'   => array('fixture' => $fillFieldForeignKey),
                    'placeholder' => $placeholder.'Select'
                )
            );
        }


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



        $file->setView('template/test/acceptance/action-list.phtml');
        $file->setOptions(array_merge(array('tableHeadCount' => $this->getTableHeadCount()+1), $this->basicOptions()));
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
