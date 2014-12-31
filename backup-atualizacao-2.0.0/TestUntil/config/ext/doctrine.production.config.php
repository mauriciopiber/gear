<?php
namespace TestUntil;

return array(
    'connection' => array(
        'orm_default' => array(
            'configuration' => 'orm_default',
            'eventmanager' => 'orm_default',
            'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
            'params' => array(
                'host' => 'localhost',
                'port' => '3306',
                'dbname' => '',
                'charset' => 'utf8'
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
