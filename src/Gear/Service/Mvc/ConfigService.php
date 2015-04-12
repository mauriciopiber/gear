<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class ConfigService extends AbstractJsonService
{
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


        if ($this->verifyUploadImageAssociation($this->db->getTable())) {
            $this->mergeUploadImageConfigAssociation();
        }

        if ($this->verifyUploadImageColumn($this->db)) {
            $this->mergeUploadImageColumn();
        }


        //$this->getRouteConfig($controller);
        //
        //$this->getControllerConfig($controller);
        //$this->getServiceManagerConfig($controller);
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
            $size .= $this->convertArrayBackToString($sizeAggregate);
        }

        $size .= $this->generateEmptyUploadImageLine($this->tableNameUrl);

        return $this->createUploadImageConfig($size);

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

        $fileCreator->debug();

        return $fileCreator->render();
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
            $size .= $this->convertArrayBackToString($sizeAggregate);
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

    public function convertArrayBackToString($sizeAggregate)
    {
        $size = '';
        if (is_array($sizeAggregate) && count($sizeAggregate)>0) {
            foreach ($sizeAggregate as $i => $sizes) {

                if ($i != $this->tableNameUrl) {
                    $size .= $this->convertUploadImageArrayToString($i, $sizes);
                }
            }
        }

        return $size;
    }

    public function mergeUploadImageConfig($tableName)
    {



    }

    public function getController($json)
    {
        if (!isset($this->controllers)) {
            $this->setJson($json)->loadJson()->decodeJson();

            $module = $this->getConfig()->getModule();

            $controllers = $this->json->$module->controller;

            $this->controllers = $controllers;
        }
        return $this->controllers;
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
        $controllers = $this->getGearSchema()->__extract('controller');

        $formatted = array();
        foreach ($controllers as $controllerArray) {

            $controller = new \Gear\ValueObject\Controller($controllerArray);

            $formatted[sprintf($controller->getService()->getObject(), $this->getConfig()->getModule())***REMOVED*** =
            sprintf('%s\Controller\%s', $this->getConfig()->getModule(), $controller->getName());
        }

        $this->createFileFromTemplate(
            'template/config/controller.phtml',
            array(
                'controllers' => $formatted
            ),
            'controller.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function mergeServiceManagerConfig()
    {
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
                'module' => $this->getConfig()->getModule(),
                'factories' => (isset($controllers['factories'***REMOVED***) && count($controllers['factories'***REMOVED*** >0) ? $controllers['factories'***REMOVED*** : array()),
                'invokables' => $controllers['invokables'***REMOVED***
            ),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getServiceManager()
    {
        return include $this->getModule()->getConfigExtFolder().'/servicemanager.config.php';
    }

    public function mergeNavigationConfig()
    {
        $controllersSet = $this->getGearSchema()->__extract('controller');

        $controllers = [***REMOVED***;
        foreach($controllersSet as $page) {

            $controller = new \Gear\ValueObject\Controller($page);
            $controllers[***REMOVED*** = $controller;
        }

        $this->createFileFromTemplate(
            'template/config/navigation.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'moduleLabel' => $this->str('label', $this->getConfig()->getModule()),
                'controllers' => $controllers
            ),
            'navigation.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }


    public function getServiceManagerConfig($controllers = array())
    {
        $this->createFileFromTemplate(
            'template/config/servicemanager.empty.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'controllers' => $controllers
            ),
            'servicemanager.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function mergeRouterConfig()
    {
        $controllersSet = $this->getGearSchema()->__extract('controller');

        $controllers = [***REMOVED***;
        foreach($controllersSet as $page) {

            $controller = new \Gear\ValueObject\Controller($page);
            $controllers[***REMOVED*** = $controller;
        }
        //var_dump($controllers);
        $this->createFileFromTemplate(
            'template/config/route.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'controllers' => $controllers
            ),
            'route.config.php',
            $this->getModule()->getConfigExtFolder()
        );

        $this->getLanguageService()->mergeLanguageUp();
    }


    public function generateForEmptyModule()
    {
        $controller = array(
            sprintf('%s\Controller\Index', $this->getConfig()->getModule()) =>
            sprintf('%s\Controller\IndexController', $this->getConfig()->getModule())
        );

        $this->getModuleConfig($controller);

        $this->setUpConfig($controller);
    }

    public function getLightModuleConfig($options = array())
    {
        return $this->createFileFromTemplate(
            'template/config/light-module.phtml',
            array(
                'options' => $options,
                'module' => $this->getConfig()->getModule(),
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
            'template/config/module.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
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
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'moduleLabel' => $this->str('label', $this->getConfig()->getModule()),
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
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'controllers' => $controllers
            ),
            'route.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }




    public function getDbConfig()
    {
        $this->createFileFromTemplate(
            'template/config/db.sqlite.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'db.testing.config.php',
            $this->getModule()->getConfigExtFolder()
        );

        $this->createFileFromTemplate(
            'template/config/db.mysql.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'db.development.config.php',
            $this->getModule()->getConfigExtFolder()
        );
        $this->createFileFromTemplate(
            'template/config/db.mysql.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'db.production.config.php',
            $this->getModule()->getConfigExtFolder()
        );

        $this->createFileFromTemplate(
            'template/config/db.mysql.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'db.staging.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getDoctrineConfig()
    {
        $this->createFileFromTemplate(
            'template/config/doctrine.mysql.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.development.config.php',
            $this->getModule()->getConfigExtFolder()
        );
        $this->createFileFromTemplate(
            'template/config/doctrine.mysql.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.production.config.php',
            $this->getModule()->getConfigExtFolder()
        );
        $this->createFileFromTemplate(
            'template/config/doctrine.sqlite.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.testing.config.php',
            $this->getModule()->getConfigExtFolder()
        );

        $this->createFileFromTemplate(
            'template/config/doctrine.mysql.config.phtml',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.staging.config.php',
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
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
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
