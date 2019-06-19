<?php
namespace Gear\Integration\Component\MigrationFile;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Component\MigrationFile\MigrationFile
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new MigrationFile(
            $container->get('Gear\Integration\Util\Persist\Persist'),
            $container->get('Gear\Util\String\StringService'),
            $container->get('Gear\Util\Vector\ArrayService')
        );

        return $factory;
    }
}
