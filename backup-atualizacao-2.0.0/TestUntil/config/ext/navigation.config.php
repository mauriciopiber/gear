<?php
return array(
    'default' => array(
        array(
            'label' => 'Test Until',
            'route' => 'test-until',
            'pages' => array(
                
                array(
                    'label' => 'Pais',
                    'route' => 'test-until/pais',
                    'pages' => array(
                        
                            array(
                                'label' => 'Create',
                                'route' => 'test-until/pais/create'
                            ),
                        
                            array(
                                'label' => 'Edit',
                                'route' => 'test-until/pais/edit'
                            ),
                        
                            array(
                                'label' => 'List',
                                'route' => 'test-until/pais/list'
                            ),
                        
                            array(
                                'label' => 'Delete',
                                'route' => 'test-until/pais/delete'
                            ),
                        
                            array(
                                'label' => 'View',
                                'route' => 'test-until/pais/view'
                            ),
                        
                    ),
                ),
                
            ),
        ),
    ),
);
