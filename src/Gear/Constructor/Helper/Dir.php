<?php
namespace Gear\Constructor\Helper;

class Dir
{
    public static function createDir($dir)
    {
        if (is_dir($dir)) {
            return true;
        }

        if (!is_dir($dir) && !empty($dir)) {
            if (mkdir($dir, 0777, true)) {
                umask(0);
                chmod($dir, 0777);
            }
        } else {
            $dir = $dir;
        }

        return $dir;
    }
}
