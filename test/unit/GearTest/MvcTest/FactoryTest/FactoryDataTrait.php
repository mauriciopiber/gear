<?php
namespace GearTest\MvcTest\FactoryTest;

trait FactoryDataTrait
{
    public function getFactoryData()
    {
        $dependencyMap = [
            'filter' => [
                'basic' => [
                    '\Zend\Db\Adapter\Adapter',
                    'translate' => '\Zend\Mvc\I18n\Translator'
                ***REMOVED***,
                'namespace' => [
                    '\Zend\Db\Adapter\Adapter',
                    'translate' => '\Zend\Mvc\I18n\Translator'
                ***REMOVED***
            ***REMOVED***,
            'service' => [
                'basic' => [
                    'memcached' => '\Zend\Cache\Storage\Adapter\Memcached',
                    'Repository\MyTableRepository',
                    '\GearImage\Service\ImageService'
                ***REMOVED***,
                'namespace' => [
                    'memcached' => '\Zend\Cache\Storage\Adapter\Memcached',
                    'Custom\CustomNamespace\MyTableRepository',
                    '\GearImage\Service\ImageService'
                ***REMOVED***
            ***REMOVED***,

            'repository' => [
                'basic' => [
                    'doctrine.entitymanager.orm_default' => '\Doctrine\ORM\EntityManager',
                    '\GearBase\Repository\QueryBuilder'
                ***REMOVED***,
                'namespace' => [
                    'doctrine.entitymanager.orm_default' => '\Doctrine\ORM\EntityManager',
                    '\GearBase\Repository\QueryBuilder'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***;

        $types = [
            ['type' => 'Repository'***REMOVED***,
            ['type' => 'Service'***REMOVED***,
            ['type' => 'Filter'***REMOVED***,
            ['type' => 'Form', 'template' => 'form-filter'***REMOVED***,
            ['type' => 'SearchForm', 'template' => 'search-form'***REMOVED***
        ***REMOVED***;

        foreach ($types as $type) {

            $lowerType = strtolower($type['type'***REMOVED***);

            $factoryData[***REMOVED*** = [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('MyTable%s', $type['type'***REMOVED***),
                        'type' => $type['type'***REMOVED***,
                        'service' => 'factories',
                        'namespace' => null,
                        'db' => 'MyTable',
                        'dependency' => (isset($dependencyMap[$lowerType***REMOVED***)) ? $dependencyMap[$lowerType***REMOVED***['basic'***REMOVED*** : null,
                        'template' => (isset($type['template'***REMOVED***)) ? $type['template'***REMOVED*** : null
                  ***REMOVED***
                ),
                sprintf('%s/my-table', strtolower($type['type'***REMOVED***))
            ***REMOVED***;



            $factoryData[***REMOVED*** = [
                new \GearJson\Src\Src(
                    [
                        'name' => sprintf('MyTable%s', $type['type'***REMOVED***),
                        'type' => $type['type'***REMOVED***,
                        'service' => 'factories',
                        'namespace' => 'Custom\CustomNamespace',
                        'db' => 'MyTable',
                        'dependency' => (isset($dependencyMap[$lowerType***REMOVED***)) ? $dependencyMap[$lowerType***REMOVED***['namespace'***REMOVED*** : null,
                        'template' => (isset($type['template'***REMOVED***)) ? $type['template'***REMOVED*** : null
                  ***REMOVED***
                ),
                sprintf('%s/my-table-namespace', strtolower($type['type'***REMOVED***))
            ***REMOVED***;

        }

        $factoryData[***REMOVED*** = [
            new \GearJson\Controller\Controller([
                'name' => 'MyTableController',
                'service' => 'factories',
                'db' => 'MyTable',
                'dependency' => [
                    'Service\MyTableService',
                    'Form\MyTableForm',
                    'Form\Search\MyTableSearchForm'
                ***REMOVED***
            ***REMOVED***),
            'controller/my-table'
        ***REMOVED***;

        $factoryData[***REMOVED*** = [
            new \GearJson\Controller\Controller([
                'name' => 'MyTableNamespaceController',
                'service' => 'factories',
                'db' => 'MyTable',
                'namespace' => 'Custom\CustomNamespace',
                'dependency' => [
                    'Custom\CustomNamespace\MyTableService',
                    'Custom\CustomNamespace\MyTableForm',
                    'Custom\CustomNamespace\MyTableSearchForm'
                ***REMOVED***
            ***REMOVED***),
            'controller/my-table-namespace'
        ***REMOVED***;

        return $factoryData;

    }
}