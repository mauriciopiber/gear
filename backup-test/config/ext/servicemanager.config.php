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
        'Teste\Entity\Email' =>
            'Teste\Entity\Email',
        'Teste\Repository\EmailRepository' =>
            'Teste\Repository\EmailRepository',
        'Teste\Service\EmailService' =>
            'Teste\Service\EmailService',
        'Teste\Form\EmailForm' =>
            'Teste\Form\EmailForm',
        'Teste\Filter\EmailFilter' =>
            'Teste\Filter\EmailFilter',
        'Teste\Fixture\EmailFixture' =>
            'Teste\Fixture\EmailFixture',
        'Teste\SearchForm\EmailSearchForm' =>
            'Teste\SearchForm\EmailSearchForm',
        'Teste\Entity\User' =>
            'Teste\Entity\User',
        'Teste\Entity\Role' =>
            'Teste\Entity\Role',
        'Teste\Fixture\Role' =>
            'Teste\Fixture\Role',
        'Teste\Fixture\User' =>
            'Teste\Fixture\User',
    ),
    'factories' => array(
        'Teste\Factory\EmailFactory' =>
            'Teste\Factory\EmailFactory',
        'Teste\Form\Search\EmailSearchForm' =>
            'Teste\Factory\EmailSearchFactory',
    ),
);
