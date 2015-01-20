<?php
return array(
    'int' => array(
	    null,
        'primary-key',
        'foreign-key',
        'checkbox'
    ),
    'tinyint' => array(
        null,
        'checkbox'
    ),
    'varchar' => array(
	    null,
        'image-upload',
        'email',
        'cpf',
        'cnpj',
        'cep'
    ),
    'date' => array(
	    null,
        'date-pt-br',
    ),
    'datetime' => array(
        null,
        'datetime-pt-br',
    ),
    'time' => array(
        null,
    ),
    'decimal' => array(
        null,
        'money-pt-br'
    ),
    'text' => array(
	    null,
        'html',
        'image-upload',
    ),
);