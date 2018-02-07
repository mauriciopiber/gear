<?php
namespace Gear\Mvc\Entity\EntityObjectFixer;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
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
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new EntityObjectFixer(
            $serviceLocator->get('GearBase\Util\String')
        );
        unset($serviceLocator);
        return $factory;
    }
}
