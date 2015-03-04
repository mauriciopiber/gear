<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractFileCreator;
use Gear\Service\Column\SearchFormInterface;

class ViewService extends AbstractFileCreator
{
    protected $timeTest;

    protected $locationDir;

    protected $specialityService;


    /**
     * view/$moduleUrl/view.phtml
     * @param Gear\ValueObject\Action $action
     */
    public function createActionView($action)
    {

        $viewValues = $this->getViewValues($action);

        $moduleUrl = $this->str('url', $this->getConfig()->getModule());
        $tableUrl  = $this->str('url', $action->getController()->getNameOff());


        if ($action->getDb()->getUser() == 'strict') {
            $dbType = 'all';
        } else {
            $dbType = $action->getDb()->getUser();
        }

        $this->addChildView(array(
            'template' => sprintf('template/view/view.table.actions.%s.phtml', $dbType),
            'placeholder' => 'actions',
        	'config' =>
            array(
                'routeEdit' =>  sprintf('%s/%s/edit', $moduleUrl, $tableUrl),
                'routeList' =>  sprintf('%s/%s/list', $moduleUrl, $tableUrl),
                'routeView' =>  sprintf('%s/%s/view', $moduleUrl, $tableUrl),
                'routeCreate' =>  sprintf('%s/%s/create', $moduleUrl, $tableUrl),
                'routeDelete' =>  sprintf('%s/%s/delete', $moduleUrl, $tableUrl),
                )
            )
        );

        $this->setView('template/view/view.table.phtml');
        $this->setLocation($this->getLocationDir());
        $this->setFileName('view.phtml');
        $this->setConfigVars( array(
            'label' => $this->str('label', $action->getController()->getNameOff()),
            'values' => $viewValues,
        ));

        return $this->render();

    }


    public function getViewValues($action)
    {
        $names = [***REMOVED***;

        $this->tableName = $this->str('class', $action->getController()->getNameOff());
        $data = $this->getTableData();

        foreach ($data as $i => $columnData) {

            if (
                $columnData instanceof \Gear\Service\Column\Varchar\UniqueId ||
                $columnData instanceof \Gear\Service\Column\Varchar\PasswordVerify
            ) {
                continue;
            }

            $names[***REMOVED*** = $columnData->getViewData();
        }
        return $names;
    }

    public function introspectFromTable($table)
    {
        $controller = $this->getGearSchema()->getControllerByDb($table);

        $this->createDirectoryFromIntrospect($controller);

        foreach ($controller->getAction() as $action) {
            $action->setController($controller);
            $action->setDb($table);

            switch($action->getName()) {
            	case 'List':
            	    $this->createActionList($action);
            	    break;
            	case 'Create':
            	    $this->createActionAdd($action);
            	    break;
            	case 'Edit':
            	    $this->createActionEdit($action);
            	    break;
            	case 'UploadImage':
            	    $this->createActionImage($action);
            	    break;
        	    case 'View':
        	        $this->createActionView($action);
        	        break;
            	default:
            	    break;
            }
        }

    }

    public function createTemplateUpload()
    {
        return $this->createFileFromCopy(
            'template/view/imagem/template-upload',
            'template-upload.phtml',
            $this->getLocationDir()
        );
    }

    public function createTemplateForm()
    {
        return $this->createFileFromTemplate(
            'template/view/imagem/template-form.phtml',
            array(
        	    'module' => $this->str('url', $this->getConfig()->getModule())
            ),
            'template-form.phtml',
            $this->getLocationDir()
        );
    }


    public function copyBasicLayout()
    {
        $source = __DIR__.'/../../Template/Layout/sb-admin-2';
        $dest   = $this->getModule()->getPublicFolder().'/sb-admin-2';
        return $this->getDirService()->xcopy(
            $source,
            $dest
        );
    }



    public function createTemplateControl()
    {
        return $this->createFileFromCopy(
            'template/view/imagem/template-control',
            'template-control.phtml',
            $this->getLocationDir()
        );
    }

    public function createTemplateDownload()
    {
        return $this->createFileFromCopy(
            'template/view/imagem/template-download',
            'template-download.phtml',
            $this->getLocationDir()
        );
    }

    public function createActionImage($action)
    {
        $this->tableName = ($this->str('class',$action->getController()->getNameOff()));

        $this->createFileFromTemplate(
            'template/view/image.table.phtml',
            array(
                'route' =>  sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'class' => $this->str('class', $action->getController()->getNameOff()),
            ),
            'upload-image.phtml',
            $this->getLocationDir()
        );
    }


    public function createFormElements()
    {
        $dbColumns = $this->getTableData();

        $formElements = [***REMOVED***;
        foreach ($dbColumns as $i => $columnData) {

            if ($columnData instanceof \Gear\Service\Column\Varchar\UniqueId) {
                continue;
            }


            if ($columnData instanceof \Gear\Service\Column\AbstractColumn) {
                $formElements[***REMOVED*** = array('element' => $columnData->getViewFormElement());
            }

        }

        return $formElements;
    }

    public function createActionAdd($action)
    {
        $this->tableName = ($this->str('class',$action->getController()->getNameOff()));

        $routeCreate = sprintf('%s/%s/create', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));
        $routeImage  = sprintf('%s/%s/image', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));
        $routeList   = sprintf('%s/%s/list', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));


        $fileCreator = $this->getServiceLocator()->get('fileCreator');


        $fileCreator->addChildView(array(
        	'template' => 'template/view/collection/element.phtml',
            'config' => array('elements' => $this->createFormElements()),
            'placeholder' => 'formElements'
        ));


        $fileCreator->setView('template/view/add.table.phtml');
        $fileCreator->setOptions(array(
            'imageContainer' => false,
            'module' => $this->str('class', $this->getConfig()->getModule()),
            'controller' => $this->str('class', $action->getController()->getName()),
            'label' => $this->str('label', $action->getController()->getNameOff()),
            'action' => $this->str('class', $action->getName()),
            'class' => $this->str('class', $action->getController()->getNameOff()),
            'route' =>  $routeCreate,
            'routeImage' => $routeImage,
            'routeBack' => $routeList
        ));
        $fileCreator->setFileName('create.phtml');
        $fileCreator->setLocation($this->getLocationDir());


        return $fileCreator->render();
    }

    public function createActionEdit($action)
    {
        if ($this->verifyUploadImageAssociation($this->str('class', $action->getController()->getNameOff()))) {
            $imageContainer = true;
        } else {
            $imageContainer = false;
        }

        $routeCreate = sprintf('%s/%s/create', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));
        $routeImage  = sprintf('%s/%s/upload-image', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));
        $routeList   = sprintf('%s/%s/list', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));
        $routeEdit   = sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));
        $routeView   = sprintf('%s/%s/view', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()));

        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $fileCreator->addChildView(array(
            'template' => 'template/view/collection/element.phtml',
            'config' => array('elements' => $this->createFormElements()),
            'placeholder' => 'formElements'
        ));

        $fileCreator->setTemplate('template/view/edit.table.phtml');
        $fileCreator->setOptions(array(
            'imageContainer' => $imageContainer,
            //'elements' => $viewFormService->getFormElements($action),
            'label' => $this->str('label', $action->getController()->getNameOff()),
            'module' => $this->str('class', $this->getConfig()->getModule()),
            'controller' => $this->str('class', $action->getController()->getName()),
            'action' => $this->str('class', $action->getName()),
            'class' => $this->str('class', $action->getController()->getNameOff()),
            'route' =>  $routeEdit,
            'routeImage' => $routeImage,
            'routeBack' => $routeList,
            'routeNew' => $routeCreate,
            'routeView' => $routeView
        ));
        $fileCreator->setFileName('edit.phtml');
        $fileCreator->setLocation($this->getLocationDir());

        return $fileCreator->render();

    }


    public function createSearch()
    {

        $this->createFileFromTemplate(
            'template/view/search.table.phtml',
            array(
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'tableUrl' => $this->str('url', $this->action->getController()->getNameOff()),
                'elements' => $this->getSearchElements()
            ),
            'search-form.phtml',
            $this->getLocationDir()
        );
    }

    public function getSearchElements()
    {
        $dbColumns = $this->getTableData();

        $formElements = [***REMOVED***;

        foreach ($dbColumns as $i => $columnData) {

            if ($columnData instanceof SearchFormInterface) {
                $formElements[***REMOVED*** = $columnData->getSearchViewElement();
            }

        }


        return $formElements;
    }

    public function createListView()
    {
        $this->createFileFromTemplate(
            'template/view/list.table.phtml',
            array(
                'label' => $this->str('label', $this->action->getController()->getNameOff()),
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $this->action->getController()->getName()),
                'tableUrl' => $this->str('url', $this->action->getController()->getNameOff()),
                'var' => $this->str('var', $this->action->getController()->getNameOff()),
                'action' => $this->str('class', $this->action->getName()),
                'controllerViewFolder' => sprintf('%s/%s', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $this->action->getController()->getNameOff()))
            ),
            'list.phtml',
            $this->getLocationDir()
        );
    }

    public function createListRowView()
    {

       if ($this->action->getDb()->getUser() == 'strict') {
            $dbType = 'all';
        } else {
            $dbType = $this->action->getDb()->getUser();
        }

        $this->addChildView(array(
            'template' => sprintf('template/view/list-row-actions-%s.phtml', $dbType),
            'placeholder' => 'actions',
            'config' => array(
                'routeEdit' => sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $this->action->getController()->getNameOff())),
                'routeDelete' => sprintf('%s/%s/delete', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $this->action->getController()->getNameOff())),
                'routeView' => sprintf('%s/%s/view', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $this->action->getController()->getNameOff())),
                'getId' => $this->str('var', $this->action->getDb()->getPrimaryKeyColumnName()),
                'classLabel' => $this->str('label', str_replace('Controller', '', $this->action->getController()->getName())),
            )
        ));


        $this->setLocation($this->getLocationDir());
        $this->setFileName('row.phtml');
        $this->setView('template/view/list-row.table.phtml');
        $this->setConfigVars(array(
            'module' => $this->str('class', $this->getConfig()->getModule()),
            'controller' => $this->str('class', $this->action->getController()->getName()),
            'action' => $this->str('class', $this->action->getName()),
            'elements' => $this->getListRowElements(),
        ));

        return $this->render();
    }

    public function getListRowElements()
    {
        $dbColumns = $this->getTableData();

        $formElements = [***REMOVED***;

        foreach ($dbColumns as $i => $columnData) {

            if (
                $columnData instanceof \Gear\Service\Column\Text
                || $columnData instanceof \Gear\Service\Column\Varchar\UploadImage
                || $columnData instanceof \Gear\Service\Column\Varchar\PasswordVerify
                || $columnData instanceof \Gear\Service\Column\Varchar\UniqueId
                || $columnData instanceof \Gear\Service\Column\Int\Checkbox
            ) {
                continue;
            }
            $formElements[***REMOVED*** = $columnData->getViewListRowElement();

        }
        return $formElements;
    }

    //public function create


    public function createActionList($action)
    {
        $this->action = $action;
        $this->columns = $action->getDb()->getTableColumns();

        $this->createSearch();
        $this->createListView();
        $this->createListRowView();
    }

    public function createDirectoryFromIntrospect($controller)
    {
        $controllerDir = sprintf(
            '%s/module/%s/view/%s/%s',
            $this->getConfig()->getLocal(),
            $this->getConfig()->getModule(),
            $this->str('url', $this->getConfig()->getModule()),
            $this->str('url', str_replace('Controller', '',$controller->getName()))
        );

        if (!is_dir($controllerDir)) {
            $this->getDirService()->mkDir($controllerDir);
        }
        $this->setLocationDir($controllerDir);


        return $controllerDir;
    }


    public function create404View()
    {
        return $this->createFileFromCopy(
            'template/view/error/404',
            '404.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/error'
        );
    }

    public function createDirectory($page)
    {

        $controllerDir = sprintf(
            '%s/module/%s/view/%s/%s',
            $this->getConfig()->getLocal(),
            $this->getConfig()->getModule(),
            $this->str('url', $this->getConfig()->getModule()),
            $this->str('url', str_replace('Controller', '',$page->getController()->getName()))
        );

        if (!is_dir($controllerDir)) {
            $this->getDirService()->mkDir($controllerDir);
        }
        $this->setLocationDir($controllerDir);

        return true;

    }

    public function createFromPage(\Gear\ValueObject\Action $page)
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createDirectory($page);

        $filename     = sprintf('%s.phtml', $this->str('url', $page->getName()));
        $filelocationDir = sprintf(
            '%s/module/%s/view/%s/%s',
            $this->getConfig()->getLocal(),
            $this->getConfig()->getModule(),
            $this->str('url', $this->getConfig()->getModule()),
            $this->str('url', str_replace('Controller', '',$page->getController()->getName())),
            $this->str('url', $page->getName())
        );

        $this->setTimeTest(new \DateTime('now'));

        $this->createFileFromTemplate(
            'template/view/simple.page.phtml',
            array(
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $page->getController()->getName()),
                'action' => $this->str('class', $page->getName()),
                'version' => $this->getVersion(),
                'date' => $this->getTimeTest()->format('d-m-Y H:i:s')
            ),
            $filename,
            $filelocationDir
        );

    }

    /**
     * Obrigatório para novos módulos
     * view/layout/delete.phtml
     */
    public function createDeleteView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/delete',
            'delete.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }

    public function createLayoutSuccessView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/success',
            'success.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }


    public function createLayoutDeleteSuccessView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/delete-success',
            'delete-success.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }



    public function createLayoutDeleteFailView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/delete-fail',
            'delete-fail.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }

    public function createLayoutView()
    {
        return $this->createFileFromCopy(
            'template/view/layout.phtml',
            'layout.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }


    public function createBreadcrumbView()
    {
        return $this->createFileFromCopy(
            'template/view/breadcrumb.phtml',
            'breadcrumb.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }


    public function createErrorView()
    {
        return $this->createFileFromCopy(
            'template/view/error.phtml',
            'index.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/error'
        );
    }


    public function createIndexView()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'template/view/simple.module.phtml',
            array(
                'module' => $this->str('label', $this->getConfig()->getModule()),
                'version' => $config['version'***REMOVED***
            ),
            'index.phtml',
            sprintf(
                '%s/module/%s/view/%s/index',
                $this->getConfig()->getLocal(),
                $this->getConfig()->getModule(),
                $this->str('url', $this->getConfig()->getModule())
            )
        );
    }


    public function getTimeTest()
    {
        return $this->timeTest;
    }

    public function setTimeTest(\DateTime $timeTest)
    {
        $this->timeTest = $timeTest;
        return $this;
    }

	public function getLocationDir()
	{
		return $this->locationDir;
	}

	public function setLocationDir($locationDir)
	{
		$this->locationDir = $locationDir;
		return $this;
	}

	public function getSpecialityService()
	{
	    if (!isset($this->specialityService)) {
	        $this->specialityService = $this->getServiceLocator()->get('specialityService');
	    }
	    return $this->specialityService;
	}


}
