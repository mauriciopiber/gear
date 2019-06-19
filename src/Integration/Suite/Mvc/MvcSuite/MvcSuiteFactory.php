<?php
namespace Gear\Integration\Suite\Mvc\MvcSuite;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Integration/Suite/Mvc/MvcSuite
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class MvcSuiteFactory implements FactoryInterface
{
    /**
     * Create MvcSuite
     *
     * @param ServiceLocatorInterface $container ServiceManager instance
     * @return \Gear\Integration\Suite\Mvc\MvcSuite\MvcSuite
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new MvcSuite(
            $container->get('Gear\Integration\Suite\Mvc\MvcGenerator\MvcGenerator'),
            $container->get('Gear\Integration\Component\SuperTestFile\SuperTestFile')
        );

        return $factory;
    }
}
