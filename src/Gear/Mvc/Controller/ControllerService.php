<?php
namespace Gear\Mvc\Controller;

use Gear\Mvc\AbstractMvc;
use Gear\Column\Mvc\ControllerInterface;
use Gear\Module\ModuleConstructorInterface;
use Gear\Constructor\Db\DbConstructorInterface;
use Gear\Constructor\Controller\ControllerConstructorInterface;
use Gear\Mvc\Controller\ControllerTestServiceTrait;
use GearJson\Controller\Controller as ControllerJson;
use GearJson\Schema\SchemaServiceTrait;
use GearJson\Db\Db;
use Gear\Mvc\Controller\ColumnInterface\ControllerCreateAfterInterface;
use Gear\Mvc\Controller\ColumnInterface\ControllerCreateViewInterface;
use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Gear\Table\UploadImageTrait;

class ControllerService extends AbstractMvc implements
    ModuleConstructorInterface,
    DbConstructorInterface,
    ControllerConstructorInterface
{
    use UploadImageTrait;

    use ControllerTestServiceTrait;

    use SchemaServiceTrait;

    protected $templates = [
        'module'         => 'template/module/mvc/controller/simple.module.phtml',
        'module-factory' => 'template/module/mvc/controller/simple.module.factory.phtml',
        'db'             => 'template/module/mvc/controller/db/full.controller.phtml',
        'src'            => 'template/module/mvc/controller/controller.phtml'
    ***REMOVED***;

    protected $useImageService = false;


    public function module()
    {
        return $this->getFileCreator()->createFile(
            $this->getTemplate('module'),
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexController.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function moduleFactory()
    {
        return $this->getFileCreator()->createFile(
            $this->getTemplate('module-factory'),
            array(
                'module' => $this->getModule()->getModuleName(),
            ),
            'IndexControllerFactory.php',
            $this->getModule()->getControllerFolder()
        );
    }

    public function buildController(ControllerJson $controller)
    {

        $this->location = $this->getCode()->getLocation($controller);

        $this->template = $this->getTemplate('src');

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->controller = $controller;
        $this->controllerFile = $this->location.'/'.sprintf('%s.php', $controller->getName());

        $options = [
            'classDocs' => $this->getCode()->getClassDocs($controller, 'Controller'),
            'implements' => $this->getCode()->getImplements($controller),
            'extends' => $this->getCode()->getExtends($controller),
            'use' => $this->getCode()->getUse($controller),
            'attribute' => $this->getCode()->getUseAttribute($controller),

            'namespace' => $this->getCode()->getNamespace($controller),
            'module' => $this->module->getModuleName(),
            'moduleUrl' => $this->str('url', $this->module->getModuleName()),
            'actions' => $controller->getAction(),
            'controllerName' => $controller->getName(),
            'controllerUrl' => $this->str('url', $controller->getName()),
        ***REMOVED***;

        $options['constructor'***REMOVED*** = ($controller->getService() == 'factories')
          ? $this->getCode()->getConstructor($controller)
          : '';


        $this->file->setFileName(sprintf('%s.php', $controller->getName()));
        $this->file->setOptions($options);

        if ($controller->getService() == 'factories') {
            $this->getFactoryService()->createFactory($controller, $this->location);
        }

        return $this->file->render();
    }

    public function getUserType(Db $db)
    {
        $userType = $this->str('class', $db->getUser());
        $userClass = sprintf('\Gear\UserType\Controller\%s', $userType);
        $user = new $userClass();
        return $user;
    }

    public function introspectFromTable(Db $db)
    {
        $this->db = $db;
        $this->table = $db;
        $this->columnManager = $this->db->getColumnManager();

        $this->controller = $this->getSchemaService()->getControllerByDb($db);


        //$this->dependency = $this->getControllerDependency()->setController($this->controller);
        $this->tableName = ($this->str('class', $db->getTable()));

        $this->use       = '';
        $this->attribute = '';
        $this->create = [***REMOVED***;
        $this->update = [***REMOVED***;
        $this->functions = '';
        $this->hasImage = $this->columnManager->isAssociatedWith('Gear\Column\Varchar\UploadImage');

        $this->hasTableImage = $this->getTableService()->verifyTableAssociation($this->db->getTable(), 'upload_image');



        $this->getColumnsSpecifications();

        $this->setPrg($this->hasImage);

        $options = [***REMOVED***;

        $options['createAction'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller/db/create.phtml',
            array_merge(
                $this->getCommonActionData(),
                [
                    'preValidate' => $this->setPreValidateFromColumns(),
                    'preShow'     => $this->setPreShowFromColumns(),
                    'create' => $this->create,
                ***REMOVED***
            )
        );

        $options['editAction'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller/db/edit.phtml',
            array_merge(
                $this->getCommonActionData(),
                [
                    'preValidate' => $this->setPreValidateFromColumns(),
                    'preShow'     => $this->setPreShowFromColumns(),
                    'update' => $this->update,
                ***REMOVED***
            )
        );

        $user = $this->getUserType($this->db);


        $optionsList = [***REMOVED***;
        $optionsList['idUser'***REMOVED*** = $user->getZfcAuthenticateId();
        //$optionsList =

        $options['listAction'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller/db/list.phtml',
            array_merge(
                $optionsList,
                $this->getCommonActionData()
            )
        );

        $options['deleteAction'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller/db/delete.phtml',
            $this->getCommonActionData()
        );

        $optionsView = [***REMOVED***;

        if ($this->hasTableImage) {
            $optionsView['imageQuery'***REMOVED*** = $this->getUploadImage()->getControllerViewQuery($this->tableName);
            $optionsView['imageView'***REMOVED*** = $this->getUploadImage()->getControllerViewView($this->tableName);

            $options['uploadImageAction'***REMOVED*** = $this->getFileCreator()->renderPartial(
                'template/module/mvc/controller/db/upload-image.phtml',
                $this->getCommonActionData()
            );
        }

        $viewTemplate = (($this->db->getUser() == 'low-strict') ? 'view-low-strict' : 'view');
        $options['viewAction'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller/db/'.$viewTemplate.'.phtml',
            array_merge(
                $optionsView,
                $this->getCommonActionData()
            )
        );

        if ($this->hasImage || $this->hasTableImage) {
            $dependency = $this->controller->getDependency();
            $dependency[***REMOVED*** = '\GearImage\Service\ImageService';
            $this->controller->setDependency($dependency);
        }

        $this->attribute .= $this->getCode()->getUseAttribute($this->controller);

        $this->use .= $this->getCode()->getUse($this->controller);

        $options['classDocs'***REMOVED*** = $this->getFileCreator()->renderPartial(
            'template/module/mvc/controller/db/class-phpdocs.phtml',
            [
                'package' => $this->getCode()->getClassDocsPackage($this->controller),
                'tableLabel' => $this->str('label', $this->controller->getNameOff())
            ***REMOVED***
        );

        $options['constructor'***REMOVED*** = ($this->controller->getService() == 'factories')
          ? $this->getCode()->getConstructor($this->controller)
          : '';

        $this->getFactoryService()->createFactory($this->controller);
        $this->getControllerTestService()->introspectFromTable($this->db);

        $this->file = $this->getFileCreator();
        $this->file->setView($this->getTemplate('db'));
        $this->file->setFileName(sprintf('%s.php', $this->controller->getName()));
        $this->file->setLocation($this->getCode()->getLocation($this->controller));
        $this->file->setOptions(array_merge(
            $options,
            [
                'namespace' => $this->getCode()->getNamespace($this->controller),
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'controllerName' => $this->controller->getName(),
                'controllerUrl' => $this->str('url', $this->controller->getName()),
                'tableUrl' => $this->str('url', $this->controller->getNameOff()),
                'actions' => $this->controller->getAction(),
                'use' => $this->use,
                'attribute' => $this->attribute,
                'imagemService' => $this->useImageService, /** @TODO 4 - Usar apenas Use e Attribute */
            ***REMOVED***
        ));

        return $this->file->render();
    }

    public function getCommonActionData()
    {
        return array(
            'hasImage' => $this->hasImage,
            'requestPluginCreate' => $this->requestPluginCreate,
            'requestPluginUpdate' => $this->requestPluginUpdate,
            'prg'  => $this->postRedirectGet,
            'idVar' => $this->str('var-length', 'id'.$this->str('class', $this->controller->getNameOff())),
            'data' => $this->controller->getNameOff(),
            'dataUrl' => $this->str('url', $this->controller->getNameOff()),
            'tableUrl' => $this->str('url', $this->controller->getNameOff()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'module' => $this->getModule()->getModuleName(),
            'var' => $this->str('var', $this->controller->getNameOff()),
            'varLength' =>  $this->str('var-length', $this->controller->getNameOff())
        );
    }

    public function getColumnsSpecifications()
    {
        $onlyOneDropCache = [***REMOVED***;
        $onlyOneViewArgs = [***REMOVED***;
        $onlyOneControllerEdit = [***REMOVED***;
        $onlyOneControllerCreate = [***REMOVED***;


        $this->create[0***REMOVED*** = $this->columnManager->generateCode('getControllerCreateAfter', true);
        $this->create[1***REMOVED*** = '';
        $this->create[2***REMOVED*** = $this->columnManager->generateCode('getControllerCreateView', true);
        $this->update[0***REMOVED*** = $this->columnManager->generateCode('getControllerDeclareVar', [***REMOVED***);
        $this->update[1***REMOVED*** = $this->columnManager->generateCode('getControllerEditBeforeView', true);
        $this->update[2***REMOVED*** = $this->columnManager->generateCode('getControllerCreateView', true);

        $columns = $this->columnManager->getColumns();

        foreach ($columns as $columnData) {


            $className = get_class($columnData);

            if (method_exists($columnData, 'getControllerUse')) {
                $this->use .= $columnData->getControllerUse();
            }
            if (method_exists($columnData, 'getControllerAttribute')) {
                $this->attribute .= $columnData->getControllerAttribute();
            }

            /**
            if ($columnData instanceof ControllerCreateAfterInterface && !in_array($className, $onlyOneControllerCreate)) {
                $this->create[0***REMOVED*** .= $columnData->getControllerCreateAfter();

                $onlyOneControllerCreate[***REMOVED*** = $className;
            }

            if ($columnData instanceof ControllerCreateViewInterface && !in_array($className, $onlyOneViewArgs)) {
                $this->create[2***REMOVED*** .= $columnData->getControllerCreateView();
                $this->update[2***REMOVED*** .= $columnData->getControllerCreateView();

                $onlyOneViewArgs[***REMOVED*** = $className;
            }

            if (method_exists($columnData, 'getControllerDeclareVar')) {
                $this->update[0***REMOVED*** .= $columnData->getControllerDeclareVar();
            }

            if (method_exists($columnData, 'getControllerEditBeforeView') && !in_array($className, $onlyOneControllerEdit)) {
                $this->update[1***REMOVED*** .= $columnData->getControllerEditBeforeView();

                $onlyOneControllerEdit[***REMOVED*** = $className;
            }
            */
        }
    }

    public function setPrg($hasImage)
    {
        if ($hasImage) {
            $this->setFilePostRedirectGet();
            return;
        }

        $this->setPostRedirectGet();
    }

    /**
     * Cria chamada do Plugin PostRedirectGet
     *
     * @return void
     */
    public function setPostRedirectGet()
    {
        $this->requestPluginCreate = <<<EOS
        \$create = \$this->getRequestPlugin()->create();
EOS;

        $this->requestPluginUpdate = <<<EOS
        \$update = \$this->getRequestPlugin()->update();
EOS;

        $this->postRedirectGet = <<<EOS
        \$prg = \$this->prg(\$redirectUrl, true);

EOS;
    }

    /**
     * Cria chamada do Plugin PostRedirectGet quando há upload de imagem.
     *
     * @return void
     */
    public function setFilePostRedirectGet()
    {
        $this->requestPluginCreate = <<<EOS
        \$create = \$this->getRequestPlugin()->fileCreate();
EOS;

        $this->requestPluginUpdate = <<<EOS
        \$update = \$this->getRequestPlugin()->fileUpdate();
EOS;

        $this->postRedirectGet = <<<EOS
        \$prg = \$this->filePostRedirectGet(\$this->form, \$redirectUrl, true);

EOS;
    }


    public function setPreValidateFromColumns()
    {
        return $this->columnManager->generateCode('getControllerPreValidate', [***REMOVED***);
    }

    public function setPreShowFromColumns()
    {
        return $this->columnManager->generateCode('getControllerPreShow', [***REMOVED***);
    }


    public function buildAction(ControllerJson $controller)
    {
        $this->location = $this->getCode()->getLocation($controller);

        $this->template = $this->getTemplate('src');

        $this->file = $this->getFileCreator();
        $this->file->setLocation($this->location);
        $this->file->setTemplate($this->template);

        $this->controller = $controller;
        $this->controllerFile = $this->location.'/'.sprintf('%s.php', $controller->getName());

        $this->functions       = '';


        //busca as funciones que já existem.
        $this->fileActions     = $this->getCode()->getFunctionsNameFromFile($this->controllerFile);

        //pega as funções que serão adicionadas
        $this->actionsToInject = $this->getActionsToInject($this->controller, $this->fileActions);

        //transforma as novas actions em funções
        $this->functions = $this->actionToController($this->actionsToInject);
        $this->fileCode = explode(PHP_EOL, file_get_contents($this->controllerFile));


        $lines = $this->getInjector()->inject($this->fileCode, $this->functions);
        $lines = $this->createUse($this->controller, $lines);
        $lines = $this->createUseAttributes($this->controller, $lines);


        $newFile = implode(PHP_EOL, $lines);

        file_put_contents($this->controllerFile, $newFile);


        return $this->controllerFile;
    }


    public function actionToController($insertMethods)
    {

        foreach ($insertMethods as $method) {
            $label = $this->str('label', $method->getName());

            $this->functions .= <<<EOS

    /**
     * {$label}
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function {$this->str('var', $method->getName())}Action()
    {
        return new ViewModel([***REMOVED***);
    }

EOS;
        }

        $this->functions = explode(PHP_EOL, $this->functions);

        return $this->functions;
    }
}
