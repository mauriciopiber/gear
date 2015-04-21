<?php
return array(
    'imageEntity' => 'TestUpload\Entity\UploadImage',
    'uploadDir' => __DIR__.'/../../../../public/upload/',
    'refDir' => '/upload',
    'size' => array(
        'test-upload-image-image' => array(
            'pre' => array(100, 100),
            'sm' => array(400, 400),
            'xs' => array(200, 200),
        ),
    )
);
