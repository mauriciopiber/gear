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
        'Teste\SearchForm\EmailSearchForm' =>
            'Teste\SearchForm\EmailSearchForm',
        'Teste\Fixture\EmailFixture' =>
            'Teste\Fixture\EmailFixture',
        'Teste\Filter\EmailFilter' =>
            'Teste\Filter\EmailFilter',
        'Teste\Form\EmailForm' =>
            'Teste\Form\EmailForm',
        'Teste\Service\EmailService' =>
            'Teste\Service\EmailService',
        'Teste\Repository\EmailRepository' =>
            'Teste\Repository\EmailRepository',
        'Teste\Entity\Email' =>
            'Teste\Entity\Email',
    ),
    'factories' => array(
        'Teste\Form\Search\EmailSearchForm' =>
            'Teste\Factory\EmailSearchFactory',
        'Teste\Factory\EmailFactory' =>
            'Teste\Factory\EmailFactory',
    ),
);
