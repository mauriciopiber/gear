<?php
return array(
    'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack',
    'routes' => array(
        'piber-network' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/piber-network',
                'defaults' => array(
                    'controller' => 'PiberNetwork\Controller\Index',
                    'action' => 'index'
                )
            ),
            'may_terminate' => true,
            'child_routes' => array(

                    'index' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/{index}[/***REMOVED***',
                            'defaults' => array(
                                'controller' => 'PiberNetwork\Controller\Index',
                                'action' => 'list'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(

                             'index' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{index}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\Index',
                                        'action' => 'index'
                                    ),
                                                                )

                            ),

                        ),
                    ),
                'tipo-custo' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{tipo-custo}[/***REMOVED***',
                        'defaults' => array(
                            'controller' => 'PiberNetwork\Controller\TipoCusto',
                            'action' => 'list'
                        )
                    ),
                    'may_terminate' => true,
                    'child_routes' => array(

                        'create' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{create}',
                                'defaults' => array(
                                    'controller' => 'PiberNetwork\Controller\TipoCusto',
                                    'action' => 'create'
                                ),
                            )

                        ),

                        'edit' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'PiberNetwork\Controller\TipoCusto',
                                    'action' => 'edit'
                                ),


                                'constraints' => array(
                                    'id'     => '[0-9***REMOVED****',
                                ),


                            )

                        ),

                        'list' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{list}[/page/***REMOVED***[:page***REMOVED***[/orderBy***REMOVED***[/:orderBy***REMOVED***[/:order***REMOVED***[/:success***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'PiberNetwork\Controller\TipoCusto',
                                    'action' => 'list',
                                    'page' => 1
                                ),
                                'constraints' => array(
                                    'action' => '(?!\bpage\b)(?!\borderBy\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                    'page' => '[0-9***REMOVED***+',
                                    'orderBy' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                    'order' => 'ASC|DESC',
                                ),
                            )
                        ),
                        'delete' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{delete}[/:id***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'PiberNetwork\Controller\TipoCusto',
                                    'action' => 'delete'
                                ),
                                'constraints' => array(
                                    'id'     => '[0-9***REMOVED****',
                                ),

                            )

                        ),

                        'view' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{view}',
                                'defaults' => array(
                                    'controller' => 'PiberNetwork\Controller\TipoCusto',
                                    'action' => 'view'
                                ),
                            )

                        ),

                    ),
                ),

                    'tipo-servico' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/{tipo-servico}[/***REMOVED***',
                            'defaults' => array(
                                'controller' => 'PiberNetwork\Controller\TipoServico',
                                'action' => 'list'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(

                             'create' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{create}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\TipoServico',
                                        'action' => 'create'
                                    ),
                                                                )

                            ),

                             'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\TipoServico',
                                        'action' => 'edit'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'list' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{list}[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\TipoServico',
                                        'action' => 'list'
                                    ),


                                    'constraints' => array(
                                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'page' => '[0-9***REMOVED***+',
                                        'order_by' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'order' => 'asc|desc',
                                    ),


                                )

                            ),

                             'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{delete}[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\TipoServico',
                                        'action' => 'delete'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'view' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{view}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\TipoServico',
                                        'action' => 'view'
                                    ),
                                                                )

                            ),

                        ),
                    ),

                    'preco-tipo-servico' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/{preco-tipo-servico}[/***REMOVED***',
                            'defaults' => array(
                                'controller' => 'PiberNetwork\Controller\PrecoTipoServico',
                                'action' => 'list'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(

                             'create' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{create}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\PrecoTipoServico',
                                        'action' => 'create'
                                    ),
                                                                )

                            ),

                             'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\PrecoTipoServico',
                                        'action' => 'edit'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'list' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{list}[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\PrecoTipoServico',
                                        'action' => 'list'
                                    ),


                                    'constraints' => array(
                                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'page' => '[0-9***REMOVED***+',
                                        'order_by' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'order' => 'asc|desc',
                                    ),


                                )

                            ),

                             'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{delete}[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\PrecoTipoServico',
                                        'action' => 'delete'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'view' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{view}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\PrecoTipoServico',
                                        'action' => 'view'
                                    ),
                                                                )

                            ),

                        ),
                    ),

                    'grupo-custo' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/{grupo-custo}[/***REMOVED***',
                            'defaults' => array(
                                'controller' => 'PiberNetwork\Controller\GrupoCusto',
                                'action' => 'list'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(

                             'create' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{create}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\GrupoCusto',
                                        'action' => 'create'
                                    ),
                                                                )

                            ),

                             'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\GrupoCusto',
                                        'action' => 'edit'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'list' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{list}[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\GrupoCusto',
                                        'action' => 'list'
                                    ),


                                    'constraints' => array(
                                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'page' => '[0-9***REMOVED***+',
                                        'order_by' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'order' => 'asc|desc',
                                    ),


                                )

                            ),

                             'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{delete}[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\GrupoCusto',
                                        'action' => 'delete'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'view' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{view}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\GrupoCusto',
                                        'action' => 'view'
                                    ),
                                                                )

                            ),

                        ),
                    ),



                    'status-custo' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/{status-custo}[/***REMOVED***',
                            'defaults' => array(
                                'controller' => 'PiberNetwork\Controller\StatusCusto',
                                'action' => 'list'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(

                             'create' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{create}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\StatusCusto',
                                        'action' => 'create'
                                    ),
                                                                )

                            ),

                             'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\StatusCusto',
                                        'action' => 'edit'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'list' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{list}[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\StatusCusto',
                                        'action' => 'list'
                                    ),


                                    'constraints' => array(
                                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'page' => '[0-9***REMOVED***+',
                                        'order_by' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                        'order' => 'asc|desc',
                                    ),


                                )

                            ),

                             'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{delete}[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\StatusCusto',
                                        'action' => 'delete'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'view' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{view}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\StatusCusto',
                                        'action' => 'view'
                                    ),
                                                                )

                            ),

                        ),
                    ),

                    'custo' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/{custo}[/***REMOVED***',
                            'defaults' => array(
                                'controller' => 'PiberNetwork\Controller\Custo',
                                'action' => 'list'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(

                             'create' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{create}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\Custo',
                                        'action' => 'create'
                                    ),
                                                                )

                            ),

                             'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\Custo',
                                        'action' => 'edit'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

'list' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{list}[/page/***REMOVED***[:page***REMOVED***[/orderBy***REMOVED***[/:orderBy***REMOVED***[/:order***REMOVED***[/:success***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'PiberNetwork\Controller\Custo',
                                    'action' => 'list',
                                    'page' => 1
                                ),
                                'constraints' => array(
                                    'action' => '(?!\bpage\b)(?!\borderBy\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                    'page' => '[0-9***REMOVED***+',
                                    'orderBy' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',
                                    'order' => 'ASC|DESC',
                                ),
                            )
                        ),

                             'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{delete}[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\Custo',
                                        'action' => 'delete'
                                    ),


                                    'constraints' => array(
                                        'id'     => '[0-9***REMOVED****',
                                    ),


                                )

                            ),

                             'view' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{view}',
                                    'defaults' => array(
                                        'controller' => 'PiberNetwork\Controller\Custo',
                                        'action' => 'view'
                                    ),
                                                                )

                            ),

                        ),
                    ),

            ),
        )
    )
);
