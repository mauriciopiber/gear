<?php
namespace Gear\Table;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new UploadImage(
            $serviceLocator->get('Gear\Util\String\StringService'),
            $serviceLocator->get(ModuleStructure::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
