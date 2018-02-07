<?php
namespace Gear\Creator\Template;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Creator\Template\TemplateService;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Creator/Template
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class TemplateServiceFactory implements FactoryInterface
{
    /**
     * Create TemplateService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return TemplateService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new TemplateService(
            $serviceLocator->get('viewmanager')->getRenderer()
        );
        unset($serviceLocator);
        return $factory;
    }
}
