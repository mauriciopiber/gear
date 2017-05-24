<?php

use Phinx\Migration\AbstractMigration;

class SrcMvcEntity extends AbstractMigration
{
    const TABLES = [
        'src_mvc_basic' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_upload_image' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_unique' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_unique' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_unique' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_unique' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_unique_upload_image' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_unique_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_unique_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_unique_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_nullable' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_nullable' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_nullable_upload_image' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_unique_nullable' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_unique_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_unique_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_unique_nullable' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_unique_nullable_upload_image' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_unique_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_unique_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_unique_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict_upload_image' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict_unique' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict_unique' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict_unique' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict_unique' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict_unique_upload_image' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict_unique_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict_unique_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict_unique_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict_nullable' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict_nullable' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict_nullable_upload_image' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict_unique_nullable' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict_unique_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict_unique_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict_unique_nullable' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_low_strict_unique_nullable_upload_image' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_low_strict_unique_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict_upload_image' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict_unique' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict_unique' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict_unique' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict_unique' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict_unique_upload_image' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict_unique_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict_unique_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict_unique_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict_nullable' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict_nullable' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict_nullable_upload_image' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict_unique_nullable' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict_unique_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict_unique_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict_unique_nullable' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_basic_strict_unique_nullable_upload_image' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_time_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_basic_strict_unique_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'column_int_foreign' => [
            'nullable' => true,
            'unique' => false,
            'columns' => [
                'column_int_foreign_name' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***,
            'table' => [

            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_upload_image' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_unique' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_unique' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_unique' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_unique' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_unique' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_unique' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_unique' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_unique' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_unique_upload_image' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_unique_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_unique_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_unique_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_unique_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_unique_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_unique_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_nullable' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_nullable' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_nullable' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_nullable' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_nullable' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_nullable' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_nullable_upload_image' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_nullable_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_nullable_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_nullable_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_unique_nullable' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_unique_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_unique_nullable' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_unique_nullable' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_unique_nullable' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_unique_nullable' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_unique_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_unique_nullable_upload_image' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_unique_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_unique_nullable_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_unique_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_unique_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict_upload_image' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict_unique' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict_unique' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict_unique' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict_unique' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict_unique' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict_unique' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict_unique' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict_unique_upload_image' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict_unique_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict_unique_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict_unique_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict_unique_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict_unique_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict_unique_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict_nullable' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict_nullable' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict_nullable' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict_nullable' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict_nullable' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict_nullable_upload_image' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict_nullable_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict_nullable_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict_nullable_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict_unique_nullable' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict_unique_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict_unique_nullable' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict_unique_nullable' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict_unique_nullable' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict_unique_nullable' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict_unique_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_low_strict_unique_nullable_upload_image' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_low_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict_upload_image' => [
            'nullable' => false,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict_unique' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_unique' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_unique' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_unique' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_unique' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_unique' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_unique' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_unique' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_unique' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_unique' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_unique' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_unique' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_unique' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict_unique_upload_image' => [
            'nullable' => false,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_unique_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_unique_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_unique_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_unique_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_unique_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_unique_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_unique_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_unique_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_unique_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_unique_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_unique_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_unique_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict_nullable' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_nullable' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_nullable' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_nullable' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_nullable' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_nullable' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict_nullable_upload_image' => [
            'nullable' => true,
            'unique' => false,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_nullable_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_nullable_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_nullable_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict_unique_nullable' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [

            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_unique_nullable' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_unique_nullable' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_unique_nullable' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_unique_nullable' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_unique_nullable' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_unique_nullable' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_unique_nullable' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_unique_nullable' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_unique_nullable' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_unique_nullable' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_unique_nullable' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_unique_nullable' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'src_mvc_complete_strict_unique_nullable_upload_image' => [
            'nullable' => true,
            'unique' => true,
            'referenced_assoc' => [
                'upload_image'
            ***REMOVED***,
            'columns' => [
                'column_text_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_complete_strict_unique_nullable_upload_image' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***;

    public function createUnique(&$table, $columnName)
    {
        $table->addIndex($columnName, ['unique' => true***REMOVED***);
    }

    public function createForeignKey(&$table, $columnName)
    {
        $tableName = str_replace('id_', '', $columnName);
        $table->addForeignKey($columnName, $tableName, $columnName, ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);
    }

    public function getColumnConfig($type, $nullable)
    {
        $config = [***REMOVED***;


        switch ($type) {
            case 'string':
                $config = ['null' => $nullable, 'limit' => 150***REMOVED***;
                break;
            case 'text':
                $config = ['null' => $nullable***REMOVED***;
                break;
            case 'decimal':
                $config = ['null' => $nullable, 'precision' => 10, 'scale' => 2***REMOVED***;
                break;
            default:
                $config = ['null' => $nullable***REMOVED***;
                break;
        }

        return $config;
    }

    public function createColumn(&$table, $columnName, $type, $nullable, $unique)
    {
         $table->addColumn($columnName, $type, $this->getColumnConfig($type, $nullable));

        if ($unique && !in_array($type, ['text', 'boolean'***REMOVED***)) {
            $this->createUnique($table, $columnName);
        }

         return true;
    }

    public function createTable($tableName, $options)
    {
        $table = $this->table($tableName, ['id' => sprintf('id_%s', $tableName)***REMOVED***);

        foreach ($options['columns'***REMOVED*** as $columnName => $column) {
            $nullable = (isset($column['nullable'***REMOVED***)) ? $column['nullable'***REMOVED*** : $options['nullable'***REMOVED***;
            $unique = (isset($column['unique'***REMOVED***)) ? $column['unique'***REMOVED*** : $options['unique'***REMOVED***;
            //$properties = (isset($column['properties'***REMOVED***)) ? $column['properties'***REMOVED*** : [***REMOVED***;
            $this->createColumn($table, $columnName, $column['type'***REMOVED***, $nullable, $unique);
        }

        $table->create();

        if (isset($options['referenced_assoc'***REMOVED***)) {
            $this->createTableDependencies($tableName, $options['referenced_assoc'***REMOVED***);
        }
    }

    public function createTableDependencies($tableName, $tables)
    {
        if (empty($tables) || !is_array($tables)) {
            return;
        }

        foreach ($tables as $tableOption) {
            $this->createTableDependency($tableName, $tableOption);
        }
    }

    public function createTableDependency($tableName, $tableOption)
    {
        $tableOptionId = sprintf('id_%s', $tableOption);
        $tableId = sprintf('id_%s', $tableName);

        $referencedTable = $this->table($tableOption, ['id' => $tableOptionId***REMOVED***);
        $referencedTable->addColumn($tableId, 'integer', ['null' => true***REMOVED***);
        $referencedTable->addForeignKey($tableId, $tableName, $tableId, ['delete'=> 'CASCADE', 'update'=> 'CASCADE'***REMOVED***);

        $referencedTable->update();
    }

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
     **/
    public function change()
    {
        foreach (self::TABLES as $tableName => $options) {
            $this->createTable($tableName, $options);
        }
    }
}
