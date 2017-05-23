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
                'clm_tme_bsc' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc' => [
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
                'clm_tme_bsc_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_upl' => [
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
                'clm_tme_bsc_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_uni' => [
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
                'clm_tme_bsc_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_uni_upl' => [
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
                'clm_tme_bsc_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_nul' => [
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
                'clm_tme_bsc_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_nul_upl' => [
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
                'clm_tme_bsc_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_uni_nul' => [
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
                'clm_tme_bsc_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_uni_nul_upl' => [
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
                'clm_tme_bsc_lws' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws' => [
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
                'clm_tme_bsc_lws_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws_upl' => [
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
                'clm_tme_bsc_lws_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws_uni' => [
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
                'clm_tme_bsc_lws_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws_uni_upl' => [
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
                'clm_tme_bsc_lws_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws_nul' => [
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
                'clm_tme_bsc_lws_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws_nul_upl' => [
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
                'clm_tme_bsc_lws_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws_uni_nul' => [
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
                'clm_tme_bsc_lws_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_lws_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_lws_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_lws_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_lws_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_lws_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_lws_uni_nul_upl' => [
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
                'clm_tme_bsc_str' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str' => [
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
                'clm_tme_bsc_str_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str_upl' => [
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
                'clm_tme_bsc_str_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str_uni' => [
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
                'clm_tme_bsc_str_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str_uni_upl' => [
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
                'clm_tme_bsc_str_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str_nul' => [
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
                'clm_tme_bsc_str_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str_nul_upl' => [
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
                'clm_tme_bsc_str_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str_uni_nul' => [
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
                'clm_tme_bsc_str_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_bsc_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_bsc_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_bsc_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_txt_bsc_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_bsc_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_bsc_str_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_int_bsc_str_uni_nul_upl' => [
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
                'clm_txt_cmp' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp' => [
                    'type' => 'string'
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***,
        'clm_int_frk' => [
            'nullable' => true,
            'unique' => false,
            'columns' => [
                'clm_int_frk_name' => [
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
                'clm_txt_cmp_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_upl' => [
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
                'clm_txt_cmp_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_uni' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_uni' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_uni' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_uni' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_uni' => [
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
                'clm_txt_cmp_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_uni_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_uni_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_uni_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_uni_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_uni_upl' => [
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
                'clm_txt_cmp_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_nul' => [
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
                'clm_txt_cmp_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_nul_upl' => [
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
                'clm_txt_cmp_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_uni_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_uni_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_uni_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_uni_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_uni_nul' => [
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
                'clm_txt_cmp_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_uni_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_uni_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_uni_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_uni_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_uni_nul_upl' => [
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
                'clm_txt_cmp_lws' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws' => [
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
                'clm_txt_cmp_lws_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_upl' => [
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
                'clm_txt_cmp_lws_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws_uni' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_uni' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws_uni' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_uni' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_uni' => [
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
                'clm_txt_cmp_lws_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws_uni_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_uni_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws_uni_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_uni_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_uni_upl' => [
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
                'clm_txt_cmp_lws_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_nul' => [
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
                'clm_txt_cmp_lws_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_nul_upl' => [
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
                'clm_txt_cmp_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws_uni_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_uni_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws_uni_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_uni_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_uni_nul' => [
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
                'clm_txt_cmp_lws_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_lws_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_lws_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_lws_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_lws_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_lws_uni_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_lws_uni_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_lws_uni_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_lws_uni_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_lws_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_lws_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_lws_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_lws_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_lws_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_lws_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_lws_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_lws_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_lws_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_lws_uni_nul_upl' => [
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
                'clm_txt_cmp_str' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str' => [
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
                'clm_txt_cmp_str_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_upl' => [
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
                'clm_txt_cmp_str_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str_uni' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str_uni' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_uni' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str_uni' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_uni' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str_uni' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_uni' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str_uni' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_uni' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str_uni' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str_uni' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str_uni' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_uni' => [
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
                'clm_txt_cmp_str_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str_uni_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str_uni_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_uni_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str_uni_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_uni_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str_uni_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_uni_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str_uni_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_uni_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str_uni_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str_uni_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str_uni_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_uni_upl' => [
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
                'clm_txt_cmp_str_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_nul' => [
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
                'clm_txt_cmp_str_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_nul_upl' => [
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
                'clm_txt_cmp_str_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str_uni_nul' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str_uni_nul' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_uni_nul' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str_uni_nul' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_uni_nul' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str_uni_nul' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_uni_nul' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str_uni_nul' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_uni_nul' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str_uni_nul' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str_uni_nul' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str_uni_nul' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_uni_nul' => [
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
                'clm_txt_cmp_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_txt_htm_cmp_str_uni_nul_upl' => [
                    'type' => 'text'
                ***REMOVED***,
                'clm_dcm_cmp_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_dcm_mny_cmp_str_uni_nul_upl' => [
                    'type' => 'decimal'
                ***REMOVED***,
                'clm_boo_cmp_str_uni_nul_upl' => [
                    'type' => 'boolean'
                ***REMOVED***,
                'clm_boo_chc_cmp_str_uni_nul_upl' => [
                    'type' => 'boolean',
                    'unique' => false
                ***REMOVED***,
                'clm_int_cmp_str_uni_nul_upl' => [
                    'type' => 'integer'
                ***REMOVED***,
                'clm_int_chc_cmp_str_uni_nul_upl' => [
                    'type' => 'integer',
                    'unique' => false
                ***REMOVED***,
                'id_clm_int_frk_cmp_str_uni_nul_upl' => [
                    'type' => 'integer',
                    'properties' => [
                        'foreignKey'
                    ***REMOVED***,
                    'unique' => false
                ***REMOVED***,
                'clm_tme_cmp_str_uni_nul_upl' => [
                    'type' => 'time'
                ***REMOVED***,
                'clm_dtt_cmp_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dtt_pt_cmp_str_uni_nul_upl' => [
                    'type' => 'datetime'
                ***REMOVED***,
                'clm_dte_cmp_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_dte_pt_cmp_str_uni_nul_upl' => [
                    'type' => 'date'
                ***REMOVED***,
                'clm_vrc_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_pav_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_upi_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_url_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_uni_cmp_str_uni_nul_upl' => [
                    'type' => 'string',
                    'unique' => false
                ***REMOVED***,
                'clm_vrc_tlp_cmp_str_uni_nul_upl' => [
                    'type' => 'string'
                ***REMOVED***,
                'clm_vrc_eml_cmp_str_uni_nul_upl' => [
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
