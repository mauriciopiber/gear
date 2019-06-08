<?php
namespace Gear\Constructor\Db;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Constructor\Db\DbConstructor;
use Gear\Column\ColumnService;
use Gear\Table\TableService;
use Gear\Schema\Action\ActionSchema;
//use Gear\Schema\Db\DbSchema as DbSchema;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Entity\EntityService;
//use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\View\ViewService;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Schema\Db\DbSchema;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Constructor/Db
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class DbConstructorFactory implements FactoryInterface
{
    /**
     * Create DbConstructor
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return DbConstructor
     */
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        $factory = new DbConstructor(
            $container->get(ColumnService::class),
            $container->get(TableService::class),
            $container->get(ActionSchema::class),
            $container->get(DbSchema::class),
            $container->get(Feature::class),
            $container->get(Step::class),
            $container->get(EntityService::class),
            //$container->get(SearchService::class),
            $container->get(FixtureService::class),
            $container->get(FilterService::class),
            $container->get(FormService::class),
            $container->get(WebControllerService::class),
            //$container->get(ControllerTestService::class),
            $container->get(ConfigService::class),
            $container->get(LanguageService::class),
            $container->get(ViewService::class),
            $container->get(RepositoryService::class),
            $container->get(ServiceService::class),
            $container->get(ModuleStructure::class)
        );

        return $factory;
    }
}
