<?php
namespace Gear\Constructor\Db;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Gear\Constructor\Db\DbService;
use Gear\Column\ColumnService;
use Gear\Table\TableService;
use GearJson\Action\ActionService;
//use GearJson\Db\DbService as DbSchema;
use Gear\Mvc\Spec\Feature\Feature;
use Gear\Mvc\Spec\Step\Step;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Search\SearchService;
use Gear\Mvc\Fixture\FixtureService;
use Gear\Mvc\Filter\FilterService;
use Gear\Mvc\Form\FormService;
use Gear\Mvc\Controller\Web\WebControllerService;
use Gear\Mvc\Controller\Web\WebControllerTestService;
use Gear\Mvc\Config\ConfigService;
use Gear\Mvc\LanguageService;
use Gear\Mvc\ViewViewService;
use Gear\Mvc\Repository\RepositoryService;
use Gear\Mvc\Service\ServiceService;
use Gear\Module\BasicModuleStructure;

/**
 * PHP Version 5
 *
 * @category Factory
 * @package Gear/Constructor/Db
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
class DbServiceFactory implements FactoryInterface
{
    /**
     * Create DbService
     *
     * @param ServiceLocatorInterface $serviceLocator ServiceManager instance
     *
     * @return DbService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new DbService(
            $serviceLocator->get(ColumnService::class),
            $serviceLocator->get(TableService::class),
            $serviceLocator->get('GearJson\Action'),
            $serviceLocator->get('GearJson\Db'),
            $serviceLocator->get(Feature::class),
            $serviceLocator->get(Step::class),
            $serviceLocator->get(EntityService::class),
            $serviceLocator->get(SearchService::class),
            $serviceLocator->get(FixtureService::class),
            $serviceLocator->get(FilterService::class),
            $serviceLocator->get(FormService::class),
            $serviceLocator->get(ControllerService::class),
            //$serviceLocator->get(ControllerTestService::class),
            $serviceLocator->get(ConfigService::class),
            $serviceLocator->get(LanguageService::class),
            $serviceLocator->get(ViewViewService::class),
            $serviceLocator->get(RepositoryService::class),
            $serviceLocator->get(ServiceService::class),
            $serviceLocator->get(BasicModuleStructure::class)
        );
        unset($serviceLocator);
        return $factory;
    }
}
