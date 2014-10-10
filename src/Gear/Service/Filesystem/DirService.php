<?php
namespace Gear\Service\Filesystem;

use Gear\Service\AbstractService;

class DirService extends AbstractService
{

    /**
     * Copy a file, or recursively copy a folder and its contents
     * @param       string   $source    Source path
     * @param       string   $dest      Destination path
     * @param       string   $permissions New folder creation permissions
     * @return      bool     Returns true on success, false on failure
     */
    function xcopy($source, $dest, $permissions = 0755)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }

        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            xcopy("$source/$entry", "$dest/$entry");
        }

        // Clean up
        $dir->close();
        return true;
    }

    /**
     * Função responsável por checkar se o diretório está vazio.
     */
    public function isDirEmpty($dir)
    {
        if (! is_readable($dir))
            return null;
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                return false;
            }
        }

        return true;
    }

    /**
     *
     * @param  string  $dir
     * @return boolean Função responsável por criar diretório com permissão máxima.
     */
    public function mkDir($dir)
    {

        if (! is_dir($dir) && ! empty($dir)) {
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
     * @param  string  $dir
     * @return boolean Função responsável por diretar diretórios e arquivos à partir de parametro.
     */
    public function rmDir($dir)
    {
        if (is_dir($dir) || is_file($dir)) {
            $files = array_diff(scandir($dir), array(
                '.',
                '..'
            ));
            foreach ($files as $file) {
                (is_dir("$dir/$file")) ? $this->rmDir("$dir/$file") : unlink("$dir/$file");
            }

            return rmdir($dir);
        } else {
            return false;
        }
    }
}
