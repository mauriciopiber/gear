<?php
namespace Gear\Table\Metadata;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Metadata\Metadata;
use Gear\Module\Structure\ModuleStructure;

class MetadataFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        //se tem parametro módule
        $module = $serviceLocator->get(ModuleStructure::class);
        $module->prepare();


        $moduleName = $serviceLocator->get('application')->getMvcEvent()->getRequest()->getParam('module');

        //se tem parametro basepath
        if ($serviceLocator->get('application')->getMvcEvent()->getRequest()->getParam('basepath')) {
            $location =
            $serviceLocator->get('application')->getMvcEvent()->getRequest()->getParam('basepath')
            . '/'
            . $serviceLocator->get('GearBase\Util\String')->str('url', $moduleName);


            if (is_dir($location)) {
                $module->setMainFolder($location);
            }
        }


        if (is_file($module->getMainFolder().'/config/autoload/global.php')
            && $module->getMainFolder().'/config/autoload/local.php'
        ) {
            $global = require $module->getMainFolder().'/config/autoload/global.php';
            $local =  require $module->getMainFolder().'/config/autoload/local.php';

            $config = array_merge_recursive($global, $local);

            $params = $config['doctrine'***REMOVED***['connection'***REMOVED***['orm_default'***REMOVED***['params'***REMOVED***;

            $params['driver'***REMOVED*** = 'pdo_mysql';

            $params['username'***REMOVED*** = $params['user'***REMOVED***;

            $adapter = new \Zend\Db\Adapter\Adapter($params);
        } else {
            $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        }

        $metadata = new Metadata($adapter);

        return $metadata;
    }
}
