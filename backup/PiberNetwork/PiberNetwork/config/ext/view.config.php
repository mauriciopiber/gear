<?php
namespace PiberNetwork;

return array(
    'display_not_found_reason' => true,
    'display_exceptions' => true,
    'doctype' => 'HTML5',
    'not_found_template' => 'error/404',
    'exception_template' => 'error/index',
    'template_map' => array(
        'layout/piber-network' => __DIR__ . '/../../view/layout/layout.phtml',
        'layout/breadcrumb' => __DIR__ . '/../../view/layout/breadcrumb.phtml',
        'layout/success' => __DIR__ . '/../../view/layout/success.phtml',
        'error/404' => __DIR__ . '/../../view/error/404.phtml',
        'error/index' => __DIR__ . '/../../view/error/index.phtml'
    ),
    'template_path_stack' => array(
        'piber-network' => __DIR__ . '/../../view'
    )
);
