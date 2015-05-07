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

        if ($this->verifyUploadImageAssociation($table->getTable())) {
            $this->functionalUploadImage();
        }

        //verifica se a tabela está vinculada a imagem
    }



    public function buildUploadImageSteps()
    {
        $file = $this->getServiceLocator()->get('fileCreator');
        $file->setView('template/test/functional/steps/upload-image-steps.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalStepsFolder());
        $file->setFileName(sprintf('UploadImageSteps.php', $this->tableName));
        return $file->render();
    }


    public function functionalUploadImage()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase();

        $file->setView('template/test/functional/action-upload-image.phtml');
        $file->setOptions(array_merge(array(), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sUploadImageCest.php', $this->tableName));
        return $file->render();
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

        if ($this->verifyUploadImageAssociation($this->tableName)) {
            if (!is_file($this->getModule()->getTestFunctionalStepsFolder().'/UploadImageSteps.php')) {
                $this->buildUploadImageSteps();
            }
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

        $this->preFixture();
        $this->fixtureDatabase(500);

        $file->setView('template/test/functional/action-edit.phtml');
        $file->setOptions(array_merge(array('fixture' => $this->fixture, 'preFixture' => $this->preFixture), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sEditCest.php', $this->tableName));
        return $file->render();
    }

    public function functionalView()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->preFixture();
        $this->fixtureDatabase(1600);

        $this->viewSeeValues($file, 1600);
        $this->viewSeeLabels($file);

        $this->functions  = '';
        $this->posFixture = '';

        if ($this->verifyUploadImageAssociation($this->tableName)) {

            $uploadImage = new \Gear\Table\UploadImage();
            $uploadImage->setServiceLocator($this->getServiceLocator());
            $uploadImage->setModule($this->getModule());

            $this->functions .= $uploadImage->getFunctionalViewTest($this->tableName);

            $this->posFixture .= $uploadImage->getPosFixture($this->tableName);
        }

        $file->setView('template/test/functional/action-view.phtml');
        $file->setOptions(array_merge(array(
            'fixture' => $this->fixture,
            'functions' => $this->functions,
            'posFixture' => $this->posFixture,
            'preFixture' => $this->preFixture,
            'seeValue' => $this->seeValue,
            'seeLabel' => $this->seeLabel,
        ), $this->basicOptions()));
        $file->setLocation($this->getModule()->getTestFunctionalFolder());
        $file->setFileName(sprintf('%sViewCest.php', $this->tableName));
        return $file->render();
    }


    public function viewSeeValues($file, $numberReference = 500, $placeholder = 'viewSeeValues')
    {
        $dbColumns = $this->getTableData();
        $this->seeValue = '';

        $position = 1;

        $module = $this->getModule()->getModuleName();
        $table = $this->str('class', $this->db->getTable());

        foreach ($dbColumns as $i => $column) {

            if (in_array(get_class($column), array(
            	'Gear\Service\Column\Varchar\UniqueId',
                'Gear\Service\Column\Varchar\PasswordVerify',
            ))) {
                continue;

            }

            if ($column instanceof \Gear\Service\Column\Varchar\UploadImage) {

                $this->seeValue .= $column->getFunctionalTestSeeValue($numberReference, $position);
                $position += 1;
                continue;
            }



            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                $value = '$this->fixture';
            } elseif ($column instanceof \Gear\Service\Column\Varchar\Email) {
                $value = '\''.$column->getValueFormat($numberReference).'\'';
            } else {
                $value = '\''.$column->getFixtureDefault($numberReference).'\'';
            }
            $this->seeValue .= <<<EOS
        \$I->see($value, {$table}ViewPage::getValueByIndex($position));

EOS;

            $position += 1;
        }

        return true;

    }



    public function viewSeeLabels($file, $placeholder = 'viewSeeLabels')
    {
        $this->seeLabel = '';

        $module = $this->getModule()->getModuleName();
        $table = $this->str('class', $this->db->getTable());


        $dbColumns = $this->getTableData();

        $position = 1;

        foreach ($dbColumns as $i => $column) {
            if (in_array(get_class($column), array(
                'Gear\Service\Column\Varchar\UniqueId',
                'Gear\Service\Column\Varchar\PasswordVerify',
            ))) {
                continue;

            }

            if ($column instanceof \Gear\Service\Column\Int\PrimaryKey) {
                $value = 'ID';
            } else {
                $value = $this->str('label', $column->getColumn()->getName());
            }


            $this->seeLabel .= <<<EOS
        \$I->see('$value', {$table}ViewPage::getLabelByIndex($position));

EOS;

            $position += 1;
        }

    }



    public function functionalList()
    {
        $this->listCest = $this->getServiceLocator()->get('fileCreator');

        if ($this->db->getUserClass() == 'strict') {
            $this->listCest->setView('template/test/functional/list/strict.phtml');
        } else {
            $this->listCest->setView('template/test/functional/list/all.phtml');
        }


        $this->listCest->setOptions(
            array_merge(
                array('tableHeadCount' => $this->getTableHeadCount()+1),
                $this->basicOptions()
            )
        );
        $this->listCest->setLocation($this->getModule()->getTestFunctionalFolder());
        $this->listCest->setFileName(sprintf('%sListCest.php', $this->tableName));
        return $this->listCest->render();
    }

    public function functionalDelete()
    {
        $file = $this->getServiceLocator()->get('fileCreator');

        $this->fixtureDatabase();
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
