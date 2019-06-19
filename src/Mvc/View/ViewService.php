<?php
namespace Gear\Mvc\View;

use Gear\Mvc\AbstractMvc;
use Gear\Column\Mvc\SearchFormInterface;
use Gear\Schema\Action\Action;
use Gear\Schema\Db\Db;
use Gear\Constructor\Helper;
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Table\UploadImageTrait;
use Gear\Mvc\View\ViewColumnInterface;
use Gear\Mvc\AbstractMvcInterface;

class ViewService extends AbstractMvc implements AbstractMvcInterface
{
    use SchemaServiceTrait;
    use UploadImageTrait;

    protected $locationDir;

    public function build(Action $action)
    {
        if ($action->getController()->getDb() !== null) {
            $this->factoryMvc($action);
            return;
        }

        $this->file = $this->getFileCreator();

        $this->template = 'template/module/mvc/view/controller/controller-action-view.phtml';
        //acha a localização do arquivo final.
        $fileName     = sprintf('%s.phtml', $this->str('url', $action->getName()));
        $this->file->setFileName($fileName);


        $controllerName = $action->getController()->getNameOff();

        $nameClass = sprintf('%s%sAction', $action->getController()->getName(), $action->getName());

        $fileLocationDir = sprintf(
            '%s/view/%s/%s',
            $this->module->getMainFolder(),
            $this->str('url', $this->module->getModuleName()),
            $this->str('url', $controllerName),
            $this->str('url', $action->getName())
        );

        $this->getDirService()->mkDir($fileLocationDir);
        $this->file->setLocation($fileLocationDir);

        $this->file->setOptions([
            'className' => $nameClass,
            'module' => $this->str('class', $this->module->getModuleName()),
            'controller' => $controllerName,
            'action' => $this->str('class', $action->getName()),
            'moduleLabel' => $this->str('label', $this->module->getModuleName()),
            'controllerLabel' => $this->str('label', $controllerName),
            'actionLabel' => $this->str('label', $action->getName())
        ***REMOVED***);

        $this->file->setTemplate($this->template);


        return $this->file->render();
    }

    public function factoryMvc(Action $action)
    {
        switch ($action->getName()) {
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

    public function getUserType(Db $db)
    {
        $userType = $this->str('class', $db->getUser());
        $userClass = sprintf('\Gear\UserType\View\%s', $userType);
        $user = new $userClass();
        return $user;
    }


    /**
     * Cria a coleção de View para o Mvc
     *
     * @param Db $table
     */
    public function introspectFromTable($table)
    {
        $this->db = $table;
        $this->tableName = $table->getTable();

        $controller = $this->getSchemaService()->getControllerByDb($table);

        $this->createDirectoryFromIntrospect($controller);

        foreach ($controller->getAction() as $action) {
            $controller->setDb($this->db);
            $action->setController($controller);

            $this->factoryMvc($action);
        }
    }




    public function getViewValues($action)
    {
        return $this->columnManager->extractCode(ViewColumnInterface::VIEW, [***REMOVED***, [
            \Gear\Column\Varchar\UniqueId::class,
            \Gear\Column\Varchar\PasswordVerify::class
        ***REMOVED***);
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

        $this->getFileCreator()->createFile(
            'template/module/table/upload-image/view/image.phtml',
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

        $code = $this->columnManager->extractCode(ViewColumnInterface::FORM_ELEMENT, [***REMOVED***, [
            \Gear\Column\Varchar\UniqueId::class,
            \Gear\Column\Integer\PrimaryKey::class
        ***REMOVED***);

        $formElements = '';

        foreach ($code as $i => $lineData) {
            if ($line == 0) {
                $formElements .= '                <div class="row">'.PHP_EOL;
            }

            $formElements .= "                    <div class=\"col-lg-$each\">".PHP_EOL;
            $formElements .= $lineData;
            $formElements .= "                    </div>".PHP_EOL;

            $line += $each;

            if ($line == 12 || !isset($code[$i+1***REMOVED***)) {
                $line = 0;
                $formElements .= "                </div>".PHP_EOL;
            }
        }

        return $formElements;
    }

    public function createActionAdd($action)
    {
        $this->db = $action->getController()->getDb();
        $this->columnManager = $this->db->getColumnManager();
        $this->tableName = $this->db->getTable();

        $module = $this->getModule()->getModuleName();
        $controllerName = $action->getController()->getNameOff();

        $routeCreate = sprintf('%s/%s/create', $this->str('url', $module), $this->str('url', $controllerName));
        $routeImage  = sprintf('%s/%s/image', $this->str('url', $module), $this->str('url', $controllerName));
        $routeList   = sprintf('%s/%s/list', $this->str('url', $module), $this->str('url', $controllerName));


        $fileCreator = $this->getFileCreator();

        $formElements = $this->createFormElements();


        $fileCreator->setView('template/module/view/create/create.phtml');
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
        $this->db = $action->getController()->getDb();
        $this->columnManager = $this->db->getColumnManager();
        $this->tableName = $this->db->getTable();

        if ($this->getTableService()->verifyTableAssociation(
            $this->db->getTable()
        )) {
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

        $fileCreator = $this->getFileCreator();

        $formElements = $this->createFormElements();

        $fileCreator->setTemplate('template/module/view/edit/edit.phtml');
        $fileCreator->setOptions([
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
        ***REMOVED***);
        $fileCreator->setFileName('edit.phtml');
        $fileCreator->setLocation($this->getLocationDir());

        return $fileCreator->render();
    }


    /**
     * @create view/[moduleUrl***REMOVED***/[controllerUrl***REMOVED***/view.phtml
     * @param Gear\Schema\Action\Action $action
     */
    public function createActionView($action)
    {
        $this->action = $action;
        $this->db = $this->action->getController()->getDb();
        $this->columnManager = $this->db->getColumnManager();
        $this->tableName = $this->db->getTable();

        $viewValues = $this->getViewValues($action);

        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
        $tableUrl  = $this->str('url', $action->getController()->getNameOff());


        if ($action->getController()->getDb()->getUser() == 'strict') {
            $dbType = 'all';
        } else {
            $dbType = $action->getController()->getDb()->getUser();
        }


        $file = $this->getFileCreator();

        $this->images = '';
        if ($this->getTableService()->verifyTableAssociation($this->tableName)) {
            $this->images = $this->getUploadImage()->getViewView($this->tableName);
        }
        $options =  [
            'images' => $this->images,
            'label' => $this->str('label', $action->getController()->getNameOff()),
            'class' => $this->str('class', $action->getController()->getNameOff()),
            'values' => $viewValues,
        ***REMOVED***;

        $options['actions'***REMOVED*** = $this->getFileCreator()->renderPartial(
            sprintf('template/module/view/view/view.%s.phtml', $dbType),
            [
                'routeEdit' =>  sprintf('%s/%s/edit', $moduleUrl, $tableUrl),
                'routeList' =>  sprintf('%s/%s/list', $moduleUrl, $tableUrl),
                'routeView' =>  sprintf('%s/%s/view', $moduleUrl, $tableUrl),
                'routeCreate' =>  sprintf('%s/%s/create', $moduleUrl, $tableUrl),
                'routeDelete' =>  sprintf('%s/%s/delete', $moduleUrl, $tableUrl),
            ***REMOVED***
        );


        $file->setTemplate('template/module/view/view/view.phtml');
        $file->setLocation($this->getLocationDir());
        $file->setFileName('view.phtml');
        $file->setOptions($options);

        return $file->render();
    }


    public function createSearch($action)
    {
        $this->action = $action;
        $this->db = $action->getController()->getDb();
        $this->columnManager = $this->db->getColumnManager();
        $this->tableName = $this->db->getTable();

        return $this->getFileCreator()->createFile(
            'template/module/view/search.table.phtml',
            [
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'tableUrl' => $this->str('url', $this->action->getController()->getNameOff()),
                //'elements' => $this->getSearchElements()
            ***REMOVED***,
            'search-form.phtml',
            $this->getLocationDir()
        );
    }

    /**
     * @TODO VOLTAR A USAR
     * @return array

    public function getSearchElements()
    {
        $dbColumns = $this->getColumnService()->getColumns($this->db);

        $formElements = [***REMOVED***;

        foreach ($dbColumns as $columnData) {
            if ($columnData instanceof SearchFormInterface) {
                //$formElements[***REMOVED*** = $columnData->getSearchViewElement();
            }
        }


        return $formElements;
    }
    */

    public function createListView($action)
    {
        $this->action = $action;
        $this->db = $action->getController()->getDb();
        $this->columnManager = $this->db->getColumnManager();
        $this->user = $this->getUserType($this->db);

        $this->tableName = $this->db->getTable();

        $options = [
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
        ***REMOVED***;

        $options['userId'***REMOVED*** = $this->user->getUserIdList();

        return $this->getFileCreator()->createFile(
            'template/module/view/list.table.phtml',
            $options,
            'list.phtml',
            $this->getLocationDir()
        );
    }


    public function getActionButtons()
    {
        if ($this->action->getController()->getDb()->getUser() == 'strict') {
            $dbType = 'all';
        } else {
            $dbType = $this->action->getController()->getDb()->getUser();
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
            $this->str('var', $this->getTableService()->getPrimaryKeyColumnName($this->db->getTable()))
        );

        $primaryKey = $this->str('var', $this->getTableService()->getPrimaryKeyColumnName($this->db->getTable()));

        $template = '';

        $tableName = $this->str('var', $this->db->getTable());

        $delHref = "<?php echo \$this->url('{$delAction}',"
                 . "array('id' => \$this->{$primaryKey})); ?>/{{{$primaryName}}}";

        $indent = '                        ';

        /**
         * @TODO
         */
        switch ($dbType) {
            case 'low-strict':
                $template = <<<EOS
{$indent}<td class="col-lg-1">
{$indent}    <a class="btn btn-info btn-xs" href="<?php echo \$this->url('{$viewAction}');?>/{{{$primaryName}}}">
{$indent}        <span class="glyphicon glyphicon-resize-full"></span>
{$indent}    </a>
{$indent}    <a ng-show="list.id == ${tableName}.user" class="btn btn-primary btn-xs" href="<?php echo \$this->url('{$editAction}');?>/{{{$primaryName}}}">
{$indent}        <span class="glyphicon glyphicon-pencil"></span>
{$indent}    </a>
{$indent}    <a ng-show="list.id == ${tableName}.user"
{$indent}        class="btn btn-danger btn-xs"
{$indent}        ng-click="\$event.preventDefault();list.exclude.showDialog({$primaryName});"
{$indent}        ng-href="{$delHref}">
{$indent}        <i class="glyphicon glyphicon-trash"></i>
{$indent}    </a>
{$indent}</td>

EOS;
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

    public function getListRowElements()
    {
        $this->rowElements = $this->columnManager->generateCode(
            ViewColumnInterface::LIST_ROW,
            [***REMOVED***,
            [
                \Gear\Column\Text\Text::class,
                \Gear\Column\Text\Html::class,
                \Gear\Column\Varchar\UploadImage::class,
                \Gear\Column\Varchar\PasswordVerify::class,
                \Gear\Column\Varchar\UniqueId::class,
                \Gear\Column\Integer\Checkbox::class,
                \Gear\Column\Tinyint\Checkbox::class,
            ***REMOVED***
        );
        return $this->rowElements;
    }

    //public function create


    public function createActionList($action)
    {

        $this->action = $action;
        $this->db = $action->getController()->getDb();
        $this->columnManager = $this->db->getColumnManager();
        $this->user = $this->getUserType($this->db);

        $this->createSearch($action);
        $this->createListView($action);
        //$this->createListRowView();
    }

    /**
     * Cria o diretório para adicionar os arquivos do Db -> View
     *
     * @param Controller $controller
     * @return string
     */
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
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/error/404',
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

    /**
     * Obrigatório para novos módulos
     * view/layout/delete.phtml
     */
    public function createDeleteView()
    {
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/layout/delete',
            'delete.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }

    public function createLayoutSuccessView()
    {
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/layout/success',
            'success.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }


    public function createLayoutDeleteSuccessView()
    {
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/layout/delete-success',
            'delete-success.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }



    public function createLayoutDeleteFailView()
    {
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/layout/delete-fail',
            'delete-fail.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }

    public function createLayoutView()
    {
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/layout.phtml',
            'layout.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }


    public function createBreadcrumbView()
    {
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/breadcrumb.phtml',
            'breadcrumb.phtml',
            $this->getModule()->getViewLayoutFolder()
        );
    }


    public function createErrorView()
    {
        return $this->getFileCreator()->createFileFromCopy(
            'template/module/view/error.phtml',
            'index.phtml',
            $this->getModule()->getMainFolder().'/view/error'
        );
    }

    /**
     * @create view/[moduleUrl***REMOVED***/index/index.phtml
     */
    public function createIndexView()
    {
        $this->getFileCreator()->createFile(
            'template/module/view/simple.module.phtml',
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

    public function getLocationDir()
    {
        return $this->locationDir;
    }

    public function setLocationDir($locationDir)
    {
        $this->locationDir = $locationDir;
        return $this;
    }
}
