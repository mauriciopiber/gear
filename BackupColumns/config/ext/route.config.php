<?php
return array(
    'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack',
    'routes' => array(
        'column' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/column',
                'defaults' => array(
                    'controller' => 'Column\Controller\Index',
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
                            'controller' => 'Column\Controller\Index',
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
                                    'controller' => 'Column\Controller\Index',
                                    'action' => 'index'
                                ),
                            )
                        ),
                    ),
                ),
                'columns' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{columns}[/***REMOVED***',
                        'defaults' => array(
                            'controller' => 'Column\Controller\Columns',
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
                                    'controller' => 'Column\Controller\Columns',
                                    'action' => 'create'
                                ),
                            )
                        ),
                        'edit' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'Column\Controller\Columns',
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
                                    'controller' => 'Column\Controller\Columns',
                                    'action' => 'list'
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
                                    'controller' => 'Column\Controller\Columns',
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
                                'route' => '{view}[/:id***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'Column\Controller\Columns',
                                    'action' => 'view'
                                ),
                            )
                        ),
                    ),
                ),
                'foreign-keys' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/{foreign-keys}[/***REMOVED***',
                        'defaults' => array(
                            'controller' => 'Column\Controller\ForeignKeys',
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
                                    'controller' => 'Column\Controller\ForeignKeys',
                                    'action' => 'create'
                                ),
                            )
                        ),
                        'edit' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'Column\Controller\ForeignKeys',
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
                                    'controller' => 'Column\Controller\ForeignKeys',
                                    'action' => 'list'
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
                                    'controller' => 'Column\Controller\ForeignKeys',
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
                                'route' => '{view}[/:id***REMOVED***',
                                'defaults' => array(
                                    'controller' => 'Column\Controller\ForeignKeys',
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
