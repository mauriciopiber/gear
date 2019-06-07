<?php
namespace Gear\Creator\Template;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
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
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new TemplateService(
            $container->get('ViewHelperManager')->getRenderer()
        );

        return $factory;
    }
}
