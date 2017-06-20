<?php
namespace Gear\Constructor\Action;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Constructor\Action\ActionService;
use Gear\Mvc\Spec\Feature\Feature;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Constructor/Action
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class ActionServiceFactory implements FactoryInterface
{
    /**
     * Create ActionService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return ActionService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new ActionService(
            $serviceLocator->get(Feature::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
