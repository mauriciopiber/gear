<?php
namespace Gear\Integration\Util\Columns;

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

    const DEFAULT_VARCHAR                 = 'column_varchar';

    const DEFAULT_VARCHAR_EMAIL           = self::DEFAULT_VARCHAR.'_email';

    const DEFAULT_VARCHAR_UPLOAD_IMAGE    = self::DEFAULT_VARCHAR.'_upload_image';

    const DEFAULT_VARCHAR_PASSWORD_VERIFY = self::DEFAULT_VARCHAR.'_password_verify';

    const DEFAULT_VARCHAR_URL             = self::DEFAULT_VARCHAR.'_url';

    const DEFAULT_VARCHAR_TELEPHONE       = self::DEFAULT_VARCHAR.'_telephone';

    const DEFAULT_VARCHAR_UNIQUE_ID       = self::DEFAULT_VARCHAR.'_unique_id';

    const COLUMNS = [
        self::DEFAULT_VARCHAR                 => [
            'type' => 'string'
        ***REMOVED***,
        self::DEFAULT_VARCHAR_PASSWORD_VERIFY => [
            'type' => 'string',
            'speciality' => 'password-verify',
            'unique' => false
        ***REMOVED***,
        self::DEFAULT_VARCHAR_UPLOAD_IMAGE    => [
            'type' => 'string',
            'speciality' => 'upload-image',
            'unique' => false
        ***REMOVED***,
        self::DEFAULT_VARCHAR_URL             => [
            'type' => 'string',
            'speciality' => 'url'
        ***REMOVED***,
        self::DEFAULT_VARCHAR_UNIQUE_ID       => [
            'type' => 'string',
            'speciality' => 'unique-id',
            'unique' => false
        ***REMOVED***,
        self::DEFAULT_VARCHAR_TELEPHONE       => [
            'type' => 'string',
            'speciality' => 'telephone'
        ***REMOVED***,
        self::DEFAULT_VARCHAR_EMAIL           => [
            'type' => 'string',
            'speciality' => 'email'
        ***REMOVED***,
    ***REMOVED***;
}
