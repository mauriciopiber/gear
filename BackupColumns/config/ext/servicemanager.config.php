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
        'Column\SearchForm\ForeignKeysSearchForm' =>
            'Column\SearchForm\ForeignKeysSearchForm',
        'Column\Fixture\ForeignKeysFixture' =>
            'Column\Fixture\ForeignKeysFixture',
        'Column\Filter\ForeignKeysFilter' =>
            'Column\Filter\ForeignKeysFilter',
        'Column\Form\ForeignKeysForm' =>
            'Column\Form\ForeignKeysForm',
        'Column\Service\ForeignKeysService' =>
            'Column\Service\ForeignKeysService',
        'Column\Repository\ForeignKeysRepository' =>
            'Column\Repository\ForeignKeysRepository',
        'Column\Entity\ForeignKeys' =>
            'Column\Entity\ForeignKeys',
        'Column\SearchForm\ColumnsSearchForm' =>
            'Column\SearchForm\ColumnsSearchForm',
        'Column\Fixture\ColumnsFixture' =>
            'Column\Fixture\ColumnsFixture',
        'Column\Filter\ColumnsFilter' =>
            'Column\Filter\ColumnsFilter',
        'Column\Form\ColumnsForm' =>
            'Column\Form\ColumnsForm',
        'Column\Service\ColumnsService' =>
            'Column\Service\ColumnsService',
        'Column\Repository\ColumnsRepository' =>
            'Column\Repository\ColumnsRepository',
        'Column\Entity\Columns' =>
            'Column\Entity\Columns',
    ),
    'factories' => array(
        'Column\Form\Search\ForeignKeysSearchForm' =>
            'Column\Factory\ForeignKeysSearchFactory',
        'Column\Factory\ForeignKeysFactory' =>
            'Column\Factory\ForeignKeysFactory',
        'Column\Form\Search\ColumnsSearchForm' =>
            'Column\Factory\ColumnsSearchFactory',
        'Column\Factory\ColumnsFactory' =>
            'Column\Factory\ColumnsFactory',
    ),
);
