<?php
namespace Gear\Service;

class FilesystemService extends \Gear\Service\AbstractService
{
    /**
     * Função responsável por checkar se o diretório está vazio.
     */
    public function isEmptyDir($dir)
    {
        if (! is_readable($dir)) {
            throw new Exception(sprintf('Directory %s is nos readble',$dir));
        }
        $handle = opendir($dir);
        while ( false !== ($entry = readdir($handle)) ) {
            if ($entry != "." && $entry != "..") {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     *
     * @param string $dir
     * @return boolean Função responsável por criar diretório com permissão máxima.
     */
    public function makeDir($dir)
    {
        if (! is_dir($dir) && ! empty($dir))  {
            if (mkdir($dir, 0777, true)) {
                umask(0);
                chmod($dir, 0777);
            }
        } else {
            $dir = $dir;
        }
        return $dir;
    }

    /**
    *
    * @param string $dir
    * @return boolean Função responsável por diretar diretórios e arquivos à partir de parametro.
    */
    public function rmDir($dir)
    {
        if (is_dir($dir) || is_file($dir)) {
            $files = array_diff(
                scandir($dir),
                array(
                    '.',
                    '..'
                )
            );
            foreach ( $files as $file ) {
                (is_dir("$dir/$file")) ? $this->rmDir("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        } else {
            return false;
        }
    }
}