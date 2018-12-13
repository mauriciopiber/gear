<?php
namespace Gear\Integration\Component\MigrationFile;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Integration\Component\MigrationFile\MigrationFile;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Component/MigrationFile
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MigrationFileFactory implements FactoryInterface
{
    /**
     * Create MigrationFile
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Integration\Component\MigrationFile\MigrationFile
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new MigrationFile(
            $serviceLocator->get('Gear\Integration\Util\Persist\Persist'),
            $serviceLocator->get('Gear\Util\String\StringService'),
            $serviceLocator->get('Gear\Util\Vector\ArrayService')
        );
        unset($serviceLocator);
        return $factory;
    }
}
