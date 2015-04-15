<?php
return array(
    'default' => array(
        array(
            'label' => 'Teste',
            'route' => 'teste',
            'pages' => array(
                
                array(
                    'label' => 'Email',
                    'route' => 'teste/email',
                    'pages' => array(
                        
                            array(
                                'label' => 'Create',
                                'route' => 'teste/email/create'
                            ),
                        
                            array(
                                'label' => 'Edit',
                                'route' => 'teste/email/edit'
                            ),
                        
                            array(
                                'label' => 'List',
                                'route' => 'teste/email/list'
                            ),
                        
                            array(
                                'label' => 'Delete',
                                'route' => 'teste/email/delete'
                            ),
                        
                            array(
                                'label' => 'View',
                                'route' => 'teste/email/view'
                            ),
                        
                    ),
                ),
                
            ),
        ),
    ),
);
