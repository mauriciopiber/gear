<?php
namespace Gear\Metadata;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class TableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $metadata = $serviceLocator->get('Gear\Factory\Metadata');
        $stringService = $serviceLocator->get('GearBase\Util\String');

        $db = $serviceLocator->get('application')->getMvcEvent()->getRequest()->getParam('table');

        $tableObject = $metadata->getTable($stringService->str('uline', $db));
        $table = new \Gear\Table\TableService\Table($tableObject);
        return $table;
    }
}
