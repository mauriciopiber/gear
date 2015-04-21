<?php
return array(
    'factories' => array(
        'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
    ),
    'aliases' => array(
        'translator' => 'MvcTranslator'
    ),
    'invokables' => array(
        'TestUpload\SearchForm\TestUploadImageSearchForm' =>
            'TestUpload\SearchForm\TestUploadImageSearchForm',
        'TestUpload\Fixture\TestUploadImageFixture' =>
            'TestUpload\Fixture\TestUploadImageFixture',
        'TestUpload\Filter\TestUploadImageFilter' =>
            'TestUpload\Filter\TestUploadImageFilter',
        'TestUpload\Form\TestUploadImageForm' =>
            'TestUpload\Form\TestUploadImageForm',
        'TestUpload\Service\TestUploadImageService' =>
            'TestUpload\Service\TestUploadImageService',
        'TestUpload\Repository\TestUploadImageRepository' =>
            'TestUpload\Repository\TestUploadImageRepository',
        'TestUpload\Entity\TestUploadImage' =>
            'TestUpload\Entity\TestUploadImage',
    ),
    'factories' => array(
        'TestUpload\Form\Search\TestUploadImageSearchForm' =>
            'TestUpload\Factory\TestUploadImageSearchFactory',
        'TestUpload\Factory\TestUploadImageFactory' =>
            'TestUpload\Factory\TestUploadImageFactory',
    ),
);
