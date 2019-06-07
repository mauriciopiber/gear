<?php
namespace Gear\Mvc\Entity\EntityObjectFixer;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Mvc/Entity/EntityObjectFixer
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class EntityObjectFixerFactory implements FactoryInterface
{
    /**
     * Create EntityObjectFixer
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     * @return \Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new EntityObjectFixer(
            $container->get('Gear\Util\String\StringService')
        );
        
        return $factory;
    }
}
