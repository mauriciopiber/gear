<?php
namespace Gear\Mvc\Config;

use Gear\Service\AbstractJsonService;
use GearJson\Schema\SchemaServiceTrait;
use Gear\Module\ModuleConstructorInterface;
use GearJson\Db\Db;

class ConfigService extends AbstractJsonService implements ModuleConstructorInterface
{
    use SchemaServiceTrait;
    use \Gear\Mvc\Config\AssetManagerTrait;
    use \Gear\Mvc\Config\RouterManagerTrait;
    use \Gear\Mvc\Config\ConsoleRouterManagerTrait;
    use \Gear\Mvc\Config\NavigationManagerTrait;
    use \Gear\Mvc\Config\UploadImageManagerTrait;
    use \Gear\Mvc\Config\ServiceManagerTrait;
    use \Gear\Mvc\Config\ControllerManagerTrait;
    use \Gear\Mvc\Config\ControllerPluginManagerTrait;
    use \Gear\Mvc\Config\ViewHelperManagerTrait;

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

   /**
     * Função responsável por adicionar as configurações de um DB à um módulo já existente.
     *
     * @param GearJson\Db\Db $table
     *
     * @return null
     */
    public function introspectFromTable(Db $db)
    {
        $this->db = $db;

        $controller = $this->getSchemaService()->getControllerByDb($this->db);
        $actions = $controller->getActions();

        $srcs = $this->getSchemaService()->getAllSrcByDb($this->db);

        foreach ($actions as $action) {
            $action->setController($controller);
            $action->setDb($this->db);
            $this->getRouterManager()->create($action);
            $this->getNavigationManager()->create($action);
        }

        $this->getControllerManager()->create($controller);

        foreach ($srcs as $src) {
            $this->getServiceManager()->create($src);
        }

        $this->getAssetManager()->mergeAssetManagerFromDb($this->db);

        if ($this->verifyUploadImageAssociation($this->db->getTable())) {

            $this->getUploadImageManager()->mergeUploadImageConfigAssociationFromDb($this->db);

            $uploadFolder = $this->getModule()->getPublicUploadFolder().'/'.$this->str('url', $this->db->getTable());
            if (!is_dir($uploadFolder)) {
                $this->getModule()->getDirService()->mkDir($uploadFolder);
            }
            $this->getModule()->writable($uploadFolder);
        }

        if ($this->verifyUploadImageColumn($this->db)) {

            $this->getUploadImageManager()->mergeUploadImageColumnFromDb($this->db);
        }
        return true;


        //$this->getRouteConfig($controller);
        //
        //$this->getControllerConfig($controller);
        //$this->getServiceManagerConfig($controller);
    }


    /**
     * Cria toda configuração inicial para novos módulos
     */
    public function module()
    {
        $controller = array(
            sprintf('%s\Controller\Index', $this->getModule()->getModuleName()) =>
            sprintf('%s\Controller\IndexController', $this->getModule()->getModuleName())
        );

        $this->getModuleConfig($controller);
        $this->getDbConfig();
        $this->getDoctrineConfig();
        $this->getViewConfig();
        $this->getControllerPluginManager()->module($controller);
        $this->getCacheConfig();
        $this->getTranslatorConfig();

        $this->getViewHelperManager()->module($controller);
        $this->getAssetManager()->module($controller);
        $this->getConsoleRouterManager()->module($controller);
        $this->getRouterManager()->module($controller);
        $this->getNavigationManager()->module($controller);
        $this->getControllerManager()->module($controller);
        $this->getServiceManager()->module($controller);
        $this->getUploadImageManager()->module($controller);
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
        return $this->getFileCreator()->createFile(
            'template/config/light-module.phtml',
            array(
                'options' => $options,
                'module' => $this->getModule()->getModuleName(),
            ),
            'module.config.php',
            $this->getModule()->getConfigFolder()
        );
    }

    public function getModuleConfig($controllers)
    {
        return $this->getFileCreator()->createFile(
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
        return $this->getFileCreator()->createFile(
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
        $this->getFileCreator()->createFile(
            'template/config/db.mysql.config.phtml',
            array('module' => $this->getModule()->getModuleName()),
            'db.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getDoctrineConfig()
    {
        $this->getFileCreator()->createFile(
            'template/config/doctrine.mysql.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUline' => $this->str('uline', $this->getModule()->getModuleName())
            ),
            'doctrine.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }



    public function getAssetAngularConfig()
    {
        $opt = [
            'moduleCss' => sprintf('%s.css', $this->str('point', $this->getModule()->getModuleName())),
            'moduleJs' => sprintf('%s.js', $this->str('url', $this->getModule()->getModuleName())),
            'moduleName' => $this->str('class', $this->getModule()->getModuleName()),
            'moduleCssName' => $this->str('point', $this->getModule()->getModuleName())
        ***REMOVED***;

        $this->getFileCreator()->createFile(
            'template/config/asset.angular.config.phtml',
            $opt,
            'asset.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getCacheConfig()
    {
        $module = strtoupper($this->getModule()->getModuleName());
        $this->getFileCreator()->createFile(
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
        $this->getFileCreator()->createFile(
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
        $this->getFileCreator()->createFile(
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
        $this->getFileCreator()->createFile(
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
