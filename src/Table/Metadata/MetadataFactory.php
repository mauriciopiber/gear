<?php
namespace Gear\Table\Metadata;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Db\Metadata\Metadata;
use Gear\Module\Structure\ModuleStructure;

class MetadataFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {

        //se tem parametro módule
        $module = $container->get(ModuleStructure::class);
        $module->prepare();


        $moduleName = $container->get('application')->getMvcEvent()->getRequest()->getParam('module');

        //se tem parametro basepath
        if ($container->get('application')->getMvcEvent()->getRequest()->getParam('basepath')) {
            $location =
            $container->get('application')->getMvcEvent()->getRequest()->getParam('basepath')
            . '/'
            . $container->get('Gear\Util\String\StringService')->str('url', $moduleName);


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
            $adapter = $container->get('Zend\Db\Adapter\Adapter');
        }

        $metadata = new Metadata($adapter);

        return $metadata;
    }
}
