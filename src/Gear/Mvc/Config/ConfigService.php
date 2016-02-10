<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;

class ConfigService extends AbstractJsonService
{
    use \Gear\Mvc\Config\AssetManagerTrait;
    use \Gear\Mvc\Config\ServiceManagerTrait;
    use \Gear\Mvc\Config\RouterTrait;
    use \Gear\Mvc\Config\NavigationTrait;
    use \Gear\Mvc\Config\UploadImageTrait;
    use \Gear\Mvc\Config\ControllerTrait;

    protected $json;

    protected $controllers;

    protected $languageService;
    /**
     * Função responsável por criar as configurações iniciais para Novos Módulos.
     *
     * @param GearJson\Controller\Controller $controller
     *
     * @return null
     */
    public function setUpConfig($controller)
    {
        $this->getDbConfig();
        $this->getDoctrineConfig();
        $this->getViewConfig();

        $this->getRouter()->getRouteConfig($controller);
        $this->getNavigation()->getNavigationConfig($controller);
        $this->getControllerConfig()->getControllerConfig($controller);
        $this->getServiceManager()->createModule($controller);
        $this->getUploadImage()->getEmptyUploadImage();

        $this->getControllerPluginConfig();
        $this->getCacheConfig();
        $this->getTranslatorConfig();
        $this->getAssetConfig();

    }

    public function generateForLightModule($options)
    {
        $this->getLightModuleConfig($options);
        $this->getServiceManagerConfig();
        return true;
        //$this->setUpConfig($controller);
    }

   /**
     * Função responsável por adicionar as configurações de um DB à um módulo já existente.
     *
     * @param GearJson\Db\Db $table
     *
     * @return null
     */
    public function introspectFromTable($table)
    {
        $this->db = $table;

        $this->getControllerConfig()->mergeFromDb($this->db);
        $this->getRouter()->mergeFromDb($this->db);
        $this->getNavigation()->mergeFromDb($this->db);
        $this->getServiceManager()->mergeFromDb($this->db);


        $this->getAssetManager()->mergeAssetManagerFromDb($table);

        if ($this->verifyUploadImageAssociation($this->db->getTable())) {

            $this->getUploadImage()->mergeUploadImageConfigAssociationFromDb($this->db);

            $uploadFolder = $this->getModule()->getPublicUploadFolder().'/'.$this->str('url', $this->db->getTable());
            if (!is_dir($uploadFolder)) {
                $this->getModule()->getDirService()->mkDir($uploadFolder);
            }
            $this->getModule()->writable($uploadFolder);
        }

        if ($this->verifyUploadImageColumn($this->db)) {

            $this->getUploadImage()->mergeUploadImageColumnFromDb($this->db);
        }
        return true;


        //$this->getRouteConfig($controller);
        //
        //$this->getControllerConfig($controller);
        //$this->getServiceManagerConfig($controller);
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
     * Cria toda configuração inicial para novos módulos
     */
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


    public function setUpAngular($controller)
    {
        $this->getViewAngularConfig();
        $this->getRouter()->getRouteConfig($controller);
        $this->getNavigation()->getNavigationConfig($controller);
        $this->getControllerConfig()->getControllerConfig($controller);
        $this->getServiceManager()->createModule($controller);
        $this->getAssetAngularConfig();
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
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUline' => $this->str('uline', $this->getModule()->getModuleName())
            ),
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

    public function getCacheConfig()
    {
        $module = strtoupper($this->getModule()->getModuleName());
        $this->createFileFromTemplate(
            'template/config/cache.config.phtml',
            array('module' => $module),
            'cache.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    /**
     * Cria arquivo [module***REMOVED***/config/ext/translator.config.php.
     *
     * @return null
     */
    public function getTranslatorConfig()
    {
        $this->createFileFromTemplate(
            'template/config/translator.config.phtml',
            array(),
            'translator.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    /**
     * Cria arquivo [module***REMOVED***/config/ext/view.config.php.
     *
     * @return null
     */
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



}
