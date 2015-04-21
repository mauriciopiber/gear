<?php
namespace TestUpload;

return array(
    'connection' => array(
        'orm_default' => array(
            'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
            'params' => array(
                'path' => __DIR__.'/../../data/',
            )
        )
    ),
    'driver' => array(
        'orm_default' => array(
            'drivers' => array(
                __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
            )
        ),
        __NAMESPACE__ . '_driver' => array(
            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
            'paths' => array(
                __DIR__ . '/../../src/' . __NAMESPACE__ . '/Entity'
            )
        )
    )
);
