<?php
return array(
    'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack',
    'routes' => array(
        'test-until' => array(
            'type' => 'literal',
            'options' => array(
                'route' => '/test-until',
                'defaults' => array(
                    'controller' => 'TestUntil\Controller\Index',
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
                                'controller' => 'TestUntil\Controller\Index',
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
                                        'controller' => 'TestUntil\Controller\Index',
                                        'action' => 'index'
                                    ),
                                                                )

                            ),
                            
                        ),
                    ),
                
                    'pais' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/{pais}[/***REMOVED***',
                            'defaults' => array(
                                'controller' => 'TestUntil\Controller\Pais',
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
                                        'controller' => 'TestUntil\Controller\Pais',
                                        'action' => 'create'
                                    ),
                                                                )

                            ),
                            
                             'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '{edit}[/:id***REMOVED***[/:success***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'TestUntil\Controller\Pais',
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
                                        'controller' => 'TestUntil\Controller\Pais',
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
                                        'controller' => 'TestUntil\Controller\Pais',
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
                                        'controller' => 'TestUntil\Controller\Pais',
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
