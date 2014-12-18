<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class ViewService extends AbstractJsonService
{
    protected $timeTest;

    protected $location;

    protected $specialityService;

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
            $this->getLocation()
        );
    }

    public function createTemplateDownload()
    {
        return $this->createFileFromCopy(
            'template/view/imagem/template-download',
            'template-download.phtml',
            $this->getLocation()
        );
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
            	case 'Image':
            	    $this->createActionImage($action);
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
            $this->getLocation()
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
            $this->getLocation()
        );
    }

    public function createActionImage($action)
    {

        $imageContainer = '';

        $tableName = ($this->str('class',$action->getController()->getNameOff()));

        if ($this->verifyImageDependency($tableName)) {
            $imageContainer = true;
        } else {
            $imageContainer = false;
        }

        $this->createFileFromTemplate(
            'template/view/image.table.phtml',
            array(
                'route' =>  sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'class' => $this->str('class', $action->getController()->getNameOff()),
            ),
            'image.phtml',
            $this->getLocation()
        );
    }

    public function createActionAdd($action)
    {

        $viewFormService = $this->getServiceLocator()->get('ViewService\FormService');
        $imageContainer = '';

        $tableName = ($this->str('class',$action->getController()->getNameOff()));

        if ($this->verifyImageDependency($tableName)) {
            $imageContainer = true;
        } else {
            $imageContainer = false;
        }

        $this->createFileFromTemplate(
            'template/view/add.table.phtml',
            array(
                'imageContainer' => $imageContainer,
                'elements' => $viewFormService->getFormElements($action),
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'action' => $this->str('class', $action->getName()),
                'class' => $this->str('class', $action->getController()->getNameOff()),
                'route' =>  sprintf('%s/%s/create', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeImage' =>  sprintf('%s/%s/image', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeBack' =>  sprintf('%s/%s/list', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
            ),
            'create.phtml',
            $this->getLocation()
        );
    }

    public function createActionEdit($action)
    {
        $viewFormService = $this->getServiceLocator()->get('ViewService\FormService');

        if ($this->verifyImageDependency($this->str('class', $action->getController()->getNameOff()))) {
            $imageContainer = true;
        } else {
            $imageContainer = false;
        }

        $this->createFileFromTemplate(
            'template/view/edit.table.phtml',
            array(
                'imageContainer' => $imageContainer,
                'elements' => $viewFormService->getFormElements($action),
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'action' => $this->str('class', $action->getName()),
                'class' => $this->str('class', $action->getController()->getNameOff()),
                'route' =>  sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeImage' =>  sprintf('%s/%s/image', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeBack' =>  sprintf('%s/%s/list', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeNew' =>  sprintf('%s/%s/create', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
            ),
            'edit.phtml',
            $this->getLocation()
        );
    }



    public function createActionList($action)
    {
        $columns = $action->getDb()->getTableColumns();

        $searchService = $this->getServiceLocator()->get('ViewService\SearchService');

        $this->createFileFromTemplate(
            'template/view/search.table.phtml',
            array(
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'tableUrl' => $this->str('url', $action->getController()->getNameOff()),
                'data' => $searchService->getSearchData($columns)
            ),
            'search-form.phtml',
            $this->getLocation()
        );

        $this->createFileFromTemplate(
            'template/view/list.table.phtml',
            array(
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'tableUrl' => $this->str('url', $action->getController()->getNameOff()),
                'action' => $this->str('class', $action->getName()),
                'controllerViewFolder' => sprintf('%s/%s', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()))
            ),
            'list.phtml',
            $this->getLocation()
        );

        $tableService = $this->getServiceLocator()->get('ViewService\TableService');

        $this->createFileFromTemplate(
            'template/view/list-row.table.phtml',
            array(
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'action' => $this->str('class', $action->getName()),
                'tableBody' => $tableService->getDbBodyRow($columns),
                'routeEdit' => sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeDelete' => sprintf('%s/%s/delete', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'getId' => $this->str('class', $action->getDb()->getPrimaryKeyColumnName()),
                'classLabel' => $this->str('label', str_replace('Controller', '', $action->getController()->getName())),
            ),
            'row.phtml',
            $this->getLocation()
        );
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
        $this->setLocation($controllerDir);


        return $controllerDir;
    }


    public function createErrorView()
    {
        return $this->createFileFromCopy(
            'view/error.module',
            'index.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/error'
        );
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
        $this->setLocation($controllerDir);

        return true;

    }

    public function createFromPage(\Gear\ValueObject\Action $page)
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createDirectory($page);

        $filename     = sprintf('%s.phtml', $this->str('url', $page->getName()));
        $filelocation = sprintf(
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
            $filelocation
        );

    }

    public function createIndexView()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'view/simple.module',
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

    public function createDeleteView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/delete',
            'delete.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }

    public function createLayoutView()
    {
        return $this->createFileFromCopy(
            'view/layout.module',
            'layout.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }

    public function createLayoutSuccessView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/success',
            'success.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }


    public function createLayoutDeleteSuccessView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/delete-success',
            'delete-success.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }



    public function createLayoutDeleteFailView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/delete-fail',
            'delete-fail.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }


    public function createBreadcrumbView()
    {
        return $this->createFileFromCopy(
            'view/breadcrumb',
            'breadcrumb.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
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

	public function getLocation()
	{
		return $this->location;
	}

	public function setLocation($location)
	{
		$this->location = $location;
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
