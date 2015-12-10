<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;
use Gear\Config\AssetManagerTrait;

class ConfigService extends AbstractJsonService
{
    use AssetManagerTrait;

    protected $json;

    protected $controllers;

    protected $languageService;

    public function generateForLightModule($options)
    {
        $this->getLightModuleConfig($options);
        $this->getServiceManagerConfig();
        return true;
        //$this->setUpConfig($controller);
    }

    public function introspectFromTable($table)
    {
        $this->db = $table;



        $this->mergeControllerConfig();
        $this->mergeRouterConfig();
        $this->mergeNavigationConfig();
        $this->mergeServiceManagerConfig();


        $this->getAssetManager()->mergeAssetManagerFromDb($table);

        if ($this->verifyUploadImageAssociation($this->db->getTable())) {
            $this->mergeUploadImageConfigAssociation();

        }

        if ($this->verifyUploadImageColumn($this->db)) {
            $this->mergeUploadImageColumn();

        }
        return true;


        //$this->getRouteConfig($controller);
        //
        //$this->getControllerConfig($controller);
        //$this->getServiceManagerConfig($controller);
    }


    public function mergeUploadImageConfigAssociation()
    {
        $tableName = $this->db->getTable();
        $this->tableName = $this->db->getTable();
        $this->tableNameUrl = $this->str('url', $tableName);
        //carrega arquivo criado anteriormente.

        $uploadImageConfig = include $this->getModule()->getConfigExtFolder().'/upload-image.config.php';

        $sizeAggregate = array();
        $size = '';

        if (!empty($uploadImageConfig)) {

            $sizeAggregate = $uploadImageConfig['size'***REMOVED***;
            $size .= $this->convertArrayBackToString($sizeAggregate, true);
        }


        $size .= $this->generateEmptyUploadImageLine($this->tableNameUrl);
        return $this->createUploadImageConfig($size);

    }



    public function mergeUploadImageColumn()
    {
        $tableName = $this->db->getTable();
        $this->tableName = $this->db->getTable();
        $this->tableNameUrl = $this->str('url', $tableName);
        //carrega arquivo criado anteriormente.

        $uploadImageConfig = include $this->getModule()->getConfigExtFolder().'/upload-image.config.php';

        $sizeAggregate = array();
        $size = '';

        if (!empty($uploadImageConfig)) {

            $sizeAggregate = $uploadImageConfig['size'***REMOVED***;
            $size .= $this->convertArrayBackToString($sizeAggregate, false);
        }

        foreach ($this->db->getColumns() as $column => $speciality) {

            if ('upload-image' == $speciality) {

                $sizeName = $this->tableNameUrl.'-'.$this->str('var', $column);
                if (!array_key_exists($sizeName, $sizeAggregate)) {
                    $size .= $this->generateUploadImageSpecialityLine($this->tableNameUrl.'-'.$this->str('var', $column));
                }

            }
        }

        return $this->createUploadImageConfig($size);
    }


    public function convertArrayBackToString($sizeAggregate, $checkTableUrl = false)
    {
        $size = '';
        if (is_array($sizeAggregate) && count($sizeAggregate)>0) {
            foreach ($sizeAggregate as $i => $sizes) {
                $size .= $this->convertUploadImageArrayToString($i, $sizes);
            }
        }

        return $size;
    }


    /**
     * Nome da entidade usada no arquivo upload-image.config.php
     * @return string
     */
    public function getEntityName()
    {
        $entity    = sprintf('%s\\Entity\UploadImage', $this->getModule()->getModuleName());
        return $entity;
    }

    /**
     * Pasta de upload usada no arquivo upload-image.config.php
     * @return string
     */
    public function getUploadDir()
    {
        $uploadDir = '/../../../../public/upload/';
        return $uploadDir;
    }

    /**
     * Pasta de referencia para imagens usada no arquivo upload-image.config.php
     * @return string
     */
    public function getRefDir()
    {
        $refDir    = '/upload';
        return $refDir;
    }

    public function createUploadImageConfig($size)
    {
        $fileCreator = $this->getServiceLocator()->get('fileCreator');

        $fileCreator->setTemplate('template/config/upload-image.config.phtml');
        $fileCreator->setOptions(array(
            'entityName' => $this->getEntityName(),
            'uploadDir'  => $this->getUploadDir(),
            'refDir'     => $this->getRefDir(),
            'size'       => $size
        ));
        $fileCreator->setFileName('upload-image.config.php');
        $fileCreator->setLocation($this->getModule()->getConfigExtFolder());

        //$fileCreator->debug();

        return $fileCreator->render();
    }


    public function generateEmptyUploadImageLine($tableNameUrl)
    {
        $line = <<<EOS
        '$tableNameUrl' => array(
            'pre' => array(100, 100),
            'lg' => array(800, 800),
            'md' => array(600, 600),
            'sm' => array(400, 400),
            'xs' => array(200, 200),
        ),

EOS;
        return $line;

    }

    public function generateUploadImageSpecialityLine($specialityName)
    {
        $line = <<<EOS
        '$specialityName' => array(
            'pre' => array(100, 100),
            'sm' => array(400, 400),
            'xs' => array(200, 200),
        ),

EOS;
        return $line;

    }

    public function convertUploadImageArrayToString($name, $sizes)
    {
        $line = <<<EOS
        '$name' => array(

EOS;

        foreach ($sizes as $i => $size) {
            $line .= <<<EOS
            '$i' => array($size[0***REMOVED***, $size[1***REMOVED***),

EOS;
        }

        $line .= <<<EOS
        ),

EOS;

        return $line;
    }

    public function decodeJson()
    {
        $this->json = \Zend\Json\Json::decode($this->json);
        return $this;
    }

    public function encodeJson()
    {
        $this->json = \Zend\Json\Json::encode($this->json);
        return $this;
    }

    public function loadJson()
    {
        $this->json = file_get_contents($this->json);
        return $this;
    }

    public function setJson($json)
    {
        $this->json = $json;
        return $this;
    }

    public function getJson()
    {
        return $this->json;
    }

    /**
     *
     * @param mixed $controller precisa ser compatível com o template "template/config/controller.phtml"
     * ['invokable' => 'modulo/controller/nome'***REMOVED***
     */
    public function mergeControllerConfig()
    {

        $controllerConfig = require $this->getModule()->getConfigExtFolder().'/controller.config.php';

        if (isset($controllerConfig['invokables'***REMOVED***)) {

            $invokables = $controllerConfig['invokables'***REMOVED***;

            if ($this->controller !== null) {

                $invokeName = sprintf($this->controller->getService()->getObject(), $this->getModule()->getModuleName());

                if (!array_key_exists($invokeName, $invokables)) {

                    $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%s', $this->getModule()->getModuleName(), $this->controller->getName());
                    $controllerConfig['invokables'***REMOVED*** = $invokables;
                    $this->arrayToFile($this->getModule()->getConfigExtFolder().'/controller.config.php', $controllerConfig);

                }
                return;
            }



            $module = $this->getModule()->getModuleName();
            $table = $this->db->getTable();

            $invokeName = sprintf('%s\Controller\%s', $module, $table);

            if (!array_key_exists($invokeName, $invokables)) {

                $invokables[$invokeName***REMOVED*** = sprintf('%s\Controller\%sController', $module, $table);
                $controllerConfig['invokables'***REMOVED*** = $invokables;
                $this->arrayToFile($this->getModule()->getConfigExtFolder().'/controller.config.php', $controllerConfig);

            }
        }
    }
    
    public function getDbRoute()
    {
        $routeModule = $this->str('url', $this->getModule()->getModuleName());
        $routeController = $this->str('url', $this->db()->getTable()); 
        
        $module = $this->getModule()->getModuleName();
        $table = $this->db()->getTable();
        
        $route = [
            'type' => 'segment',
            'options' => array(
                'route' => sprintf('/%s[/***REMOVED***', $routeModule),
                'defaults' => array(
                    'controller' => sprintf('%s\Controller\%s', $module, $table),
                    'action' => 'list'
                )
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'create' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{create}',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'create'
                        ),
                    )
                ),
                'edit' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'edit'
                        ),
                        'constraints' => array(
                            'id'     => '[0-9***REMOVED****',
                        ),
                    )
                ),
                'list' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{list}[/page/***REMOVED***[:page***REMOVED***[/orderBy***REMOVED***[/:orderBy***REMOVED***[/:order***REMOVED***[/:success***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'list'
                        ),
                        'constraints' => array(
                            'action' => '(?!\bpage\b)(?!\borderBy\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                            'page' => '[0-9***REMOVED***+',
                            'orderBy' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                            'order' => 'ASC|DESC',
                        ),
                    )
                ),
                'delete' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{delete}[/:id***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'delete'
                        ),
                        'constraints' => array(
                            'id'     => '[0-9***REMOVED****',
                        ),
                    )
                ),
                'view' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '{view}[/:id***REMOVED***',
                        'defaults' => array(
                            'controller' => sprintf('%s\Controller\%s', $module, $table),
                            'action' => 'view'
                        ),
                    )
                ),
            ),
            
        ***REMOVED***;

        
    }
    
    public function mergeRouterConfig()
    {        
        $routeConfig = require $this->getModule()->getConfigExtFolder().'/route.config.php';
    
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
        

        if (isset($routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***)) {
            
            /**
             * @TODO
             */
            
            if ($this->controller !== null) {
            
                $routeName = $this->str('url', $this->controller->getNameOff());
                
                if (!array_key_exists($routeName, $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
            
                    $controllerRoute = $this->getControllerRoute();
                    $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***[$routeName***REMOVED*** = $controllerRoute;
                          $this->arrayToFile($this->getModule()->getConfigExtFolder().'/route.config.php', $routeConfig);
            
                }
                    
            } else {
                
                $module = $this->getModule()->getModuleName();
                $table = $this->db->getTable();
                
                $routeName = $this->str('url', $this->controller->getNameOff());
                
                if (!array_key_exists($routeName, $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***)) {
                
                     $controllerRoute = $this->getDbRoute();
                     $routeConfig['routes'***REMOVED***[$moduleUrl***REMOVED***['child_routes'***REMOVED***[$routeName***REMOVED*** = $controllerRoute;
                     $this->arrayToFile($this->getModule()->getConfigExtFolder().'/route.config.php', $routeConfig);
                }   
                
            }
           
        }

        $this->getLanguageService()->mergeLanguageUp();
        
        return;
    }

  

    public function addControllerToNavigation()
    {
        $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
        $moduleLabel = $this->str('label', $this->getModule()->getModuleName());
        $controllerLabel = $this->str('label', $this->action->getController()->getNameOff());
        $controllerUrl   = $this->str('url', $this->action->getController()->getNameOff());


        $page = [
            'label' => $this->str('label', $this->action->getRoute()),
            'route' => sprintf('%s/%s/%s', $moduleUrl, $controllerUrl, $this->str('url', $this->action->getRoute()))
        ***REMOVED***;


        $new = [
            'label' => $controllerLabel,
            'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl),
            'pages' => [$page***REMOVED***
        ***REMOVED***;

        $this->navigation['default'***REMOVED***[***REMOVED*** = $new;


        $this->arrayToFile($this->getModule()->getConfigExtFolder().'/navigation.config.php',  $this->navigation);


       /*  foreach ($controller->getActions() as $action) {

            $new['pages'***REMOVED***[***REMOVED*** = ;
        } */
    }

    public function mergeNavigationConfig()
    {

        $navigation = require $this->getModule()->getConfigExtFolder().'/navigation.config.php';
        $this->navigation = $navigation;


        if ($this->action !== null) {

            if (isset($navigation['default'***REMOVED***)) {

                foreach ($navigation['default'***REMOVED*** as $i => $controller) {


                    if ($controller['route'***REMOVED*** ==
                        sprintf(
                            '%s-%s',
                            $this->str('url', $this->getModule()->getModuleName()),
                            $this->str('url', $this->action->getController()->getNameOff())
                       )
                    ) {

                        $this->addPageToNavigation();
                    }
                }

                $this->addControllerToNavigation();
            }

            return;
        }


        $this->controller = $this->getGearSchema()->getControllerByDb($this->db);

        if (isset($navigation['default'***REMOVED***)) {

            $moduleUrl = $this->str('url', $this->getModule()->getModuleName());
            $moduleLabel = $this->str('label', $this->getModule()->getModuleName());
            $controllerLabel = $this->str('label', $this->db->getTable());
            $controllerUrl   = $this->str('url', $this->db->getTable());

            foreach ($navigation['default'***REMOVED*** as $module) {

                if (isset($module['pages'***REMOVED***)) {

                    foreach ($module['pages'***REMOVED***  as $controller) {

                        if ($controller['route'***REMOVED*** == sprintf('%s/%s', $moduleUrl, $controllerUrl)) {
                            return;
                        }
                    }
                }



            }



            $new = [
                'label' => $this->str('label', $this->db->getTable(0)),
                'route' => sprintf('%s/%s', $moduleUrl, $controllerUrl),
                'pages' => [
            	 /*    [
                	    'label' => $action->getRoute(),
                	    'route' => sprintf('%s/%s/%s', $module, $controller, $action->getRoute())
                	***REMOVED*** */

                ***REMOVED***
            ***REMOVED***;

            foreach ($this->controller->getActions() as $action) {

                $new['pages'***REMOVED***[***REMOVED*** = [
            	    'label' => $action->getRoute(),
            	    'route' => sprintf('%s/%s/%s', $moduleUrl, $controllerUrl, $action->getRoute())
            	***REMOVED***;
            }

            foreach($navigation['default'***REMOVED*** as $i => $roles) {
                if ($roles['route'***REMOVED*** = $moduleUrl) {
                    $navigation['default'***REMOVED***[$i***REMOVED***['pages'***REMOVED***[***REMOVED*** = $new;
                    break;
                }
            }

            $this->arrayToFile($this->getModule()->getConfigExtFolder().'/navigation.config.php', $navigation);

        }

       /*  $controllersSet = $this->getGearSchema()->__extract('controller');

        $controllers = [***REMOVED***;
        foreach($controllersSet as $page) {

            $controller = new \Gear\ValueObject\Controller($page);
            $controllers[***REMOVED*** = $controller;
        }

        $module      = $this->getModule()->getModuleName();
        $moduleUrl   = $this->str('url', $this->getModule()->getModuleName());
        $moduleLabel = $this->str('label', $this->getModule()->getModuleName());

        $navigation = new \Gear\Config\Navigation($module, $moduleUrl, $moduleLabel, $controllers);
        $navigation->setStringService($this->getServiceLocator()->get('stringService'));

        file_put_contents($this->getModule()->getConfigExtFolder().'/navigation.config.php', $navigation->render()); */
    }


    public function triggerMergeServiceManager()
    {
        $serviceManager = new \Gear\Config\ServiceManager($this->getModule());
        $serviceManager->extractServiceManagerFromSrc($this->src);

        if (!isset($this->serviceManagerFile[$serviceManager->getPattern()***REMOVED***)) {
            $this->serviceManagerFile[$serviceManager->getPattern()***REMOVED*** = [***REMOVED***;
        }

        if (array_key_exists($serviceManager->getCallable(), $this->serviceManagerFile['invokables'***REMOVED***)) {
            return;
        }

        $data = $serviceManager->getArray();

        if ($serviceManager->getPattern() == 'invokables') {

            $this->serviceManagerFile['invokables'***REMOVED***[sprintf('%s\%s\%s', $this->getModule()->getModuleName(), $this->src->getType(), $this->src->getName())***REMOVED*** =
                sprintf('%s\%s\%s', $this->getModule()->getModuleName(), $this->src->getType(), (isset($data['invokables'***REMOVED***[0***REMOVED***['aliase'***REMOVED***) ? $data['invokables'***REMOVED***[0***REMOVED***['aliase'***REMOVED*** : $this->src->getName()));

             $this->arrayToFile($this->getModule()->getConfigExtFolder().'/servicemanager.config.php', $this->serviceManagerFile);

             return;
        }

        if ($serviceManager->getPattern() == 'factories') {
             $this->serviceManagerFile['factories'***REMOVED***[$data['factories'***REMOVED***[0***REMOVED***['callable'***REMOVED******REMOVED*** = $data['factories'***REMOVED***[0***REMOVED***['object'***REMOVED***;
             $this->arrayToFile($this->getModule()->getConfigExtFolder().'/servicemanager.config.php', $this->serviceManagerFile);
             return;
        }

    }

    public function mergeServiceManagerConfig()
    {
        $this->serviceManagerFile = require $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';

        if ($this->src !== null) {
            $this->triggerMergeServiceManager();
        }

        if ($this->db !== null) {
            $srcs = $this->getGearSchema()->getAllSrcByDb($this->db);

            foreach ($srcs as $src) {
                $this->src = $src;
                $this->triggerMergeServiceManager();
            }
        }

        return;



        $srcs = $this->getGearSchema()->__extract('src');

        $controllers = [***REMOVED***;

        foreach ($srcs as $src) {

            $srcObject = new \Gear\ValueObject\Src($src);

            $serviceManager = new \Gear\Config\ServiceManager($this->getModule());
            $serviceManager->extractServiceManagerFromSrc($srcObject);

            $controllers = array_merge_recursive($serviceManager->getArray(), $controllers);
        }

        $this->createFileFromTemplate(
            'template/config/servicemanager.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'factories' => (isset($controllers['factories'***REMOVED***) && count($controllers['factories'***REMOVED*** >0) ? $controllers['factories'***REMOVED*** : array()),
                'invokables' => (isset($controllers['invokables'***REMOVED***) && count($controllers['invokables'***REMOVED***>0) ? $controllers['invokables'***REMOVED*** : array())
            ),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getServiceManager()
    {
        return include $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';
    }



    public function getServiceManagerConfig($controllers = array())
    {
        $this->createFileFromTemplate(
            'template/config/servicemanager.empty.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'controllers' => $controllers
            ),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }


    public function generateForEmptyModule()
    {
        $controller = array(
            sprintf('%s\Controller\Index', $this->getModule()->getModuleName()) =>
            sprintf('%s\Controller\IndexController', $this->getModule()->getModuleName())
        );

        $this->getModuleConfig($controller);

        $this->setUpConfig($controller);
    }


    public function generateForAngular()
    {
        $controller = array(
            sprintf('%s\Controller\Index', $this->getModule()->getModuleName()) =>
            sprintf('%s\Controller\IndexController', $this->getModule()->getModuleName())
        );

        $this->getModuleAngular($controller);

        $this->setUpAngular($controller);
    }

    public function getLightModuleConfig($options = array())
    {
        return $this->createFileFromTemplate(
            'template/config/light-module.phtml',
            array(
                'options' => $options,
                'module' => $this->getModule()->getModuleName(),
            ),
            'module.config.php',
            $this->getModule()->getConfigFolder()
        );
    }

    public function getControllerPluginConfig()
    {
        return $this->createFileFromTemplate(
            'template/config/controller-plugins.phtml',
            array(

            ),
            'controllerplugins.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }


    public function getModuleConfig($controllers)
    {
        return $this->createFileFromTemplate(
            'template/module/config/module.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'controllers' => $controllers
            ),
            'module.config.php',
            $this->getModule()->getConfigFolder()
        );
    }

    public function getModuleAngular($controllers)
    {
        return $this->createFileFromTemplate(
            'template/config/module-angular.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'controllers' => $controllers
            ),
            'module.config.php',
            $this->getModule()->getConfigFolder()
        );
    }

    public function setUpConfig($controller)
    {
        $this->getDbConfig();
        $this->getDoctrineConfig();
        $this->getViewConfig();
        $this->getRouteConfig($controller);
        $this->getNavigationConfig($controller);
        $this->getControllerConfig($controller);
        $this->getControllerPluginConfig();
        $this->getTranslatorConfig();
        $this->getServiceManagerConfig($controller);
        $this->getAssetConfig();
        $this->getEmptyUploadImage();
    }

    public function setUpAngular($controller)
    {
        $this->getViewAngularConfig();
        $this->getRouteConfig($controller);
        $this->getNavigationConfig($controller);
        $this->getControllerConfig($controller);
        $this->getServiceManagerConfig($controller);
        $this->getAssetAngularConfig();
    }


    public function getEmptyUploadImage()
    {
        $this->createFileFromTemplate(
            'template/config/empty-upload-image.phtml',
            array(),
            'upload-image.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }


    public function getControllerConfig($controllers)
    {
        $this->createFileFromTemplate(
            'template/config/controller.phtml',
            array(
                'controllers' => $controllers
            ),
            'controller.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getNavigationConfig($controllers)
    {
        $this->createFileFromTemplate(
            'template/config/navigation.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'moduleLabel' => $this->str('label', $this->getModule()->getModuleName()),
                'controllers' => $controllers
            ),
            'navigation.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getRouteConfig($controllers)
    {
        $this->createFileFromTemplate(
            'template/config/route.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
                'controllers' => $controllers
            ),
            'route.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }




    public function getDbConfig()
    {
        $this->createFileFromTemplate(
            'template/config/db.mysql.config.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'db.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getDoctrineConfig()
    {
        $this->createFileFromTemplate(
            'template/config/doctrine.mysql.config.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'doctrine.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getAssetConfig()
    {
        $this->createFileFromTemplate(
            'template/config/asset.config.phtml',
            array(),
            'asset.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function addAsset($collectionName, $newAsset)
    {

    }

    public function getAssetAngularConfig()
    {
        $opt = [
            'moduleCss' => sprintf('%s.css', $this->str('point', $this->getModule()->getModuleName())),
            'moduleJs' => sprintf('%s.js', $this->str('url', $this->getModule()->getModuleName())),
            'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleCssName' => $this->str('point', $this->getModule()->getModuleName())
        ***REMOVED***;

        $this->createFileFromTemplate(
            'template/config/asset.angular.config.phtml',
            $opt,
            'asset.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getTranslatorConfig()
    {
        $this->createFileFromTemplate(
            'template/config/translator.config.phtml',
            array(),
            'translator.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getViewConfig()
    {
        $this->createFileFromTemplate(
            'template/config/view.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'view.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getViewAngularConfig()
    {
        $this->createFileFromTemplate(
            'template/config/view.angular.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'view.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }


	public function getLanguageService()
	{
	    if (!isset($languageService)) {
	        $this->languageService = $this->getServiceLocator()->get('languageService');
	    }
		return $this->languageService;
	}

	public function setLanguageService($languageService)
	{
		$this->languageService = $languageService;
		return $this;
	}

}
