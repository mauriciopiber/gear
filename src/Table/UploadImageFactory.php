<?php
namespace Gear\Table;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Table\UploadImage;
use Gear\Module\Structure\ModuleStructure;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Table
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class UploadImageFactory implements FactoryInterface
{
    /**
     * Create UploadImage
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return UploadImage
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new UploadImage(
            $container->get('Gear\Util\String\StringService'),
            $container->get(ModuleStructure::class)
        );
        
        return $factory;
    }
}
