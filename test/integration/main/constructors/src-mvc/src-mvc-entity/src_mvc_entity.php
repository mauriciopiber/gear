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
                'column_time_bsc' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc' => [
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
                'column_time_bsc_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_upl' => [
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
                'column_time_bsc_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_uni' => [
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
                'column_time_bsc_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_uni_upl' => [
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
                'column_time_bsc_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_nul' => [
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
                'column_time_bsc_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_nul_upl' => [
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
                'column_time_bsc_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_uni_nul' => [
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
                'column_time_bsc_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_uni_nul_upl' => [
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
                'column_time_bsc_lws' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws' => [
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
                'column_time_bsc_lws_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws_upl' => [
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
                'column_time_bsc_lws_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws_uni' => [
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
                'column_time_bsc_lws_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws_uni_upl' => [
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
                'column_time_bsc_lws_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws_nul' => [
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
                'column_time_bsc_lws_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws_nul_upl' => [
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
                'column_time_bsc_lws_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws_uni_nul' => [
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
                'column_time_bsc_lws_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_lws_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_lws_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_lws_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_lws_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_lws_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_lws_uni_nul_upl' => [
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
                'column_time_bsc_str' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str' => [
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
                'column_time_bsc_str_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str_upl' => [
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
                'column_time_bsc_str_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str_uni' => [
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
                'column_time_bsc_str_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str_uni_upl' => [
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
                'column_time_bsc_str_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str_nul' => [
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
                'column_time_bsc_str_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str_nul_upl' => [
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
                'column_time_bsc_str_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str_uni_nul' => [
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
                'column_time_bsc_str_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_bsc_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_bsc_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_bsc_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_text_bsc_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_bsc_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_bsc_str_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_int_bsc_str_uni_nul_upl' => [
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
                'column_text_cmp' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp' => [
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
                'column_text_cmp_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_upl' => [
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
                'column_text_cmp_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_uni' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_uni' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_uni' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_uni' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_uni' => [
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
                'column_text_cmp_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_uni_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_uni_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_uni_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_uni_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_uni_upl' => [
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
                'column_text_cmp_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_nul' => [
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
                'column_text_cmp_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_nul_upl' => [
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
                'column_text_cmp_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_uni_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_uni_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_uni_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_uni_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_uni_nul' => [
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
                'column_text_cmp_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_uni_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_uni_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_uni_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_uni_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_uni_nul_upl' => [
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
                'column_text_cmp_lws' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws' => [
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
                'column_text_cmp_lws_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws_upl' => [
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
                'column_text_cmp_lws_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws_uni' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws_uni' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws_uni' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws_uni' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws_uni' => [
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
                'column_text_cmp_lws_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws_uni_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws_uni_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws_uni_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws_uni_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws_uni_upl' => [
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
                'column_text_cmp_lws_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws_nul' => [
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
                'column_text_cmp_lws_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws_nul_upl' => [
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
                'column_text_cmp_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws_uni_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws_uni_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws_uni_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws_uni_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws_uni_nul' => [
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
                'column_text_cmp_lws_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_lws_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_lws_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_lws_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_lws_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_lws_uni_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_lws_uni_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_lws_uni_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_lws_uni_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_lws_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_lws_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_lws_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_lws_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_lws_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_lws_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_lws_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_lws_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_lws_uni_nul_upl' => [
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
                'column_text_cmp_str' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str' => [
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
                'column_text_cmp_str_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str_upl' => [
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
                'column_text_cmp_str_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str_uni' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str_uni' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str_uni' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str_uni' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str_uni' => [
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
                'column_text_cmp_str_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str_uni_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str_uni_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str_uni_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str_uni_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str_uni_upl' => [
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
                'column_text_cmp_str_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str_nul' => [
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
                'column_text_cmp_str_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str_nul_upl' => [
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
                'column_text_cmp_str_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str_uni_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str_uni_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str_uni_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str_uni_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str_uni_nul' => [
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
                'column_text_cmp_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_text_html_cmp_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'column_decimal_cmp_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_decimal_money_cmp_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'column_boolean_cmp_str_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'column_boolean_checkbox_cmp_str_uni_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'column_int_cmp_str_uni_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'column_int_checkbox_cmp_str_uni_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_column_int_foreign_cmp_str_uni_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'column_time_cmp_str_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'column_datetime_cmp_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_datetime_ptbr_cmp_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'column_date_cmp_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_date_ptbr_cmp_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'column_varchar_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_password_verify_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_upload_image_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_url_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_unique_id_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'column_varchar_telephone_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'column_varchar_email_cmp_str_uni_nul_upl' => [
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
