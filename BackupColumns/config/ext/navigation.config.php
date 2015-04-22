<?php
return array(
    'default' => array(
        array(
            'label' => 'Column',
            'route' => 'column',
            'pages' => array(
                
                array(
                    'label' => 'Columns',
                    'route' => 'column/columns',
                    'pages' => array(
                        
                            array(
                                'label' => 'Create',
                                'route' => 'column/columns/create'
                            ),
                        
                            array(
                                'label' => 'Edit',
                                'route' => 'column/columns/edit'
                            ),
                        
                            array(
                                'label' => 'List',
                                'route' => 'column/columns/list'
                            ),
                        
                            array(
                                'label' => 'Delete',
                                'route' => 'column/columns/delete'
                            ),
                        
                            array(
                                'label' => 'View',
                                'route' => 'column/columns/view'
                            ),
                        
                    ),
                ),
                
                array(
                    'label' => 'Foreign Keys',
                    'route' => 'column/foreign-keys',
                    'pages' => array(
                        
                            array(
                                'label' => 'Create',
                                'route' => 'column/foreign-keys/create'
                            ),
                        
                            array(
                                'label' => 'Edit',
                                'route' => 'column/foreign-keys/edit'
                            ),
                        
                            array(
                                'label' => 'List',
                                'route' => 'column/foreign-keys/list'
                            ),
                        
                            array(
                                'label' => 'Delete',
                                'route' => 'column/foreign-keys/delete'
                            ),
                        
                            array(
                                'label' => 'View',
                                'route' => 'column/foreign-keys/view'
                            ),
                        
                    ),
                ),
                
            ),
        ),
    ),
);
