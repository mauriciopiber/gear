<?php
namespace Gear\Mvc\View;

use Gear\Service\AbstractJsonService;
use Gear\Column\SearchFormInterface;
use Gear\Mvc\View\AngularServiceTrait;
use GearJson\Action\Action;
use Gear\Constructor\Helper;
use GearJson\Schema\SchemaServiceTrait;

class ViewService extends AbstractJsonService
{
    use SchemaServiceTrait;
    use AngularServiceTrait;

    protected $timeTest;
    protected $locationDir;
    protected $specialityService;

    public function build(Action $action)
    {

        $this->file = $this->getServiceLocator()->get('fileCreator');

        $this->template = 'template/constructor/controller-action/controller-action-view.phtml';
        //acha a localização do arquivo final.
        $fileName     = sprintf('%s.phtml', $this->str('url', $action->getName()));
        $this->file->setFileName($fileName);

        $fileLocationDir = sprintf(
            '%s/view/%s/%s',
            $this->module->getMainFolder(),
            $this->str('url', $this->module->getModuleName()),
            $this->str('url', $action->getController()->getNameOff()),
            $this->str('url', $action->getName())
        );

        $this->getDirService()->mkDir($fileLocationDir);
        $this->file->setLocation($fileLocationDir);


        $this->file->setOptions(array(
            'module' => $this->str('class', $this->module->getModuleName()),
            'controller' => $this->str('class', $action->getController()->getNameOff()),
            'action' => $this->str('class', $action->getName())
        ));

        $this->file->setTemplate($this->template);


        return $this->file->render();

    }


    public function introspectFromTable($table)
    {
        $this->db = $table;
        $this->tableName = $table->getTable();

        $controller = $this->getSchemaService()->getControllerByDb($table);

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




    public function getViewValues($action)
    {
        $names = [***REMOVED***;

        $this->tableName = $this->str('class', $action->getController()->getNameOff());
        $data = $this->getTableData();

        foreach ($data as $i => $columnData) {

            if (
                $columnData instanceof \Gear\Column\Varchar\UniqueId ||
                $columnData instanceof \Gear\Column\Varchar\PasswordVerify
            ) {
                continue;
            }

            $names[***REMOVED*** = $columnData->getViewData();
        }
        return $names;
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


    public function getActionRoute($action, $controller)
    {
        $router = sprintf(
            '%s/%s/%s',
            $this->str('url', $this->getModule()->getModuleName()),
            $this->str('url', $controller->getNameOff()),
            $action
        );

        return $router;
    }

    public function createActionImage($action)
    {

        $this->tableName = ($this->str('class', $action->getController()->getNameOff()));

        $this->createFileFromTemplate(
            'template/table/upload-image/view/image.phtml',
            array(
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'route' =>  $this->getActionRoute('edit', $action->getController()),
                'class' => $this->str('class', $action->getController()->getNameOff()),
            ),
            'upload-image.phtml',
            $this->getLocationDir()
        );
    }


    public function createFormElements()
    {
        $each = 6;
        $line = 0;

        $dbColumns = $this->getTableData();

        $formElements = [***REMOVED***;
        foreach ($dbColumns as $i => $columnData) {

            if ($columnData instanceof \Gear\Column\Varchar\UniqueId
                || $columnData instanceof \Gear\Column\Int\PrimaryKey
                || !$columnData instanceof \Gear\Column\AbstractColumn
            ) {
                continue;
            }


            if ($line == 0) {
                $formElements[***REMOVED*** = '                <div class="row">'.PHP_EOL;
            }

            $formElements[***REMOVED*** = "                    <div class=\"col-lg-$each\">".PHP_EOL;
            $formElements[***REMOVED*** = $columnData->getViewFormElement();
            $formElements[***REMOVED*** = "                    </div>".PHP_EOL;

            $line += $each;

            if ($line == 12 || !isset($dbColumns[$i+1***REMOVED***)) {
                $line = 0;
                $formElements[***REMOVED*** = "                </div>".PHP_EOL;
            }
        }

        return $formElements;
    }

    public function createActionAdd($action)
    {
        $module = $this->getModule()->getModuleName();
        $controllerName = $action->getController()->getNameOff();

        $routeCreate = sprintf('%s/%s/create', $this->str('url', $module), $this->str('url', $controllerName));
        $routeImage  = sprintf('%s/%s/image', $this->str('url', $module), $this->str('url', $controllerName));
        $routeList   = sprintf('%s/%s/list', $this->str('url', $module), $this->str('url', $controllerName));


        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $formElements = '';

        foreach ($this->createFormElements() as $item) {
            $formElements .= $item;
        }

        $fileCreator->setView('template/view/create/create.phtml');
        $fileCreator->setOptions([
            'formElements' => $formElements,
            'imageContainer' => false,
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'controller' => $this->str('class', $action->getController()->getName()),
            'label' => $this->str('label', $action->getController()->getNameOff()),
            'action' => $this->str('class', $action->getName()),
            'class' => $this->str('class', $action->getController()->getNameOff()),
            'route' =>  $routeCreate,
            'routeImage' => $routeImage,
            'routeBack' => $routeList
        ***REMOVED***);
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

        $module = $this->getModule()->getModuleName();
        $controllerName = $action->getController()->getNameOff();

        $routeCreate = sprintf('%s/%s/create', $this->str('url', $module), $this->str('url', $controllerName));
        $routeList   = sprintf('%s/%s/list', $this->str('url', $module), $this->str('url', $controllerName));
        $routeEdit   = sprintf('%s/%s/edit', $this->str('url', $module), $this->str('url', $controllerName));
        $routeView   = sprintf('%s/%s/view', $this->str('url', $module), $this->str('url', $controllerName));
        $routeImage  = sprintf('%s/%s/upload-image', $this->str('url', $module), $this->str('url', $controllerName));

        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $formElements = '';

        foreach ($this->createFormElements() as $item) {
            $formElements .= $item;
        }


        $fileCreator->setTemplate('template/view/edit/edit.phtml');
        $fileCreator->setOptions(array(
            'imageContainer' => $imageContainer,
            'formElements' => $formElements,
            //'elements' => $viewFormService->getFormElements($action),
            'label' => $this->str('label', $controllerName),
            'module' => $this->str('class', $module),
            'controller' => $this->str('class', $action->getController()->getName()),
            'action' => $this->str('class', $action->getName()),
            'class' => $this->str('class', $controllerName),
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


    /**
     * @create view/[moduleUrl***REMOVED***/[controllerUrl***REMOVED***/view.phtml
     * @param GearJson\Action\Action $action
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


        $file = $this->getServiceLocator()->get('fileCreator');

        $file->addChildView(
            array(
                'template' => sprintf('template/view/view/view.%s.phtml', $dbType),
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

        $file->setTemplate('template/view/view/view.phtml');
        $file->setLocation($this->getLocationDir());
        $file->setFileName('view.phtml');
        $file->setOptions(
            array(
                'images' => $this->images,
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'class' => $this->str('class', $action->getController()->getNameOff()),
                'values' => $viewValues,
            )
        );

        $viewFile = $file->render();



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
                'controllerViewFolder' => sprintf(
                    '%s/%s',
                    $this->str('url', $this->getModule()->getModuleName()),
                    $this->str('url', $this->action->getController()->getNameOff())
                )
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

    /**
     * Retorna o template de buttons para listagem
     * @param unknown $dbType
     */
    public function getListActions($dbType)
    {

        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
        $controllerUrl = $this->str('url', $this->action->getController()->getNameOff());

        $editAction =  sprintf('%s/%s/edit', $moduleUrl, $controllerUrl);
        $viewAction =  sprintf('%s/%s/view', $moduleUrl, $controllerUrl);
        $delAction =   sprintf('%s/%s/delete', $moduleUrl, $controllerUrl);

        $primaryName = sprintf(
            '%s.%s',
            $this->str('var', $this->action->getController()->getNameOff()),
            $this->str('var', $this->action->getDb()->getPrimaryKeyColumnName())
        );

        $primaryKey = $this->str('var', $this->action->getDb()->getPrimaryKeyColumnName());

        $template = '';

        $delHref = "<?php echo \$this->url('{$delAction}',"
                 . "array('id' => \$this->{$primaryKey})); ?>/{{{$primaryName}}}";

        $indent = '                        ';

        switch ($dbType) {
            case 'low-strict':
                $template = '';
                break;
            default:
                $template = <<<EOS
{$indent}<td class="col-lg-1">
{$indent}    <a class="btn btn-info btn-xs" href="<?php echo \$this->url('{$viewAction}');?>/{{{$primaryName}}}">
{$indent}        <span class="glyphicon glyphicon-resize-full"></span>
{$indent}    </a>
{$indent}    <a class="btn btn-primary btn-xs" href="<?php echo \$this->url('{$editAction}');?>/{{{$primaryName}}}">
{$indent}        <span class="glyphicon glyphicon-pencil"></span>
{$indent}    </a>
{$indent}    <a class="btn btn-danger btn-xs"
{$indent}        ng-click="\$event.preventDefault();list.exclude.showDialog({$primaryName});"
{$indent}        ng-href="{$delHref}">
{$indent}        <i class="glyphicon glyphicon-trash"></i>
{$indent}    </a>
{$indent}</td>

EOS;


                break;
        }


        return $template;

    }

    /**
     * @return $elements string
     */

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

        $this->addChildView(
            array(
                'template' => sprintf('template/view/list-row-actions-%s.phtml', $dbType),
                'placeholder' => 'actions',
                'config' => array(
                    'routeEdit' => $this->getActionRoute('edit', $this->action->getController()),
                    'routeDelete' => $this->getActionRoute('delete', $this->action->getController()),
                    'routeView' => $this->getActionRoute('view', $this->action->getController()),
                    'getId' => $this->str('var', $this->action->getDb()->getPrimaryKeyColumnName()),
                    'classLabel' => $this->str('label', $this->action->getController()->getNameOff())
                ),
            )
        );


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
                $columnData instanceof \Gear\Column\Text
                || $columnData instanceof \Gear\Column\Varchar\UploadImage
                || $columnData instanceof \Gear\Column\Varchar\PasswordVerify
                || $columnData instanceof \Gear\Column\Varchar\UniqueId
                || $columnData instanceof \Gear\Column\Int\Checkbox
                || $columnData instanceof \Gear\Column\AbstractCheckbox
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
            '%s/view/%s/%s',
            $this->getModule()->getMainFolder(),
            $this->str('url', $this->getModule()->getModuleName()),
            $this->str('url', str_replace('Controller', '', $controller->getName()))
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
            $this->getModule()->getMainFolder().'/view/error'
        );
    }

    public function createDirectory($page)
    {

        $controllerDir = sprintf(
            '%s/view/%s/%s',
            $this->getModule()->getMainFolder(),
            $this->str('url', $this->getModule()->getModuleName()),
            $this->str('url', str_replace('Controller', '', $page->getController()->getName()))
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

    public function createFromPage(\GearJson\Action\Action $page)
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createDirectory($page);

        $filename     = sprintf('%s.phtml', $this->str('url', $page->getName()));
        $filelocationDir = sprintf(
            '%s/view/%s/%s',
            $this->getModule()->getMainFolder(),
            $this->str('url', str_replace('Controller', '', $page->getController()->getName())),
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
            $this->getModule()->getMainFolder().'/view/error'
        );
    }

    /**
     * Cria ação principal quando opção --angularjs está ativa no módulo
     * @create view/[moduleUrl***REMOVED***/index/index.phtml
     */
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
                '%s/view/%s/index',
                $this->getModule()->getMainFolder(),
                $this->str('url', $this->getModule()->getModuleName())
            )
        );

        $this->getAngularService()->createIndexController();
    }

    /**
     * @create view/[moduleUrl***REMOVED***/index/index.phtml
     */
    public function createIndexView()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'template/view/simple.module.phtml',
            array(
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
                'module' => $this->str('class', $this->getModule()->getModuleName())
            ),
            'index.phtml',
            sprintf(
                '%s/view/%s/index',
                $this->getModule()->getMainFolder(),
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
