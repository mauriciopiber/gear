<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractService;

class ConfigService extends AbstractService
{
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
        $this->getTranslatorConfig();
        $this->getServiceManagerConfig($controller);
        $this->getAssetConfig();
    }

    public function getModuleConfig($controllers)
    {
        return $this->createFileFromTemplate(
            'config/module.config',
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
            'config/doctrine.config',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.development.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
        $this->createFileFromTemplate(
            'config/doctrine.config',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.production.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );
        $this->createFileFromTemplate(
            'config/doctrine.config',
            array('module' => $this->getConfig()->getModule()),
            'doctrine.testing.config.php',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/config/ext'
        );

        $this->createFileFromTemplate(
            'config/doctrine.config',
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
