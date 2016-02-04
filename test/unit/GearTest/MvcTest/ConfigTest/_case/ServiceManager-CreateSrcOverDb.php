<?php
return array (
  'factories' =>
  array (
    'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
    'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
    'GearTest\Factory\ContatoFactory' => 'GearTest\Factory\ContatoFactory',
    'GearTest\Form\Search\ContatoSearchForm' => 'GearTest\Factory\ContatoSearchFactory',
    'GearTest\Factory\MensagemFactory' => 'GearTest\Factory\MensagemFactory',
    'GearTest\Form\Search\MensagemSearchForm' => 'GearTest\Factory\MensagemSearchFactory',
  ),
  'aliases' =>
  array (
    'translator' => 'MvcTranslator',
  ),
  'invokables' =>
  array (
    'GearTest\Entity\Contato' => 'GearTest\Entity\Contato',
    'GearTest\Repository\ContatoRepository' => 'GearTest\Repository\ContatoRepository',
    'GearTest\Service\ContatoService' => 'GearTest\Service\ContatoService',
    'GearTest\Form\ContatoForm' => 'GearTest\Form\ContatoForm',
    'GearTest\Filter\ContatoFilter' => 'GearTest\Filter\ContatoFilter',
    'GearTest\Fixture\ContatoFixture' => 'GearTest\Fixture\ContatoFixture',
    'GearTest\SearchForm\ContatoSearchForm' => 'GearTest\SearchForm\ContatoSearchForm',
    'GearTest\Entity\Mensagem' => 'GearTest\Entity\Mensagem',
    'GearTest\Repository\MensagemRepository' => 'GearTest\Repository\MensagemRepository',
    'GearTest\Service\MensagemService' => 'GearTest\Service\MensagemService',
    'GearTest\Form\MensagemForm' => 'GearTest\Form\MensagemForm',
    'GearTest\Filter\MensagemFilter' => 'GearTest\Filter\MensagemFilter',
    'GearTest\Fixture\MensagemFixture' => 'GearTest\Fixture\MensagemFixture',
    'GearTest\SearchForm\MensagemSearchForm' => 'GearTest\SearchForm\MensagemSearchForm',
  ),
);
