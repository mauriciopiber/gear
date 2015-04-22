<?php
return array(
    'imageEntity' => 'Column\Entity\UploadImage',
    'uploadDir' => __DIR__.'/../../../../public/upload/',
    'refDir' => '/upload',
    'size' => array(
        'columns-columnVarcharUploadImage' => array(
            'pre' => array(100, 100),
            'sm' => array(400, 400),
            'xs' => array(200, 200),
        ),
    )
);
