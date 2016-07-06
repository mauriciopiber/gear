<?php
namespace Gear\Mvc\Spec\Feature;

use Gear\Mvc\AbstractMvcTest;
use GearJson\Action\Action;
use GearJson\Db\Db;

class Feature extends AbstractMvcTest
{
    protected $dbLocation;

    public function introspectFromTable(Db $table)
    {
        $this->db = $table;
        $this->tableName = $table->getTable();

        $controller = $this->getSchemaService()->getControllerByDb($table);

        $this->dbLocation = $this->createDirectoryFromIntrospect($controller);

        foreach ($controller->getAction() as $action) {
            $action->setController($controller);
            $action->setDb($table);

            switch ($action->getName()) {
                case 'List':
                    $this->buildListAction($action);

                    break;
                case 'Create':
                    $this->buildCreateAction($action);

                    break;
                case 'Edit':
                    $this->buildEditAction($action);
                    break;

                case 'UploadImage':
                    $this->buildUploadImageAction($action);
                    break;

                case 'View':
                    $this->buildViewAction($action);
                case 'Delete':
                    $this->buildDeleteAction($action);

                    break;
                default:

                    throw new Exception('Action not found exception');
                    break;
            }
        }

        return true;
    }

    public function buildUploadImageAction(Action $action)
    {
        return true;
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
            '%s/%s',
            $this->getModule()->getPublicJsSpecEndFolder(),
            $this->str('url', str_replace('Controller', '', $controller->getName()))
        );

        if (!is_dir($controllerDir)) {
            $this->getDirService()->mkDir($controllerDir);
        }

        return $controllerDir;
    }


    public function buildCreateAction(Action $action)
    {
        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $options = [
            'module' => $this->getModule()->getModuleName(),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'tableLabel' => $this->str('label', $action->getDb()->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/create.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }

    public function buildEditAction(Action $action)
    {
        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $options = [
            'module' => $this->getModule()->getModuleName(),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'tableLabel' => $this->str('label', $action->getDb()->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/edit.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }

    /**
     * Cria o arquivo list.feature para testes de integração do Mvc
     *
     * @param Action $action
     */
    public function buildListAction(Action $action)
    {
        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $options = [
            'module' => $this->getModule()->getModuleName(),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'tableLabel' => $this->str('label', $action->getDb()->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/list.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }

    /**
     * Cria o arquivo delete.feature para testes de Integração do Mvc
     *
     * @param Action $action
     *
     * @return Localização
     */
    public function buildDeleteAction(Action $action)
    {
        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $options = [
            'module' => $this->getModule()->getModuleName(),
            'table' => $this->str('label', $action->getDb()->getTable()),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/delete.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();

    }

    /**
     * Cria arquivo view.featurea para testes de Integração do Mvc
     *
     * @param Action $action
     *
     * @return Localização
     */
    public function buildViewAction(Action $action)
    {
        $controllerName = $action->getController()->getName();
        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);

        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $options = [
            'module' => $this->getModule()->getModuleName(),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'tableLabel' => $this->str('label', $action->getDb()->getTable()),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'tableUrl' => $this->str('url', $action->getDb()->getTable()),
        ***REMOVED***;

        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/view.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();
    }



    public function build(Action $action)
    {
        $version = $this->getGearVersion();



        if ($action->getController() instanceof \GearJson\Controller\Controller) {
            $controllerName = $action->getController()->getName();
        } else {
            $controllerName = $action->getController();
        }

        $nameFile = sprintf('%s.feature', $this->str('url', $action->getName()));
        $nameClass = sprintf('%s%sAction', $controllerName, $action->getName());

        $options = [
            'version' => $version,
            'action' => $this->str('class', $action->getName()),
            'controller' => $this->str('class', $controllerName),
            'module' => $this->str('class', $this->getModule()->getModuleName()),
            'actionLabel' => $this->str('label', $action->getName()),
            'controllerLabel' => $this->str('label', $controllerName),
            'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
            'actionUrl' => $this->str('url', $action->getName()),
            'controllerUrl' => $this->str('url',  $controllerName),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
        ***REMOVED***;

        $location = $this->getModule()->getPublicJsSpecEndFolder().'/'.$this->str('url', $controllerName);


        if (!is_dir($location)) {
            $this->getDirService()->mkDir($location);
        }

        $name = sprintf('%s.js', $nameClass);


        $fileCreator = $this->getFileCreator();

        $fileCreator->setView('template/module/mvc/spec/feature/action.feature.phtml');
        $fileCreator->setOptions($options);
        $fileCreator->setFileName($nameFile);
        $fileCreator->setLocation($location);

        return $fileCreator->render();

    }

    public function createIndexFeature($projectName = 'PiberNetwork')
    {

        return $this->getFileCreator()->createFile(
            'template/module/mvc/spec/feature/index.feature.phtml',
            array(
                //'module' => $this->getModule()->getModuleName(),
                //'project' => $this->str('label', $projectName),
                'project' => $projectName,
                'module' => $this->str('label', $this->getModule()->getModuleName())
            ),
            'index.feature',
            $this->getModule()->getPublicJsSpecEndFolder().'/index'
        );


    }
}
