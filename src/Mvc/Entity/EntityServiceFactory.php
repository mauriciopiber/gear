<?php
namespace Gear\Mvc\Entity;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Gear\Mvc\Entity\EntityService;
use Gear\Mvc\Entity\DoctrineService;
use Gear\Module\Structure\ModuleStructure;
use Gear\Schema\Src\SrcSchema;
use Gear\Schema\Schema\SchemaService;

class EntityServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName = null, $options = [***REMOVED***)
    {
        return new EntityService(
            $container->get(ModuleStructure::class),
            $container->get(DoctrineService::class),
            $container->get('scriptService'),
            $container->get('Gear\Mvc\Entity\EntityTestService'),
            $container->get('Gear\Table\TableService'),
            $container->get(SrcSchema::class),
            $container->get('Gear\Mvc\Config\ServiceManager'),
            $container->get(SchemaService::class),
            $container->get('Gear\Util\Dir\DirService'),
            $container->get('Gear\Util\Glob\GlobService'),
            $container->get('Gear\Mvc\Entity\EntityObjectFixer\EntityObjectFixer'),
            $container->get('Gear\Util\String\StringService')
        );
    }
}
