<?php
namespace Gear\Mvc\Config;

use Gear\Mvc\Config\AbstractConfigManager;
use Gear\Schema\Schema\SchemaServiceTrait;
use Gear\Module\ModuleConstructorInterface;
use Gear\Schema\Db\Db;
use Exception;
use Gear\Module\Structure\ModuleStructure;
use Gear\Module\Structure\ModuleStructureTrait;
use Gear\Util\String\StringService;
use Gear\Util\String\StringServiceTrait;
use Gear\Creator\FileCreator\FileCreator;
use Gear\Creator\FileCreator\FileCreatorTrait;

use \Gear\Mvc\Config\AssetManagerTrait;
use \Gear\Mvc\Config\RouterManagerTrait;
use \Gear\Mvc\Config\ConsoleRouterManagerTrait;
use \Gear\Mvc\Config\NavigationManagerTrait;
use \Gear\Mvc\Config\UploadImageManagerTrait;
use \Gear\Mvc\Config\ServiceManagerTrait;
use \Gear\Mvc\Config\ControllerManagerTrait;
use \Gear\Mvc\Config\ControllerPluginManagerTrait;
use \Gear\Mvc\Config\ViewHelperManagerTrait;
use \Gear\Mvc\Config\AssetManager;
use \Gear\Mvc\Config\RouterManager;
use \Gear\Mvc\Config\ConsoleRouterManager;
use \Gear\Mvc\Config\NavigationManager;
use \Gear\Mvc\Config\UploadImageManager;
use \Gear\Mvc\Config\ServiceManager;
use \Gear\Mvc\Config\ControllerManager;
use \Gear\Mvc\Config\ControllerPluginManager;
use \Gear\Mvc\Config\ViewHelperManager;

class ConfigService implements ModuleConstructorInterface
{
    use ModuleStructureTrait;
    use StringServiceTrait;
    use FileCreatorTrait;

    use SchemaServiceTrait;
    use AssetManagerTrait;
    use RouterManagerTrait;
    use ConsoleRouterManagerTrait;
    use NavigationManagerTrait;
    use UploadImageManagerTrait;
    use ServiceManagerTrait;
    use ControllerManagerTrait;
    use ControllerPluginManagerTrait;
    use ViewHelperManagerTrait;

    public function __construct(
        ModuleStructure $module,
        StringService $string,
        FileCreator $file,
        AssetManager $asset,
        RouterManager $route,
        ConsoleRouterManager $consoleRoute,
        NavigationManager $navigationManager,
        UploadImageManager $uploadImage,
        ServiceManager $serviceManager,
        ControllerManager $controllerManager,
        ControllerPluginManager $controllerPluginManager,
        ViewHelperManager $viewHelperManager
    ) {
        $this->setFileCreator($file);
        $this->setStringService($string);
        $this->setModule($module);
        $this->setAssetManager($asset);
        $this->setRouterManager($route);
        $this->setConsoleRouterManager($consoleRoute);
        $this->setNavigationManager($navigationManager);
        $this->setUploadImageManager($uploadImage);
        $this->setServiceManager($serviceManager);
        $this->setControllerManager($controllerManager);
        $this->setControllerPluginManager($controllerPluginManager);
        $this->setViewHelperManager($viewHelperManager);
    }

    protected $json;

    protected $controllers;

    protected $languageService;

    const GIT_PATTERN = 'git@bitbucket.org:mauriciopiber/%s.git';

   /**
     * Função responsável por adicionar as configurações de um DB à um módulo já existente.
     *
     * @param Gear\Schema\Db\Db $table
     *
     * @return null
     */
    public function introspectFromTable(Db $db)
    {
        $this->db = $db;

        $controller = $this->getSchemaService()->getControllerByDb($this->db);
        $controller->setDb($this->db);
        $actions = $controller->getActions();

        $srcs = $this->getSchemaService()->getAllSrcByDb($this->db);

        foreach ($actions as $action) {
            $action->setController($controller);
            //$action->setDb($this->db);
        }

        $this->getNavigationManager()->createDb($actions);

        foreach ($actions as $action) {
            $this->getRouterManager()->create($action);
        }

        //controller manager
        $this->getControllerManager()->create($controller);

        //service manager
        foreach ($srcs as $src) {
            $this->getServiceManager()->create($src);
        }

        //asset manager
        $this->getAssetManager()->mergeAssetManagerFromDb($this->db);


        $this->introspectUploadImage($this->db);
        return true;
    }

    public function introspectUploadImage(Db $db)
    {
        $this->db = $db;
        $this->columnManager = $this->db->getColumnManager();


        if (empty($this->columnManager)) {
            throw new Exception(
                sprintf(
                    'Missing Column Manager on %s %s',
                    __FUNCTION__,
                    $this->db->getTable()
                )
            );
        }

        //verifica associação com tabelas.
        if ($this->getTableService()->verifyTableAssociation($this->db->getTable())) {
            $this->getUploadImageManager()->mergeUploadImageConfigAssociationFromDb($this->db);

            $uploadFolder = $this->getModule()->getPublicUploadFolder().'/'.$this->str('url', $this->db->getTable());
            if (!is_dir($uploadFolder)) {
                $this->getDirService()->mkDir($uploadFolder);
            }
            $this->getModule()->writable($uploadFolder);
        }




        //verifica associação com colunas
        if ($this->columnManager->isAssociatedWith('Gear\Column\Varchar\UploadImage')) {
            $this->getUploadImageManager()->mergeUploadImageColumnFromDb($this->db);
        }
    }


    /**
     * Cria toda configuração inicial para novos módulos
     */
    public function module($type = 'web', $staging = null)
    {
        $controller = [
            sprintf('%s\Controller\Index', $this->getModule()->getNamespace()) =>
            sprintf('%s\Controller\IndexControllerFactory', $this->getModule()->getNamespace())
        ***REMOVED***;

        $this->getModuleConfig($type, $controller, null, $staging);

        switch ($type) {
            case 'web':
                $this->getViewConfig($type);
                $this->getAssetManager()->module($controller);
                $this->getRouterManager()->module($type, $controller);
                $this->getNavigationManager()->module($controller);
                $this->getViewHelperManager()->module($controller);
                $this->getUploadImageManager()->module($controller);
                $this->getDbConfig();
                //$this->getDoctrineConfig();
                $this->getControllerManager()->module($controller);
                $this->getControllerPluginManager()->module($controller);
                $this->getCacheConfig();
                $this->getTranslatorConfig();
                $this->getServiceManager()->module();
            case 'cli':
                $this->getConsoleRouterManager()->module($controller);
                $this->getDbConfig();
                //$this->getDoctrineConfig();
                $this->getControllerManager()->module($controller);
                $this->getControllerPluginManager()->module($controller);
                $this->getCacheConfig();
                $this->getTranslatorConfig();
                $this->getServiceManager()->module();
                break;

            case 'api':
                $this->getViewConfig($type);
                $this->getRouterManager()->module($type, $controller);
                $this->getDbConfig();
                //$this->getDoctrineConfig();
                $this->getControllerManager()->module($controller);
                $this->getControllerPluginManager()->module($controller);
                $this->getCacheConfig();
                $this->getServiceManager()->module();
                break;

            case 'src':
            case 'src-zf2':
            case 'src-zf3':
                $this->getServiceManager()->module();
                break;
        }

        $this->createConfigVersion();




        return true;
    }

    public function createConfigVersion()
    {
        $path = $this->getModule()->getConfigFolder() . '/version';
        $version = '0.1.0';

        file_put_contents($path, $version);

        $path = $this->getModule()->getConfigFolder() . '/strategy';
        $strategy = 'major';

        file_put_contents($path, $strategy);

        $path = $this->getModule()->getConfigFolder() . '/stability';
        $stability = 'alpha';

        file_put_contents($path, $stability);
    }

    public function getGit($git = null)
    {
        if (!empty($git)) {
            return $git;
        }

        return sprintf(self::GIT_PATTERN, $this->str('url', $this->getModule()->getModuleName()));
    }

    public function getModuleConfig($type, $controllers, $git = null, $staging = null)
    {
        $git = $this->getGit($git);

        $options = [
            'module' => $this->getModule()->getNamespace(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'controllers' => $controllers,
            'git' => $git
        ***REMOVED***;

        if ($type == 'web') {
            $host = sprintf('%s.gear.dev', $this->str('url', $this->getModule()->getModuleName()));

            $options['staging'***REMOVED*** = $staging;
            $options['development'***REMOVED*** = $host;
            $options['testing'***REMOVED*** = $host;
        }

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/config/module-config/module.config.%s.phtml', $type));
        $file->setOptions($options);
        $file->setFileName('module.config.php');
        $file->setLocation($this->getModule()->getConfigFolder());

        return $file->render();
    }

    public function getDbConfig()
    {
        $this->getFileCreator()->createFile(
            'template/module/config/db.mysql.config.phtml',
            [
                'module' => $this->getModule()->getNamespace(),
                'moduleDb' => $this->str('uline', $this->getModule()->getModuleName()),
            ***REMOVED***,
            'db.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getDoctrineConfig()
    {
        $this->getFileCreator()->createFile(
            'template/module/config/doctrine.mysql.config.phtml',
            array(
                'module' => $this->getModule()->getNamespace(),
                'moduleUline' => $this->str('uline', $this->getModule()->getModuleName())
            ),
            'doctrine.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }

    public function getCacheConfig()
    {
        $module = strtoupper($this->getModule()->getModuleName());
        $this->getFileCreator()->createFile(
            'template/module/config/cache.config.phtml',
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
            'template/module/config/translator.config.phtml',
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
    public function getViewConfig($type = 'web')
    {
        $this->getFileCreator()->createFile(
            sprintf('template/module/config/view.config.%s.phtml', $type),
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'view.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
