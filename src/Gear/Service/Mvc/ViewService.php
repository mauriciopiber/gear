<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractFileCreator;
use Gear\Service\Column\SearchFormInterface;
use Gear\Service\Mvc\AngularServiceTrait;

class ViewService extends AbstractFileCreator
{
    use AngularServiceTrait;
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

        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
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

        $this->images = '';
        if ($this->verifyUploadImageAssociation($this->tableName)) {

            $uploadImage = new \Gear\Table\UploadImage();
            $uploadImage->setServiceLocator($this->getServiceLocator());
            $this->images = $uploadImage->getViewView($this->tableName);
        }

        $this->setView('template/view/view.table.phtml');
        $this->setLocation($this->getLocationDir());
        $this->setFileName('view.phtml');
        $this->setConfigVars( array(
            'images' => $this->images,
            'label' => $this->str('label', $action->getController()->getNameOff()),
            'class' => $this->str('class', $action->getController()->getNameOff()),
            'values' => $viewValues,
        ));

        $viewFile = $this->render();


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
        $this->db = $table;
        $this->tableName = $table->getTable();


        $controller = $this->getGearSchema()->getControllerByDb($table);

        $this->createDirectoryFromIntrospect($controller);

        foreach ($controller->getAction() as $action) {
            $action->setController($controller);
            $action->setDb($table);

            switch($action->getName()) {
            	case 'List':
            	    $this->createActionList($action);
            	    $this->getAngularService()->createListAction($action);
            	    break;
            	case 'Create':
            	    $this->createActionAdd($action);
            	    $this->getAngularService()->createCreateAction($action);
            	    break;
            	case 'Edit':
            	    $this->createActionEdit($action);
            	    $this->getAngularService()->createEditAction($action);
            	    break;
            	case 'UploadImage':
            	    $this->createActionImage($action);
            	    break;
        	    case 'View':
        	        $this->createActionView($action);
        	        $this->getAngularService()->createViewAction($action);
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
        	    'module' => $this->str('url', $this->getModule()->getModuleName())
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
                'route' =>  sprintf('%s/%s/edit', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff())),
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

        $routeCreate = sprintf('%s/%s/create', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));
        $routeImage  = sprintf('%s/%s/image', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));
        $routeList   = sprintf('%s/%s/list', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));


        $fileCreator = $this->getServiceLocator()->get('fileCreator');


        $fileCreator->addChildView(array(
        	'template' => 'template/view/collection/element.phtml',
            'config' => array('elements' => $this->createFormElements()),
            'placeholder' => 'formElements'
        ));


        $fileCreator->setView('template/view/add.table.phtml');
        $fileCreator->setOptions(array(
            'imageContainer' => false,
            'module' => $this->str('class', $this->getModule()->getModuleName()),
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


        $routeCreate = sprintf('%s/%s/create', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));
        $routeImage  = sprintf('%s/%s/upload-image', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));
        $routeList   = sprintf('%s/%s/list', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));
        $routeEdit   = sprintf('%s/%s/edit', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));
        $routeView   = sprintf('%s/%s/view', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $action->getController()->getNameOff()));

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
            'module' => $this->str('class', $this->getModule()->getModuleName()),
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
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
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
                //$formElements[***REMOVED*** = $columnData->getSearchViewElement();
            }

        }


        return $formElements;
    }

    public function createListView($action)
    {



        $this->createFileFromTemplate(
            'template/view/list.table.phtml',
            array(
                'row' => $this->getListRow(),
                'label' => $this->str('label', $this->action->getController()->getNameOff()),
                'module' => $this->str('class', $this->getModule()->getModuleName()),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'class' => $this->str('class', $action->getController()->getNameOff()),
                'controller' => $this->str('class', $this->action->getController()->getName()),
                'tableUrl' => $this->str('url', $this->action->getController()->getNameOff()),
                'var' => $this->str('var', $this->action->getController()->getNameOff()),
                'action' => $this->str('class', $this->action->getName()),
                'controllerViewFolder' => sprintf('%s/%s', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $this->action->getController()->getNameOff()))
            ),
            'list.phtml',
            $this->getLocationDir()
        );
    }


    public function getActionButtons()
    {
        if ($this->action->getDb()->getUser() == 'strict') {
            $dbType = 'all';
        } else {
            $dbType = $this->action->getDb()->getUser();
        }


        return $this->getListActions($dbType);

    }

    public function getListActions($dbType)
    {


        $editAction =  sprintf('%s/%s/edit', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $this->action->getController()->getNameOff()));
        $viewAction =  sprintf('%s/%s/view', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $this->action->getController()->getNameOff()));

        $delAction =   sprintf('%s/%s/delete', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $this->action->getController()->getNameOff()));

        $primaryName = sprintf('%s.%s', $this->str('var', $this->action->getController()->getNameOff()), $this->str('var', $this->action->getDb()->getPrimaryKeyColumnName()));

        $primaryKey = $this->str('var', $this->action->getDb()->getPrimaryKeyColumnName());

        $template = '';

        switch ($dbType) {
            case 'low-strict':
                $template = '';
                break;

        	default:

        	    $template = <<<EOS
                        <td>
                            <a class="btn btn-info btn-xs" href="<?php echo \$this->url('{$viewAction}');?>/{{{$primaryName}}}">
                                <span class="glyphicon glyphicon-resize-full"></span>
                            </a>
                            <a class="btn btn-primary btn-xs" href="<?php echo \$this->url('{$editAction}');?>/{{{$primaryName}}}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a class="btn btn-danger btn-xs"
                                ng-click="\$event.preventDefault();list.exclude.showDialog({$primaryName});"
                                ng-href="<?php echo \$this->url('{$delAction}', array('id' => \$this->{$primaryKey})); ?>/{{{$primaryName}}}">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>

EOS;


        	    break;
        }


        return $template;

    }


    public function getListRow()
    {
        $elements = $this->getListRowElements();
        $elements .= $this->getActionButtons();
        return $elements;
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
                'routeEdit' => sprintf('%s/%s/edit', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $this->action->getController()->getNameOff())),
                'routeDelete' => sprintf('%s/%s/delete', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $this->action->getController()->getNameOff())),
                'routeView' => sprintf('%s/%s/view', $this->str('url', $this->getModule()->getModuleName()), $this->str('url', $this->action->getController()->getNameOff())),
                'getId' => $this->str('var', $this->action->getDb()->getPrimaryKeyColumnName()),
                'classLabel' => $this->str('label', str_replace('Controller', '', $this->action->getController()->getName())),
            )
        ));


        $this->setLocation($this->getLocationDir());
        $this->setFileName('row.phtml');
        $this->setView('template/view/list-row.table.phtml');
        $this->setConfigVars(array(
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'controller' => $this->str('class', $this->action->getController()->getName()),
            'action' => $this->str('class', $this->action->getName()),
            'elements' => $this->getListRowElements(),
        ));

        return $this->render();
    }

    public function getListRowElements()
    {
        $dbColumns = $this->getTableData();

        $this->rowElements = '';

        foreach ($dbColumns as $i => $columnData) {

            if (
                $columnData instanceof \Gear\Service\Column\Text
                || $columnData instanceof \Gear\Service\Column\Varchar\UploadImage
                || $columnData instanceof \Gear\Service\Column\Varchar\PasswordVerify
                || $columnData instanceof \Gear\Service\Column\Varchar\UniqueId
                || $columnData instanceof \Gear\Service\Column\Int\Checkbox
                || $columnData instanceof \Gear\Service\Column\AbstractCheckbox
            ) {
                continue;
            }
            $this->rowElements .= $columnData->getViewListRowElement();

        }
        return $this->rowElements;
    }

    //public function create


    public function createActionList($action)
    {
        $this->action = $action;
        $this->columns = $action->getDb()->getTableColumns();

        $this->createSearch();
        $this->createListView($action);
        //$this->createListRowView();
    }

    public function createDirectoryFromIntrospect($controller)
    {
        $controllerDir = sprintf(
            '%s/module/%s/view/%s/%s',
            \GearBase\Module::getProjectFolder(),
            $this->getModule()->getModuleName(),
            $this->str('url', $this->getModule()->getModuleName()),
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
            \GearBase\Module::getProjectFolder().'/module/'.$this->getModule()->getModuleName().'/view/error'
        );
    }

    public function createDirectory($page)
    {

        $controllerDir = sprintf(
            '%s/module/%s/view/%s/%s',
            \GearBase\Module::getProjectFolder(),
            $this->getModule()->getModuleName(),
            $this->str('url', $this->getModule()->getModuleName()),
            $this->str('url', str_replace('Controller', '',$page->getController()->getName()))
        );

        if (!is_dir($controllerDir)) {
            $this->getDirService()->mkDir($controllerDir);
        }
        $this->setLocationDir($controllerDir);

        return true;

    }
    
    
    public function angularLayout()
    {
        
        $moduleCss = sprintf('%s.css', $this->str('point', $this->getModule()->getModuleName()));
        $moduleJs = sprintf('%s.js', $this->str('url', $this->getModule()->getModuleName()));
     
        $moduleTitle = $this->str('label', $this->getModule()->getModuleName());
        $moduleName = $this->getModule()->getModuleName();
        
        return $this->createFileFromTemplate(
            'template/view/layout/layout-angular.phtml',
            array(
                'moduleCss' => $moduleCss,
                'moduleJs' => $moduleJs,
                'moduleTitle' => $moduleTitle,
                'moduleName' => $moduleName
            ),
            'layout.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
        
        
        
    }

    public function createFromPage(\Gear\ValueObject\Action $page)
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createDirectory($page);

        $filename     = sprintf('%s.phtml', $this->str('url', $page->getName()));
        $filelocationDir = sprintf(
            '%s/module/%s/view/%s/%s',
            \GearBase\Module::getProjectFolder(),
            $this->getModule()->getModuleName(),
            $this->str('url', $this->getModule()->getModuleName()),
            $this->str('url', str_replace('Controller', '',$page->getController()->getName())),
            $this->str('url', $page->getName())
        );

        $this->setTimeTest(new \DateTime('now'));

        $this->createFileFromTemplate(
            'template/view/simple.page.phtml',
            array(
                'module' => $this->str('class', $this->getModule()->getModuleName()),
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
            \GearBase\Module::getProjectFolder().'/module/'.$this->getModule()->getModuleName().'/view/error'
        );
    }

    public function createIndexAngularView()
    {
        $config = $this->getServiceLocator()->get('config');
        
        
      
        $this->createFileFromTemplate(
            'template/module-angular/view/module-index.phtml',
            array(
                'label' => $this->str('label', $this->getModule()->getModuleName()),
                'module' => $this->str('module', $this->getModule()->getModuleName()),
               
            ),
            'index.phtml',
            sprintf(
                '%s/module/%s/view/%s/index',
                \GearBase\Module::getProjectFolder(),
                $this->getModule()->getModuleName(),
                $this->str('url', $this->getModule()->getModuleName())
            )
        );
        
        $this->getAngularService()->createIndexController();
    }

    public function createIndexView()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'template/view/simple.module.phtml',
            array(
                'module' => $this->str('label', $this->getModule()->getModuleName()),
                'version' => $config['version'***REMOVED***
            ),
            'index.phtml',
            sprintf(
                '%s/module/%s/view/%s/index',
                \GearBase\Module::getProjectFolder(),
                $this->getModule()->getModuleName(),
                $this->str('url', $this->getModule()->getModuleName())
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
