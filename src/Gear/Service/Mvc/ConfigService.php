<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class ConfigService extends AbstractJsonService
{
    protected $json;

    protected $pages;

    public function getPages($json)
    {
        if (!isset($this->pages)) {
            $this->setJson($json)->loadJson()->decodeJson();

            $module = $this->getConfig()->getModule();

            $pages = $this->json->$module->page;

            $this->pages = $pages;
        }
        return $this->pages;
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
    public function mergeControllerConfig($json)
    {
        $controllers = $this->getPages($json);

        $formatted = array();
        foreach ($controllers as $controller) {
            $formatted[sprintf($controller->invokable, $this->getConfig()->getModule())***REMOVED*** =
                sprintf('%s\Controller\%s', $this->getConfig()->getModule(), $controller->controller);
        }

        $this->createFileFromTemplate(
            'template/config/controller.phtml',
            array(
                'controllers' => $formatted
            ),
            'controller.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );

    }

    public function mergeNavigationConfig($json)
    {
        $controllers = $this->getPages($json);
        $pages = [***REMOVED***;
        foreach($controllers as $page) {

            $controller = new \Gear\ValueObject\Controller($page);
            $pages[***REMOVED*** = $controller;
        }

        $this->createFileFromTemplate(
            'template/config/navigation.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'moduleLabel' => $this->str('label', $this->getConfig()->getModule()),
                'controllers' => $pages
            ),
            'navigation.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function mergeRouteConfig($json)
    {
        $controllers = $this->getPages($json);
        $pages = [***REMOVED***;
        foreach($controllers as $page) {

            $controller = new \Gear\ValueObject\Controller($page);
            $pages[***REMOVED*** = $controller;
        }

        $this->createFileFromTemplate(
            'template/config/route.phtml',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'controllers' => $pages
            ),
            'route.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function getNavigationConfig($controllers)
    {
        $this->createFileFromTemplate(
            'config/navigation.config',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'moduleLabel' => $this->str('label', $this->getConfig()->getModule()),
                'controllers' => $controllers
            ),
            'navigation.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }


    public function getControllerConfig($controllers)
    {
        $this->createFileFromTemplate(
            'config/controller.config',
            array(
                'controllers' => $controllers
            ),
            'controller.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function getRouteConfig($controllers)
    {
        $this->createFileFromTemplate(
            'config/route.config',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule()),
                'controllers' => $controllers
            ),
            'route.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
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
    }

    public function getControllerPluginConfig()
    {
        return $this->createFileFromTemplate(
            'template/config/controller-plugins.phtml',
            array(

            ),
            'controllerplugins.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext/'
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
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/'
        );
    }

    public function getDbConfig()
    {
        $this->createFileFromTemplate(
            'config/db.sqlite.config',
            array('module' => $this->getConfig()->getModule()),
            'db.testing.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );

        $this->createFileFromTemplate(
            'config/db.mysql.config',
            array('module' => $this->getConfig()->getModule()),
            'db.development.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
        $this->createFileFromTemplate(
            'config/db.mysql.config',
            array('module' => $this->getConfig()->getModule()),
            'db.production.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );

        $this->createFileFromTemplate(
            'config/db.mysql.config',
            array('module' => $this->getConfig()->getModule()),
            'db.staging.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function getDoctrineConfig()
    {
        $this->createFileFromTemplate(
            'config/doctrine.mysql.config',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.development.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
        $this->createFileFromTemplate(
            'config/doctrine.mysql.config',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.production.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
        $this->createFileFromTemplate(
            'config/doctrine.sqlite.config',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.testing.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );

        $this->createFileFromTemplate(
            'config/doctrine.mysql.config',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.staging.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function getAssetConfig()
    {
        $this->createFileFromTemplate(
            'config/asset.config',
            array(),
            'asset.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function getServiceManagerConfig($controllers)
    {
        $this->createFileFromTemplate(
            'config/servicemanager.config',
            array(
                'module' => $this->getConfig()->getModule(),
                'controllers' => $controllers
            ),
            'servicemanager.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function getTranslatorConfig()
    {
        $this->createFileFromTemplate(
            'config/translator.config',
            array(),
            'translator.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }

    public function getViewConfig()
    {
        $this->createFileFromTemplate(
            'config/view.config',
            array(
                'module' => $this->getConfig()->getModule(),
                'moduleUrl' => $this->str('url', $this->getConfig()->getModule())
            ),
            'view.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
    }
}
