<?php
return array(
    'default' => array(
        array(
            'label' => 'Test Upload',
            'route' => 'test-upload',
            'pages' => array(
                
                array(
                    'label' => 'Test Upload Image',
                    'route' => 'test-upload/test-upload-image',
                    'pages' => array(
                        
                            array(
                                'label' => 'Create',
                                'route' => 'test-upload/test-upload-image/create'
                            ),
                        
                            array(
                                'label' => 'Edit',
                                'route' => 'test-upload/test-upload-image/edit'
                            ),
                        
                            array(
                                'label' => 'List',
                                'route' => 'test-upload/test-upload-image/list'
                            ),
                        
                            array(
                                'label' => 'Delete',
                                'route' => 'test-upload/test-upload-image/delete'
                            ),
                        
                            array(
                                'label' => 'View',
                                'route' => 'test-upload/test-upload-image/view'
                            ),
                        
                    ),
                ),
                
            ),
        ),
    ),
);
