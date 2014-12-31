<?php
return array(
    'factories' => array(
        'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
    ),
    'aliases' => array(
        'translator' => 'MvcTranslator'
    ),
    'invokables' => array(
        'TestUntil\Entity\PaisEntity' =>
            'TestUntil\Entity\Pais',
        'TestUntil\Repository\PaisRepository' =>
            'TestUntil\Repository\PaisRepository',
        'TestUntil\Service\PaisService' =>
            'TestUntil\Service\PaisService',
        'TestUntil\Form\PaisForm' =>
            'TestUntil\Form\PaisForm',
        'TestUntil\Filter\PaisFilter' =>
            'TestUntil\Filter\PaisFilter',
        'TestUntil\SearchForm\PaisSearchForm' =>
            'TestUntil\SearchForm\PaisSearchForm',
    ),
    'factories' => array(
        'TestUntil\Factory\PaisFactory' =>
            'TestUntil\Factory\PaisFactory',
        'TestUntil\Form\Search\PaisSearchForm' =>
            'TestUntil\Factory\PaisSearchFactory',
    ),
);
