<?php
namespace Gear\Model;

use Zend\Db\Adapter\Adapter;
use Gear\Model\Schema;
/**
 *
 * @author piber
 *         Classe responsável por gerar e excluir arquivos e diretórios
 */
class MakeGear implements \Zend\Db\Adapter\AdapterAwareInterface
{

    /**
     * Novo Método de criação de variáveis.
     * Função responsável por reconhecer o estilo da string, e retornar no formato de $variavelCamelCase
     *
     * Recebe String Bruta
     * Primeiro separa os underline
     *
     * Caso não tenha underline, partir pra separação por Uppercase.
     * Separar todos UpperCase.
     * Juntar novamente, transformando apenas o primeiro em undercase.
     *
     * Caso possua underline.
     * Separar todas underline em Uppercase, 1 por 1
     * Juntar novamente, transformando apenas o primeiro em undercase.
     *
     */

    public $adapter;
    public $config;

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }



    public function __construct()
    {

    }

    /**
     * Verifica se a tabela tem suporte para imagem
     */
    public function checkImage($table)
    {
        //if(class_exists(''))
        $schema = new \Gear\Model\Schema($this->getConfig()->getDriver());

        $columns = $schema->getConstraints($this->str('uline','imagem'));

        $isImage = false;
        foreach($columns as $i => $v) {
            if($v->getType()=='FOREIGN KEY' && $this->str('class',$table) == $this->str('class',$v->getReferencedTableName())) {
                $isImage = true;
            }
        }

        return $isImage;
    }

    public function powerLine($indent,$text,$params = array(),$newline = false)
    {
        if(is_array($params)) {
    	    $string = $this->getI($indent).trim(vsprintf($text,$params)).PHP_EOL;
        } elseif(is_string($params)) {
            $string = $this->getI($indent).trim(sprintf($text,$params)).PHP_EOL;
        } else {
            throw new \Exception('Linha mal formada '.$text);
        }
    	if($newline) {
    	    $string .= PHP_EOL;
    	}
    	return $string;
    }


    public function getInvokableName($controller)
    {
        return $this->str('class',$this->getModule())."\Controller\\".$controller;
    }

    public function getEmptySpaces($howMany)
    {
        $output = '';
    	if($howMany > 1) {
            for($i = 0;$i < $howMany; $i++) {
                $output .= ' ';
            }
    	}
    	return $output;
    }

    public function getMaxLenght($base,$props)
    {
        $maxLenght = 1;
        foreach($props as $i => $v)
        {
            $max = strlen($base.$this->str('class',$this->getFileName($v)))."\n";
            if($max>$maxLenght)
            {
                $maxLenght = $max;
            }
        }
        return $maxLenght;
    }

    public function getFileName($table)
    {
        $table = $this->str('class',$table);
        if($this->getConfig()->getPrefix()!='') {

            //var_dump($table);
            $table = str_replace($this->str('class',$this->getConfig()->getPrefix()),'',$table);
        }

        return $table;
    }

    public function getModule()
    {
    	return $this->config->getModule();
    }

    public function setConfig(\Gear\Model\Configuration $configuration)
    {
        $this->config = $configuration;
        $this->adapter = $configuration->getDriver();
    }
    public function getConfig()
    {
    	return $this->config;
    }

    public function entityManager()
    {
        $b  = $this->getIndent(1).trim('public function getEntityManager()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('    if (null === $this->entityManager) {').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $service = $this->getServiceLocator();').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $entityManager = $service->get(\'doctrine.entitymanager.orm_default\');').PHP_EOL;
        $b .= $this->getIndent(3).trim('        $this->entityManager = $entityManager;').PHP_EOL;
        $b .= $this->getIndent(2).trim('    }').PHP_EOL;
        $b .= $this->getIndent(2).trim('    return $this->entityManager;').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL;
        $b .= PHP_EOL;
        return $b;
    }

    public function getSafeColumn($tableName)
    {
        $columns = $this->getColumns($tableName);


        $safe = null;

        foreach($columns as $i => $v) {
            if(in_array($this->str('uline',$v->name),$this->getConfig()->getSafeColumns())) {
                $safe = $v->name;
                break;
            } elseif($v->pk) {
                $pk = $v->name;
            }
        }

        if($safe==null) {
            if(isset($pk)) {
                return $pk;
            } else {
                return null;
            }
        } else {
            return $safe;
        }
    }

    public function defineServiceLocator()
    {
        return $this->getIndent(1).trim('protected $serviceLocator;').PHP_EOL;

    }

    public function defineEntityManager()
    {
        return $this->getIndent(1).trim('protected $entityManager;').PHP_EOL;
    }

    public function serviceLocator()
    {
        $b = '';

        $b .= $this->getIndent(1).trim('public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('$this->serviceLocator = $serviceLocator;').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        $b .= $this->getIndent(1).trim('public function getServiceLocator()').PHP_EOL;
        $b .= $this->getIndent(1).trim('{').PHP_EOL;
        $b .= $this->getIndent(2).trim('return $this->serviceLocator;').PHP_EOL;
        $b .= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        return $b;
    }


    public function str($type = null,$data = null)
    {
        return $this->strBuilder($type,$data);
    }

    public function toVar($data)
    {
    	return $this->strBuilder('var',$data);
    }

    public function strBuilder($type = null,$data)
    {
        if(empty($type) && !is_string($data)) {
            return false;
        }

        switch($type) {
        	case 'var':
        	    $function = 'baseToVar';
        	    break;
        	case 'url':
        	    $function = 'baseToUrl';
        	    break;
        	case 'code':
        	    $function = 'baseToCode';
        	    break;
        	case 'class':
        	    $function = 'baseToClass';
        	    break;
        	case 'label':
        	    $function = 'basetoLabel';
        	    break;
        	case 'uline':
        	    $function = 'baseToUnderline';
        	    break;
        	default:
        	    break;
        }
        $plus = 0;
        $format = '';
        $pieces = explode('_', $data);
        //caso tenha underline, ele olha pedaço por pedado atras de Maiúsculas.
        if(count($pieces)>1) {
            foreach($pieces as $i => $v) {
                preg_match_all('/[A-Z***REMOVED***/', $v,$match,PREG_OFFSET_CAPTURE);
                if(count($match[0***REMOVED***)>0) {
                    foreach($match[0***REMOVED*** as $a => $b) {
                        if(isset($match[0***REMOVED***[($a+1)***REMOVED***)) {
                            $last = $match[0***REMOVED***[($a+1)***REMOVED***[1***REMOVED***;
                        } else {
                            $last = strlen($v);
                        }
                        $format .= $this->$function(substr($v, $b[1***REMOVED***,$last-$b[1***REMOVED***),array($a,$i));
                    }
                } else {
                    $format .= $this->$function($v,array($i));
                }
            }
        //caso não tenha underline, ele olha pedaço por pedaço atras das Maiusculas
        } else {
            if (lcfirst($pieces[0***REMOVED***) == $pieces[0***REMOVED***) {
                preg_match('/[A-Z***REMOVED***/', $pieces[0***REMOVED***,$match,PREG_OFFSET_CAPTURE);
                if(isset($match[0***REMOVED***[1***REMOVED***)) {
                    $format .= $this->$function(substr($pieces[0***REMOVED***, 0,$match[0***REMOVED***[1***REMOVED***),array());
                    $plus = 1;
                }
            }
            preg_match_all('/[A-Z***REMOVED***/', $pieces[0***REMOVED***,$match,PREG_OFFSET_CAPTURE);
            if(count($match[0***REMOVED***)>0) {
                foreach($match[0***REMOVED*** as $a => $b) {
                    if(isset($match[0***REMOVED***[($a+1)***REMOVED***)) {
                        $last = $match[0***REMOVED***[($a+1)***REMOVED***[1***REMOVED***;
                    } else {
                        $last = strlen($pieces[0***REMOVED***);
                    }
                    $format .= $this->$function(substr($pieces[0***REMOVED***, $b[1***REMOVED***,$last-$b[1***REMOVED***),array($a+$plus));
                }
            } else {
                $format .= $this->$function($pieces[0***REMOVED***,array($plus));
            }
        }
        return $format;

    }

    /**
     * Função responsável por dizer se estamos falando da primeira interação, ou das subsequêntes, há algumas funções que alterar o valor da primeira letra da palavra.
     * @param array $iterator
     * @return boolean $beFirst retorna se é o primeiro elemento ou subsequêntes.
     */
    public function checkIterator($iterator = array())
    {
        $beFirst = true;
        foreach($iterator as $i => $v) {
            if($v!=0) {
                $beFirst = false;
                break;
            }
        }
        return $beFirst;
    }

    public function baseToClass($eval,$iterator = array())
    {
        return ucfirst($eval);
    }

    public function baseToVar($eval,$iterator = array())
    {
        return ($this->checkIterator($iterator)) ? lcfirst($eval) : ucfirst($eval);
    }

    public function baseToUrl($eval,$iterator = array())
    {
        return ($this->checkIterator($iterator)) ? strtolower($eval) : '-'.strtolower($eval);
    }
    public function baseToCode($eval,$iterator = array())
    {
        return strtolower($eval);
    }
    public function baseToLabel($eval,$iterator = array())
    {
    	if($eval=='id' || $eval=='Id') {
    		return '';
    	}
        return ($this->checkIterator($iterator)) ? ucfirst($eval) : ' '.ucfirst($eval);
    }

    public function baseToUnderline($eval,$iterator = array())
    {
        return ($this->checkIterator($iterator)) ? strtolower($eval) : '_'.strtolower($eval);
    }



    /**
     * @param string $literal 'TabelaComposta'
     * @return string $controller 'TabelaComposta
     * @deprecated
     */
    public function toClass($literal)
    {
        return $this->strBuilder('class',$literal);
    }

    /**
     * @deprecated
     */
    public function underlineToLabel($literal)
    {
        return $this->strBuilder('label',$literal);
    }
    /**
     *
     * @param string $literal tabela_composta
     * @return string TabelaComposta
     */
    public function underlineToClass($literal)
    {
        return $this->strBuilder('class',$literal);
    }

    public function underlineToUrl($literal)
    {
        return $this->strBuilder('url',$literal);
    }

    public function underlineToTable($literal)
    {
        return $this->strBuilder('uline',$literal);
    }

    public function underlineToCode($literal)
    {
        return $this->strBuilder('code',$literal);
    }

    public function controllerToLabel($literal)
    {
        return $this->strBuilder('label',$literal);
    }
    public function controllerToCode($literal)
    {
        return $this->strBuilder('code',$literal);
    }

    public function controllerToUrl($literal)
    {
        return $this->strBuilder('url',$literal);
    }
    public function controllerToClass($literal)
    {
        return $this->strBuilder('class',$literal);
    }
    public function controllerToEntity($literal)
    {
        return $this->strBuilder('class',$literal);
    }
    /**
     * @param string $controller_literal 'TabelaComposta'
     * @return string $controller 'tabela-composta
     */
    public function toUrl($literal)
    {
        return $this->strBuilder('url',$literal);
    }

    /**
     * @param string $literal 'TabelaComposta'
     * @return string $controller 'tabelacomposta
     */
    public function toCode($literal)
    {
        return $this->strBuilder('code',$literal);
    }

    /**
     * @param string $literal 'TabelaComposta'
     * @return string $controller 'Tabela Composta
     */
    public function toLabel($literal)
    {
        return $this->strBuilder('label',$literal);

    }
    /**
     * @param string $literal 'TabelaComposta'
     * @return string $controller 'tabela_composta
     */
    public function toTable($literal)
    {
        return $this->strBuilder('uline',$literal);
    }

    public function getPrimaryKeyColumn($tableName)
    {
        $schema = new \Gear\Model\Schema($this->getAdapter());
        $constraint = $schema->getConstraints($tableName);
        $columns = array();
        foreach($constraint as $v) {
            if($v->getType()=='PRIMARY KEY') {
                $columns = $v->getColumns();
                break;
            }
        }
        return $columns;
        //var_dump($constraint);die();
    }

    public function getColumn($columnName,$tableName)
    {
        $schema = new \Gear\Model\Schema($this->getAdapter());
        $columns = $schema->getColumn($columnName,$tableName);

        $pk = $this->getPrimaryKeyColumn($tableName);

        $stdClass = new \stdClass();
        $stdClass->name = $this->underlineToClass($columns->getName());
        $stdClass->dataType = $columns->getDataType();
        $stdClass->table = $columns->getTableName();
        $stdClass->pk = false;
        if(in_array($columns->getName(),$pk)) {
            $stdClass->pk = true;
        }

        $foreignKey = $schema->hasConstraint($columns->getName(), $schema->getConstraints($tableName),'FOREIGN KEY');

        if($foreignKey !== false) {
            $stdClass->fk = $foreignKey->getReferencedTableName();
        } else {
            $stdClass->fk = false;
        }

        if($stdClass->name == 'CreatedDate' || $stdClass->name =='UpdatedDate' || in_array($stdClass->name,$this->getConfig()->getDbException())) {
            $stdClass->ts = true;
        } else {
            $stdClass->ts = false;
        }

        if($columns->getIsNullable()) {
            $stdClass->null = true;
        } else {
            $stdClass->null = false;
        }

        return $stdClass;

    }
    /**
     * Função responsável por retornar os nomes das colunas da tabela, formatados em ClassName.
     *
     * --- Deve retornar as foreign keys, associando cada foreign key entre a coluna da tabela atual e a tabela principal, pra gerar as variáveis.
     *
     * @param string $tableName
     */
    public function getColumns($tableName,$prefix = '')
    {
        //echo $prefix.$tableName;die();
        $schema = new \Gear\Model\Schema($this->getAdapter());
        $columns = $schema->getColumns($this->str('uline',$tableName));
        $pk = $this->getPrimaryKeyColumn($tableName);
        $format = array();
        foreach($columns as $i => $v)
        {
            $stdClass = new \stdClass();
            $stdClass->name = $this->underlineToClass($v->getName());
            $stdClass->dataType = $v->getDataType();
            $stdClass->pk = false;
            $stdClass->table = $v->getTableName();
            if(in_array($v->getName(),$pk)) {
            	$stdClass->pk = true;
            }

            $foreignKey = $schema->hasConstraint($v->getName(), $schema->getConstraints($tableName),'FOREIGN KEY');

            if($foreignKey !== false) {
                $stdClass->fk = $foreignKey->getReferencedTableName();
            } else {
            	$stdClass->fk = false;
            }

            if(in_array($stdClass->name,array('CreatedDate','UpdatedDate','Created','Updated'))) {
            	$stdClass->ts = true;
            } else {
                $stdClass->ts = false;
            }

            if($v->isNullable()) {
                $stdClass->nl = true;
            } else {
                $stdClass->nl = false;
            }

            $format[***REMOVED*** = $stdClass;
        }
        return $format;
    }
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getFolder() {
        return $this->getConfig()->getPath();
    }



    public function getProject() {
        return $this->getProject()->getProject();
    }

    public function getLocal()
    {
        return $this->getConfig()->getPath().'/'.$this->getConfig()->getProject();
    }
    /**
     * @codeCoverageIgnore
     */
    public function setDbAdapter(\Zend\Db\Adapter\Adapter $adapter)
    {
    	$this->adapter = $adapter;
    }


    public function is_dir($dir)
    {
        return (is_dir($dir) && file_exists($dir)) ? true : false;
    }

    public function getNamespace($module_name)
    {
        return   'namespace ' . $module_name . ';'
               . PHP_EOL
               . PHP_EOL;
    }

    public function getEndFile()
    {
        return '}'.PHP_EOL;
    }

    public function getEndArray()
    {
        return ');'.PHP_EOL;
    }

    public function getInitArray()
    {
        return 'return array(' . PHP_EOL;
    }

    public function getI($var = 1,$patterns = 4)
    {
        return $this->getIndent($var,$patterns);
    }


    public function getIndent($var = 1, $patterns = 4)
    {
        $patters_std = ' ';

        $indent = ($var * $patterns);

        $buffer = '';
        for($t = 0; $t < ($indent); $t ++)
        {
            $buffer .= $patters_std;
        }
        return $buffer;
    }

    /**
     * Função responsável por checkar se o diretório está vazio.
     */
    public function is_dir_empty($dir)
    {
        if (! is_readable($dir))
            return NULL;
        $handle = opendir($dir);
        while ( false !== ($entry = readdir($handle)) )
        {
            if ($entry != "." && $entry != "..")
            {
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
    public function mkDir($dir)
    {
        if (! is_dir($dir) && ! empty($dir))
        {
            if (mkdir($dir, 0777, true))
            {
                // mkdir($dir, 0777);
                umask(0);
                chmod($dir, 0777);
                // umask($oldmask);
                //
            }
        }
        else
        {
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
            $files = array_diff(scandir($dir), array(
                '.',
                '..'
            ));
            foreach ( $files as $file ) {
                (is_dir("$dir/$file")) ? $this->rmDir("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        } else {
            return false;
        }
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
        if (! is_dir($path) || $content == '' || $name == '')
        {
            return false;
        }

        $file = $path . '/' . $name . '.xml';
        if (is_file($file))
        {
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

            if(!is_dir($path)) {
                throw new \Exception('Diretório '.$path.' não foi criado corretamente');
            } else if(!is_writable($path) || !is_readable($path)) {
                throw new \Exception('Diretório '.$path.' não possui a permissão de escrita');
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
        if (! is_dir($path) || $content == '' || $name == '')  {
            return false;
        }

        $file = $path . '/' . $name . '.phtml';
        if (is_file($file))
        {
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
        if (! is_dir($path) || $content == '' || $name == '')  {
            return false;
        }


        $file = $path . '/' . $name . '.js';
        if (is_file($file))
        {
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