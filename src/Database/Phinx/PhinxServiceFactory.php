<?php
namespace Gear\Database\Phinx;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Database\Phinx\PhinxService;
use Gear\Creator\FileCreator\FileCreator;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Database/Phinx
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class PhinxServiceFactory implements FactoryInterface
{
    /**
     * Create PhinxService
     *
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Database\Phinx\PhinxService
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new PhinxService(
            $container->get('Gear\Util\String\StringService'),
            $container->get(FileCreator::class)
        );

        return $factory;
    }
}
