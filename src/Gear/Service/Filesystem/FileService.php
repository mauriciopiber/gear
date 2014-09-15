<?php
namespace Gear\Service\Filesystem;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\PropertyGenerator;
use Gear\Service\AbstractService;

class FileService extends AbstractService
{
    /**
     *
     * @param string $path
     *            Pasta onde você quér colocar o arquivo PHP.
     * @param string $content
     *            Conteudo do Arquivo a ser processado.
     * @return boolean string responsável por criar o arquiro PHP fisicamente.
     */
    public function mkXML($path = '', $name = '', $content = '')
    {
        if (! is_dir($path) || $content == '' || $name == '') {
            return false;
        }

        $file = $path . '/' . $name . '.xml';
        if (is_file($file)) {
            unlink($file);
        }
        $fp = fopen($file, "a");

        $buffer = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . $content;
        $escreve = fwrite($fp, $buffer);
        fclose($fp);
        chmod($file, 0777); // changed to add the zero
        return $file;
    }

    /**
     *
     * @param string $path
     *            Pasta onde você quér colocar o arquivo PHP.
     * @param string $content
     *            Conteudo do Arquivo a ser processado.
     * @return boolean string responsável por criar o arquiro PHP fisicamente.
     */
    public function mkPHP($path = '', $name = '', $content = '')
    {
        if (! is_dir($path) || $content == '' || $name == '') {

            if (! is_dir($path)) {
                throw new \Exception('Diretório ' . $path . ' não foi criado corretamente');
            } else
                if (! is_writable($path) || ! is_readable($path)) {
                    throw new \Exception('Diretório ' . $path . ' não possui a permissão de escrita');
                }

            return false;
        }

        $file = $path . '/' . $name . '.php';
        if (is_file($file)) {
            unlink($file);
        }
        $fp = fopen($file, "a");

        $buffer = '<?php' . PHP_EOL . $content;
        $escreve = fwrite($fp, $buffer);
        fclose($fp);
        chmod($file, 0777); // changed to add the zero
        return realpath($file);
    }

    /**
     *
     * @param string $path
     *            Pasta onde você quér colocar o arquivo PHP.
     * @param string $content
     *            Conteudo do Arquivo a ser processado.
     * @return boolean string responsável por criar o arquiro PHP fisicamente.
     */
    public function mkHTML($path = '', $name = '', $content = '')
    {
        if (! is_dir($path) || $content == '' || $name == '') {
            return false;
        }

        $file = $path . '/' . $name . '.phtml';
        if (is_file($file)) {
            unlink($file);
        }
        $fp = fopen($file, "a");

        $buffer = trim($content);
        $escreve = fwrite($fp, $buffer);
        fclose($fp);
        chmod($file, 0777); // changed to add the zero
        return $file;
    }

    /**
     *
     * @param string $path
     *            Pasta onde você quér colocar o arquivo PHP.
     * @param string $content
     *            Conteudo do Arquivo a ser processado.
     * @return boolean string responsável por criar o arquiro PHP fisicamente.
     */
    public function mkJs($path = '', $name = '', $content = '')
    {
        if (! is_dir($path) || $content == '' || $name == '') {
            return false;
        }

        $file = $path . '/' . $name . '.js';
        if (is_file($file)) {
            unlink($file);
        }
        $fp = fopen($file, "a");

        $buffer = trim($content);
        $escreve = fwrite($fp, $buffer);
        fclose($fp);
        chmod($file, 0777); // changed to add the zero***REMOVED***

        return $file;
    }
}
