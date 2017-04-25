<?php
namespace Gear\Integration\Columns;

/**
 * PHP Version 5
 *
 * @category Interface
 * @package Gear/Integration/Columns
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
interface VarcharColumnsInterface
{

    const default_varchar = 'clm_vrc';
    const default_varchar_email = self::default_varchar.'_eml';
    const default_varchar_upload_image = self::default_varchar.'_upi';
    const default_varchar_password_verify = self::default_varchar.'_pav';
    const default_varchar_url = self::default_varchar.'_url';
    const default_varchar_telephone = self::default_varchar.'_tlp';
    const default_varchar_unique_id = self::default_varchar.'_uni';

    const COLUMNS = [
        self::default_varchar                 => ['type' => 'string'***REMOVED***,
        self::default_varchar_password_verify => ['type' => 'string', 'speciality' => 'password-verify', 'unique' => false***REMOVED***,
        self::default_varchar_upload_image    => ['type' => 'string', 'speciality' => 'upload-image', 'unique' => false***REMOVED***,
        self::default_varchar_url             => ['type' => 'string', 'speciality' => 'url'***REMOVED***,
        self::default_varchar_unique_id       => ['type' => 'string', 'speciality' => 'unique-id', 'unique' => false***REMOVED***,
        self::default_varchar_telephone       => ['type' => 'string', 'speciality' => 'telephone'***REMOVED***,
        self::default_varchar_email           => ['type' => 'string', 'speciality' => 'email'***REMOVED***,
    ***REMOVED***;
}
