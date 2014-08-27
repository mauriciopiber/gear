<?php
namespace Gear\Service;

use Zend\Code\Generator\ClassGenerator;
use Zend\Code\Generator\DocBlockGenerator;
use Zend\Code\Generator\DocBlock\Tag;
use Zend\Code\Generator\MethodGenerator;
use Zend\Code\Generator\PropertyGenerator;

class FileService extends \Gear\Service\AbstractService
{

    function createFile($namespace,$use,$class,$extendedClass)
    {
        $foo = new ClassGenerator();
        $docblock = DocBlockGenerator::fromArray(array(
            'shortDescription' => 'Sample generated class',
            'longDescription' => 'This is a class generated with Zend\Code\Generator.',
            'tags' => array(
                array(
                    'name' => 'version',
                    'description' => '$Rev:$'
                ),
                array(
                    'name' => 'license',
                    'description' => 'New BSD'
                )
            )
        ));
        $foo->setName($class)
            ->setDocblock($docblock)
            ->setNamespaceName($namespace)
            ->addProperties(array(
                array(
                    'adapter',
                    null,
                    PropertyGenerator::FLAG_PRIVATE
                ),
                ))
            ->addMethods(
                array(
                    new MethodGenerator(
                        '__construct',
                        array(
            	            'adapter'
                        ),
                        MethodGenerator::FLAG_PUBLIC,
                        '$this->setAdapter($this->adapter);'
                    )
                )
            );
            /*
             ->addProperties(array(
                 array(
                     '_bar',
                     'baz',
                     PropertyGenerator::FLAG_PROTECTED
                 ),
                 array(
                     'baz',
                     'bat',
                     PropertyGenerator::FLAG_PUBLIC
                 ),
                 array(
                     'bat',
                     'foobarbazbat',
                     PropertyGenerator::FLAG_CONSTANT
                 )))
            */

            /*
             ->addMethods(array(
                 // Method passed as array
                 MethodGenerator::fromArray(array(
                     'name' => 'setBar',
                     'parameters' => array(
                         'bar'
                     ),
                     'body' => '$this->_bar = $bar;' . "\n" . 'return $this;',
                     'docblock' => DocBlockGenerator::fromArray(array(
                         'shortDescription' => 'Set the bar property',
                         'longDescription' => null,
                         'tags' => array(
                             new Tag\ParamTag(array(
                                 'paramName' => 'bar',
                                 'datatype' => 'string'
                             )),
                             new Tag\ReturnTag(array(
                                 'datatype' => 'string'
                             ))
                         )
                     ))
                 )),
                 // Method passed as concrete instance
                 new MethodGenerator('getBar', array(), MethodGenerator::FLAG_PUBLIC, 'return $this->_bar;', DocBlockGenerator::fromArray(array(
                     'shortDescription' => 'Retrieve the bar property',
                     'longDescription' => null,
                     'tags' => array(
                         new Tag\ReturnTag(array(
                             'datatype' => 'string|null'
                         ))
                     )
                 )))
                 */


        foreach($use as $i => $v) {
            $foo->addUse($v);
        }
        $foo->setExtendedClass($extendedClass);

        //echo $foo->generate();

        $this->mkPHP('/var/www/html/gear/public', 'test', $foo->generate());
    }

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