<?php
namespace Gear\Service\Test;

use Gear\Service\AbstractJsonService;
use Gear\ValueObject\Action;

class FunctionalTestService extends AbstractJsonService
{
    protected $timeTest;

    public function generateForEmptyModule()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'template/test/functional/simple.module.functionaltest.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
                'version' => $config['version'***REMOVED***
            ),
            'ModuleMainPageCest.php',
            $this->getModule()->getTestFunctionalFolder()
        );
    }


    public function createAction(Action $action)
    {
        $model = $this->getRequest()->getParam('model', 'view');

        if ($model == 'json') {

            return;
            $basic = <<<EOS
        \$I->see('[***REMOVED***');
EOS;

        } else {

            $basic = <<<EOS
        \$I->see('Gear');
EOS;
        }


        $name = sprintf(
            '%s%s',
            $this->str('class', $action->getController()->getName()),
            $this->str('class', $action->getName ())
        );

        $moduleLabel = $this->str('label', $this->getModule()->getModuleName());
        $controllerLabel = $this->str('label', $action->getController()->getNameOff());
        $actionLabel = $this->str('label', $action->getName());


        return $this->createFileFromTemplate(
            'template/test/functional/action.phtml',
            array(
                'module'          => $this->getModule()->getModuleName(),
                'className'       => $name,
                'moduleLabel'     => $moduleLabel,
                'controllerLabel' => $controllerLabel,
                'actionLabel'     => $actionLabel,
                'iSee'            => $basic
            ),
            $name.'Cest.php',
            $this->getModule()->getTestFunctionalFolder()
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

        $this->functions  = '';
        $this->posFixture = '';

        if ($this->verifyUploadImageAssociation($this->tableName)) {

            $uploadImage = new \Gear\Table\UploadImage();
            $uploadImage->setServiceLocator($this->getServiceLocator());
            $uploadImage->setModule($this->getModule());

            $this->functions .= $uploadImage->getFunctionalUploadImageTest($this->tableName);

            $this->posFixture .= $uploadImage->getPosFixture($this->tableName);
        }

        $file->setView('template/test/functional/action-upload-image.phtml');
        $file->setOptions(array_merge(array('functions' => $this->functions, 'posFixture' => $this->posFixture), $this->basicOptions()));
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

        $this->viewSeeLabels($file);
        $this->viewSeeValues($file, 1600);

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
                'Gear\Column\Varchar\UniqueId',
                'Gear\Column\Varchar\PasswordVerify',
            ))) {
                continue;

            }

            if ($column instanceof \Gear\Column\Varchar\UploadImage) {

                $this->seeValue .= $column->getFunctionalTestSeeValue($numberReference, $position);
                $position += 1;
                continue;
            }

            if ($this->tableName == 'User' && $column->getColumn()->getName() == 'id_role') {
                $value = '\'guest\'';
            } elseif ($this->tableName == 'Role' && $column->getColumn()->getName() == 'id_parent') {
                $value = '\'guest\'';
            } elseif ($column instanceof \Gear\Column\Int\PrimaryKey) {
                $value = '$this->fixture';
            } elseif ($column instanceof \Gear\Column\Varchar\Email) {
                $value = '\''.$column->getValueFormat($numberReference).'\'';
            } else {

                if ($column instanceof \Gear\Column\Varchar) {
                    $value = $column->getFixtureDefault($numberReference);
                    $value = '\''.substr($value, 0, $column->getColumn()->getCharacterMaximumLength()).'\'';
                } else {
                    $value = '\''.$column->getFixtureDefault($numberReference).'\'';
                }


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
                'Gear\Column\Varchar\UniqueId',
                'Gear\Column\Varchar\PasswordVerify',
            ))) {
                continue;

            }

            if ($column instanceof \Gear\Column\Int\PrimaryKey) {
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

        $options = [***REMOVED***;

        if ($this->db->getUserClass() == 'strict') {
            $options['exibir'***REMOVED*** = 5;
            $options['maximo'***REMOVED*** = 5;
            $options['paginar'***REMOVED*** = 'false';
        } else {
            $options['exibir'***REMOVED*** = 10;
            $options['maximo'***REMOVED*** = 30;
            $options['paginar'***REMOVED*** = 'true';
            $this->listCest->setView('template/test/functional/list/all.phtml');
        }
        if ($this->tableName == 'Role') {
            $options['maximo'***REMOVED*** = 32;
            $options['paginar'***REMOVED*** = 'false';
        }

        if ($this->tableName == 'User') {
            $options['maximo'***REMOVED*** = 37;
            $options['paginar'***REMOVED*** = 'false';
        }


        $this->listCest->setOptions(
            array_merge(
                $options,
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
                'module' => $this->str('class', $this->getModule()->getModuleName()),
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