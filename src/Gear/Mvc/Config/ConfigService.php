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

    const GIT_PATTERN = 'git@bitbucket.org:mauriciopiber/%s.git';

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

        //verifica associação com tabelas.
        if ($this->getTableService()->verifyTableAssociation($this->db->getTable())) {
            $this->getUploadImageManager()->mergeUploadImageConfigAssociationFromDb($this->db);

            $uploadFolder = $this->getModule()->getPublicUploadFolder().'/'.$this->str('url', $this->db->getTable());
            if (!is_dir($uploadFolder)) {
                $this->getModule()->getDirService()->mkDir($uploadFolder);
            }
            $this->getModule()->writable($uploadFolder);
        }

        //verifica associação com colunas
        if ($this->getColumnService()->verifyColumnAssociation($this->db, 'Gear\\Column\\Varchar\\UploadImage')) {
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
    public function module($type = 'web', $staging = null)
    {
        $controller = array(
            sprintf('%s\Controller\Index', $this->getModule()->getModuleName()) =>
            sprintf('%s\Controller\IndexControllerFactory', $this->getModule()->getModuleName())
        );

        $this->getModuleConfig($type, $controller, null, $staging);


        switch ($type) {
            case 'web':
                $this->getViewConfig();
                $this->getAssetManager()->module($controller);
                $this->getRouterManager()->module($controller);
                $this->getNavigationManager()->module($controller);
                $this->getViewHelperManager()->module($controller);
                $this->getUploadImageManager()->module($controller);
                break;
            case 'cli':
                $this->getConsoleRouterManager()->module($controller);
                break;
        }

        $this->getDbConfig();
        $this->getDoctrineConfig();
        $this->getControllerManager()->module($controller);
        $this->getControllerPluginManager()->module($controller);
        $this->getCacheConfig();
        $this->getTranslatorConfig();
        $this->getServiceManager()->module();


        return true;
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

        $options = array(
            'module' => $this->getModule()->getModuleName(),
            'moduleUrl' => $this->str('url', $this->getModule()->getModuleName()),
            'controllers' => $controllers,
            'git' => $git
        );

        if ($type == 'web') {
            $host = sprintf('%s.gear.dev', $this->str('url', $this->getModule()->getModuleName()));

            $options['staging'***REMOVED*** = $staging;
            $options['development'***REMOVED*** = $host;
            $options['testing'***REMOVED*** = $host;
        }

        $file = $this->getFileCreator();
        $file->setTemplate(sprintf('template/module/config/module.config.%s.phtml', $type));
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
                'module' => $this->getModule()->getModuleName(),
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
                'module' => $this->getModule()->getModuleName(),
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
    public function getViewConfig()
    {
        $this->getFileCreator()->createFile(
            'template/module/config/view.config.phtml',
            array(
                'module' => $this->getModule()->getModuleName(),
                'moduleUrl' => $this->str('url', $this->getModule()->getModuleName())
            ),
            'view.config.php',
            $this->getModule()->getConfigExtFolder()
        );
    }
}
