<?php
return array(
    'db' => array(
        'username'       => 'root',
        'password'       => 'gear',
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
               'params' => array(
                    'user'     => 'root',
                    'password' => 'gear',
               ),
            )
        )
    ),
    'phinx' => array(
        'user'     => 'root',
        'pass' => 'gear',
    ),
    'webhost' => 'gear.dev',
    'environment' => 'development'
);
