<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;
use Gear\Service\Column\Varchar\UploadImage;
use Gear\Service\Column\Int\PrimaryKey;

class AcceptanceTestService extends AbstractJsonService
{
    protected $timeTest;

    /**
     * Basic Action.
     */
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
            'ModuleMainPageCest.php',
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
        $this->fileUploadImage = $this->getServiceLocator()->get('fileCreator');
        $this->fileUploadImage->setView('template/test/acceptance/action-upload-image.phtml');
        $this->fileUploadImage->setOptions(array_merge(array(), $this->basicOptions()));
        $this->fileUploadImage->setLocation($this->getModule()->getTestAcceptanceFolder());
        $this->fileUploadImage->setFileName(sprintf('%sUploadImageCest.php', $this->tableName));

        return $this->fileUploadImage->render();
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

        if (!is_file($this->getModule()->getTestAcceptanceStepsFolder().'/UploadImageSteps.php')) {
            $this->buildUploadImageSteps();
        }
    }

    /**
     * Steps
     */
    public function buildUploadImageSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/upload-image-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('UploadImageSteps.php');
        return $file->render();
    }

    /**
     * Steps
     */
    public function buildListSteps()
    {

        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/list-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('ListSteps.php');
        return $file->render();
    }

    /**
     * Steps
     */
    public function buildCreateSteps()
    {

        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/create-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('CreateSteps.php');
        return $file->render();
    }

    /**
     * Steps
     */
    public function buildEditSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/edit-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('EditSteps.php');
        return $file->render();
    }

    /**
     * Steps
     */
    public function buildDeleteSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/delete-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('DeleteSteps.php');
        return $file->render();
    }

    /**
     * Steps
     */
    public function buildViewSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/steps/view-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceStepsFolder());
        $file->setFileName('ViewSteps.php');
        return $file->render();
    }

    /**
     * Abstract
     */
    public function buildAbstractCest()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/acceptance/abstract-cest.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $file->setFileName('AbstractCest.php');
        return $file->render();
    }

    /**
     * Abstract
     */
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
        $this->file = $this->getServiceLocator()->get('fileCreator');

        $this->seeInFieldNew(1200);
        $this->fillFieldNew(1200);

        $this->file->setView('template/test/acceptance/action-create.phtml');
        $this->file->setOptions(array_merge(array('fillField' => $this->fillField, 'seeInField' => $this->seeInField), $this->basicOptions()));
        $this->file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $this->file->setFileName(sprintf('%sCreateCest.php', $this->tableName));
        return $this->file->render();
    }

    public function acceptanceEdit()
    {
        $this->file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase(999);

        $this->preFixture();

        $this->seeInFieldNew(999);
        $this->fillFieldNew(1500);

        $this->seeInFieldNew(1500, $this->seeInFieldAfter);

        $this->file->setView('template/test/acceptance/action-edit.phtml');
        $this->file->setOptions(
            array_merge(
                array(
                    'preFixture'      => $this->preFixture,
                    'seeInField'      => $this->seeInField,
                    'fillField'       => $this->fillField,
                    'seeInFieldAfter' => $this->seeInFieldAfter,
                    'fixture'         => $this->fixture
                ),
                $this->basicOptions()
            )
        );
        $this->file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $this->file->setFileName(sprintf('%sEditCest.php', $this->tableName));
        return $this->file->render();
    }

    public function acceptanceView()
    {
        $this->file = $this->getServiceLocator()->get('fileCreator');

        $this->preFixture();

        $this->fixtureDatabase(1300);

        $this->seeLabels();
        $this->seeValues(1300);

        $this->functions  = '';
        $this->posFixture = '';

        if ($this->verifyUploadImageAssociation($this->tableName)) {

            $uploadImage = new \Gear\Table\UploadImage();
            $uploadImage->setServiceLocator($this->getServiceLocator());
            $uploadImage->setModule($this->getModule());

            $this->functions .= $uploadImage->getAcceptanceViewTest($this->tableName);

            $this->posFixture .= $uploadImage->getPosFixture($this->tableName);
        }

        $this->file->setView('template/test/acceptance/action-view.phtml');
        $this->file->setOptions(
            array_merge(
                array(
                    'functions' => $this->functions,
                    'posFixture' => $this->posFixture,
                    'preFixture' => $this->preFixture,
                    'seeLabel' => $this->seeLabel,
                    'seeValue' => $this->seeValue,
                    'fixture' => $this->fixture
                ),
                $this->basicOptions()
            )
        );
        $this->file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $this->file->setFileName(sprintf('%sViewCest.php', $this->tableName));
        return $this->file->render();
    }

    public function acceptanceList()
    {
        $this->file = $this->getServiceLocator()->get('fileCreator');

        if ($this->db->getUserClass() == 'strict') {
            $this->file->setView('template/test/acceptance/list/strict.phtml');
        } else {
            $this->file->setView('template/test/acceptance/list/all.phtml');
        }

        $this->file->setOptions(array_merge(array('tableHeadCount' => $this->getTableHeadCount()+1), $this->basicOptions()));
        $this->file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $this->file->setFileName(sprintf('%sListCest.php', $this->tableName));
        return $this->file->render();
    }

    public function acceptanceDelete()
    {
        $this->file = $this->getServiceLocator()->get('fileCreator');
        $this->preFixture();
        $this->fixtureDatabase(998);
        $mapping = $this->getServiceLocator()->get('RepositoryService\MappingService');
        $mapping->getRepositoryMapping();

        $key = 31;

        foreach ($this->getTableData() as $column) {

            if ($column instanceof PrimaryKey) {
                continue;
            }

            if (!($column instanceof UploadImage)) {
                $key = 998;
            }
        }

        $this->file->setView('template/test/acceptance/action-delete.phtml');
        $this->file->setOptions(
            array_merge(
                array('fixtureNumber' => $key, 'fixture' => $this->fixture, 'preFixture' => $this->preFixture, 'actionRow' => $mapping->getCountTableHead()+1, 'key' => $key),
                $this->basicOptions()
            )
        );
        $this->file->setLocation($this->getModule()->getTestAcceptanceFolder());
        $this->file->setFileName(sprintf('%sDeleteCest.php', $this->tableName));
        return $this->file->render();
    }


    public function seeLabels()
    {
        $this->seeLabel = '';

        $dbColumns = $this->getTableData();

        foreach ($dbColumns as $i => $column) {

            if (in_array(get_class($column), array(
                'Gear\Service\Column\Varchar\PasswordVerify',
                'Gear\Service\Column\Varchar\UniqueId',
            ))) {
                continue;
            }
            $this->seeLabel .= $column->getAcceptanceTestSeeLabel();
        }
    }

    public function seeValues($numberReference = 999)
    {
        $this->seeValue = '';

        $dbColumns = $this->getTableData();

        foreach ($dbColumns as $i => $column) {
            if (in_array(get_class($column), array(
                'Gear\Service\Column\Varchar\PasswordVerify',
                'Gear\Service\Column\Varchar\UniqueId',
                'Gear\Service\Column\Int\PrimaryKey'
            ))) {
                continue;
            }
            $this->seeValue .= $column->getAcceptanceTestSeeValue($numberReference);
        }

    }

    public function fillFieldNew($numberReference = 1500, $placeholder = 'fillField')
    {
        $this->fillField = '';
        $dbColumns = $this->getTableData();
        foreach ($dbColumns as $i => $column) {

            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey
            || $column instanceof \Gear\Service\Column\Text
            || $column instanceof \Gear\Service\Column\Varchar\UniqueId
            || $column instanceof \Gear\Service\Column\Varchar\UploadImage) {
                continue;
            }

            $this->fillField .= $column->getAcceptanceTestFillField($numberReference);
        }
    }

    public function seeInFieldNew($reference, &$column = null)
    {
        $seeInField = '';
        $this->seeInField = '';

        $dbColumns = $this->getTableData();
        foreach ($dbColumns as $i => $column) {

            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey
            || $column instanceof \Gear\Service\Column\Text
            || $column instanceof \Gear\Service\Column\Varchar\UploadImage
            || $column instanceof \Gear\Service\Column\Varchar\PasswordVerify
            || $column instanceof \Gear\Service\Column\Varchar\UniqueId) {

                continue;
            }

            $seeInField .= $column->getAcceptanceTestSeeInField($reference);
        }

        if ($column === null) {
            $this->seeInField = $seeInField;

            return true;
        }

        $column = $seeInField;
        return true;

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
            || $column instanceof \Gear\Service\Column\Text
            || $column instanceof \Gear\Service\Column\Varchar\UniqueId) {
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
            $this->file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillField.phtml',
                    'config'   => array('fixture' => $fillField),
                    'placeholder' => $placeholder
                )
            );
        }

        if (count($fillFieldCheckbox)>0) {
            $this->file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillFieldCheckbox.phtml',
                    'config'   => array('fixture' => $fillFieldCheckbox),
                    'placeholder' => $placeholder.'Checkbox'
                )
            );
        }

        if (count($fillFieldJs)) {
            $this->file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillFieldJS.phtml',
                    'config'   => array('fixture' => $fillFieldJs),
                    'placeholder' => $placeholder.'JS'
                )
            );
        }

        if (count($fillFieldForeignKey)) {
            $this->file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/fillFieldSelect.phtml',
                    'config'   => array('fixture' => $fillFieldForeignKey),
                    'placeholder' => $placeholder.'Select'
                )
            );
        }


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
            $this->file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/seeInField.phtml',
                    'config'   => array('fixture' => $seeInField),
                    'placeholder' => $placeholder
                )
            );
        }

        if (count($fillFieldCheckbox)>0) {

            $this->file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/seeInFieldCheckbox.phtml',
                    'config'   => array('fixture' => $fillFieldCheckbox),
                    'placeholder' => $placeholder.'Checkbox'
                )
            );
        }

        if (count($fillFieldSelect)>0) {

            $this->file->addChildView(
                array(
                    'template' => 'template/test/acceptance/collection/seeInFieldSelect.phtml',
                    'config'   => array('fixture' => $fillFieldSelect),
                    'placeholder' => $placeholder.'Select'
                )
            );
        }

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
