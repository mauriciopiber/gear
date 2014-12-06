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
        'PiberNetwork\Entity\TipoServicoEntity' =>
            'PiberNetwork\Entity\TipoServico',
        'PiberNetwork\Repository\TipoServicoRepository' =>
            'PiberNetwork\Repository\TipoServicoRepository',
        'PiberNetwork\Service\TipoServicoService' =>
            'PiberNetwork\Service\TipoServicoService',
        'PiberNetwork\Form\TipoServicoForm' =>
            'PiberNetwork\Form\TipoServicoForm',
        'PiberNetwork\Filter\TipoServicoFilter' =>
            'PiberNetwork\Filter\TipoServicoFilter',
        'PiberNetwork\Entity\PrecoTipoServicoEntity' =>
            'PiberNetwork\Entity\PrecoTipoServico',
        'PiberNetwork\Repository\PrecoTipoServicoRepository' =>
            'PiberNetwork\Repository\PrecoTipoServicoRepository',
        'PiberNetwork\Service\PrecoTipoServicoService' =>
            'PiberNetwork\Service\PrecoTipoServicoService',
        'PiberNetwork\Form\PrecoTipoServicoForm' =>
            'PiberNetwork\Form\PrecoTipoServicoForm',
        'PiberNetwork\Filter\PrecoTipoServicoFilter' =>
            'PiberNetwork\Filter\PrecoTipoServicoFilter',
        'PiberNetwork\Entity\GrupoCustoEntity' =>
            'PiberNetwork\Entity\GrupoCusto',
        'PiberNetwork\Repository\GrupoCustoRepository' =>
            'PiberNetwork\Repository\GrupoCustoRepository',
        'PiberNetwork\Service\GrupoCustoService' =>
            'PiberNetwork\Service\GrupoCustoService',
        'PiberNetwork\Form\GrupoCustoForm' =>
            'PiberNetwork\Form\GrupoCustoForm',
        'PiberNetwork\Filter\GrupoCustoFilter' =>
            'PiberNetwork\Filter\GrupoCustoFilter',
        'PiberNetwork\Entity\TipoCustoEntity' =>
            'PiberNetwork\Entity\TipoCusto',
        'PiberNetwork\Repository\TipoCustoRepository' =>
            'PiberNetwork\Repository\TipoCustoRepository',
        'PiberNetwork\Service\TipoCustoService' =>
            'PiberNetwork\Service\TipoCustoService',
        'PiberNetwork\Form\TipoCustoForm' =>
            'PiberNetwork\Form\TipoCustoForm',
        'PiberNetwork\Filter\TipoCustoFilter' =>
            'PiberNetwork\Filter\TipoCustoFilter',
        'PiberNetwork\Entity\StatusCustoEntity' =>
            'PiberNetwork\Entity\StatusCusto',
        'PiberNetwork\Repository\StatusCustoRepository' =>
            'PiberNetwork\Repository\StatusCustoRepository',
        'PiberNetwork\Service\StatusCustoService' =>
            'PiberNetwork\Service\StatusCustoService',
        'PiberNetwork\Form\StatusCustoForm' =>
            'PiberNetwork\Form\StatusCustoForm',
        'PiberNetwork\Filter\StatusCustoFilter' =>
            'PiberNetwork\Filter\StatusCustoFilter',
        'PiberNetwork\Entity\CustoEntity' =>
            'PiberNetwork\Entity\Custo',
        'PiberNetwork\Repository\CustoRepository' =>
            'PiberNetwork\Repository\CustoRepository',
        'PiberNetwork\Service\CustoService' =>
            'PiberNetwork\Service\CustoService',
        'PiberNetwork\Form\CustoForm' =>
            'PiberNetwork\Form\CustoForm',
        'PiberNetwork\Filter\CustoFilter' =>
            'PiberNetwork\Filter\CustoFilter',
    ),
    'factories' => array(
        'PiberNetwork\Factory\TipoCustoSearchFactory' => 'PiberNetwork\Factory\TipoCustoSearchFactory',
        'PiberNetwork\Factory\CustoSearchFactory' => 'PiberNetwork\Factory\CustoSearchFactory',
        'PiberNetwork\Factory\TipoServicoFactory' =>
            'PiberNetwork\Factory\TipoServicoFactory',
        'PiberNetwork\Factory\PrecoTipoServicoFactory' =>
            'PiberNetwork\Factory\PrecoTipoServicoFactory',
        'PiberNetwork\Factory\GrupoCustoFactory' =>
            'PiberNetwork\Factory\GrupoCustoFactory',
        'PiberNetwork\Factory\TipoCustoFactory' =>
            'PiberNetwork\Factory\TipoCustoFactory',
        'PiberNetwork\Factory\StatusCustoFactory' =>
            'PiberNetwork\Factory\StatusCustoFactory',
        'PiberNetwork\Factory\CustoFactory' =>
            'PiberNetwork\Factory\CustoFactory',
    ),
);
