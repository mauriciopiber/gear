<?php
namespace Gear\Creator;

use GearJson\Src\Src;
use GearJson\Controller\Controller;
use GearJson\Action\Action;
use GearJson\App\App;
use Gear\Creator\FileExtendsInterface;
use Gear\Creator\FileUseAttributeInterface;
use Gear\Creator\FileUseInterface;
use Gear\Creator\Component\Constructor\ConstructorParamsTrait;
use Gear\Creator\Codes\Code\AbstractCode;

class Code extends AbstractCode implements
    FileExtendsInterface,
    FileUseAttributeInterface,
    FileUseInterface
{
    use ConstructorParamsTrait;

    const ARRAY_SEPARATOR = ',';

    const EMPTY = '';

    const TEMPLATE_DOCS_PARAMS = '     * @param %s $%s %s';

    const INDENT_CONSTRUCTOR_PARAM = '        ';

    const SEPARATOR_CONSTRUCTOR_PARAM = ',';

    const CONSTRUCTOR_ARGS = '%s $%s';

    const CONSTRUCTOR_BODY = '        $this->%s = $%s;';

    static protected $defaultLocation;

    static protected $defaultNamespace;

    public $varTemplate = [
        'memcached' => 'cache',
        'doctrine.entitymanager.orm_default' => 'EntityManager',
        'translator' => 'translate'
    ***REMOVED***;

    public function getServiceName($controller)
    {
      $object = '%s\%s\%s';
      $namespace = ($controller->getNamespace() !== null) ? $controller->getNamespace() : 'Controller';
      $invokeName = sprintf($object, $this->getModule()->getModuleName(), $namespace, $controller->getNameOff());
      return $invokeName;
    }

    public function getInterfaceUse($data)
    {
        if (empty($data->getExtends()) && empty($data->getDependency())) {
            return '';
        }

        $this->uses = '';

        if ($data->getExtends() !== null) {
            $this->uses .= 'use '.$this->resolveNamespace($data->getExtends()).';'.PHP_EOL;
        }

        if (!empty($data->getDependency())) {
            foreach ($data->getDependency() as $item) {
                $this->uses .= 'use '.$this->resolveNamespace($item).';'.PHP_EOL;
            }
        }

        return $this->uses;
    }

    public function getInterfaceDependency($data)
    {
        $template = <<<EOS
    /**
     * Set %s
     *
     * @param %s \$%s %s
     *
     * @return self
     */
    public function set%s(%s \$%s);

    /**
     * Get %s
     *
     * @return null|%s
     */
    public function get%s();

EOS;

        if (empty($data->getDependency())) {
            return PHP_EOL;
        }

        $html = '';

        foreach ($data->getDependency() as $i => $dependency) {
            $class = $this->str('class', $this->resolveName($dependency));
            $var = $this->str('var-length', $class);
            $label = $this->str('label', $class);
            $namespace = $this->resolveNamespace($dependency);

            $html .= sprintf(
                $template,
                $label, //set
                $class, //param 1
                $var, //param var
                $label, //param 2
                $class, //set
                $class, //set arg
                $var,
                $label, //set var
                $namespace,
                $class,
                $class
            );

            if (isset($data->getDependency()[$i+1***REMOVED***)) {
                $html .= PHP_EOL;
            }
        }

        return $html;
    }

    public function getExtends($data)
    {
        if ($data->getExtends() === null) {
            if ($data instanceof Controller) {
                if ($this->str('class', $data->getType()) == 'Action') {
                    return 'AbstractActionController';
                }

                if ($this->str('class', $data->getType()) == 'Console') {
                    return 'AbstractConsoleController';
                }

                if ($this->str('class', $data->getType()) == 'Rest') {
                    return 'AbstractRestfulController';
                }
            }
            return null;
        }

        $extendsItem = explode('\\', $data->getExtends());
        return end($extendsItem);
    }

    /**
     * Retorna o nome completo que consiste no Namespace + Nome.
     */
    public function getClassName($data)
    {
        $namespace = '';

        if ($data instanceof Src) {
            if (empty($data->getNamespace())) {
                if ($data->getType() == 'SearchForm') {
                    $type = 'Form\\Search';
                } elseif ($data->getType() == 'ControllerPlugin') {
                    $type = 'Controller\\Plugin';
                } elseif ($data->getType() == 'ViewHelper') {
                    $type = 'View\\Helper';
                } else {
                    $type = $data->getType();
                }

                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName();
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName();
        }

        if ($data instanceof Controller) {
            if (empty($data->getNamespace())) {
                $type = 'Controller';
                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$data->getName();
            }

            $namespace = ($data->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $data->getNamespace().'\\'.$data->getName();
        }

        if ($data instanceof Action) {
            $controller = $data->getController();

            if ($data->getController()->getDb() === null) {
                $name = $controller->getName();
            } else {
                $name = $controller->getNameOff();
            }


            if (empty($controller->getNamespace())) {
                $type = 'Controller';
                return $this->getModule()->getModuleName().'\\'.$type.'\\'.$name;
            }

            $namespace = ($controller->getNamespace() != '\\') ? $this->getModule()->getModuleName().'\\' : '';

            $namespace .= $controller->getNamespace().'\\'.$name;
        }

        return $namespace;
    }

    /**
     * Create Docs Params for All Classes.
     *
     * @param unknown $src
     * @return string
     */
    public function getDocsParams($dependencies)
    {
        if (empty($dependencies)) {
            return $this->printEmptyParams();
        }


        $lengthParam = 0;
        $lengthVar = 0;
        $prepare = [***REMOVED***;
        /**
         *
         */

        foreach ($dependencies as $index => $classDependency) {
            $name = $this->str('class', $classDependency->getName());
            $var = $this->params[$index***REMOVED***;
            $var = $this->str('var', $var);
            $label = $this->str('label', $name);
            $lengthParam = (strlen($name) > $lengthParam) ? strlen($name) : $lengthParam;
            $lengthVar = strlen($var) > $lengthVar ? strlen($var) : $lengthVar;

            $prepare[***REMOVED*** = ['name' => $name, 'var' => $var, 'label' => $label***REMOVED***;
        }

        return $this->printConstructorParams($lengthParam, $lengthVar, $prepare);
    }

    public function printEmptyParams()
    {
        return  '     *';
    }

    public function printConstructorParams($lengthParam, $lengthVar, array $prepare)
    {

        $html = '     *'.PHP_EOL;

        foreach ($prepare as $item) {
            $html .= sprintf(
                self::TEMPLATE_DOCS_PARAMS,
                $item['name'***REMOVED***.str_repeat(' ', ($lengthParam-strlen($item['name'***REMOVED***))),
                $item['var'***REMOVED***.str_repeat(' ', ($lengthVar-strlen($item['var'***REMOVED***))),
                $item['label'***REMOVED***
            ).PHP_EOL;
        }

        $html .= '     *';

        return $html;
    }

    public function getConstructorDocs($data)
    {
        $classObject = new ClassObject($data, $this->getModule()->getModuleName());

        $params = $this->getDocsParams($classObject->getDependency());
        $namespace = $classObject->getName();

        $docs = <<<EOS
    /**
     * Constructor
{$params}
     * @return {$namespace}
     */

EOS;

        return $docs;
    }

    public function getDepVarTemplate($templateName)
    {
        if (array_key_exists($templateName, $this->varTemplate)) {
            return $this->varTemplate[$templateName***REMOVED***;
        }
        return $templateName;
    }

    public function constructEmptyConstructor($html)
    {
        $html .= ')'.PHP_EOL;
        $html .= '    {';
        $html .= PHP_EOL;
        $html .= '        return $this;';
        $html .= PHP_EOL;
        $html .= '    }';
        $html .= PHP_EOL;

        return $html;
    }

    /**
     * Função padrão para criar Constructors.
     *
     * @param Src $data
     */
    public function getConstructor($data)
    {
        $dependency = $data->getDependency();
        if (!is_array($dependency) || count($dependency)==0) {
            $html = $this->getConstructorDocs($data);
            $html .= '    public function __construct(';
            return $this->constructEmptyConstructor($html);
        }

        $dependency = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

        $constructorData = [***REMOVED***;

        foreach ($dependency as $i => $dependencyInstance) {
            $dependencyObject = new ClassDependencyObject($dependencyInstance, $this->getModule()->getModuleName(), $i);
            $item = $dependencyObject->getName();
            $name = $this->str('class', $item);

            $variable = $dependencyObject->getVar();
            $depVar = $this->getDepVarTemplate($variable);
            $depVar = $this->str('var', $depVar);

            $constructorData[***REMOVED*** = [
                'var' => $depVar,
                'name' => $name
            ***REMOVED***;
        }

        $this->paramsStack = [***REMOVED***;

        foreach ($constructorData as $classDependency) {
            $this->paramsStack[***REMOVED*** = $classDependency['var'***REMOVED***;
        }

        $this->params = $this->getConstructorParams()->createParams($this->paramsStack);


        $html = $this->getConstructorDocs($data);
        $html .= '    public function __construct(';
        return $this->printConstructor($html, $constructorData);
    }

    public function printConstructor($html, $constructorData)
    {
        $howManyDep = count($constructorData);
        $iterator = 0;

        $args = '';
        $attr = '';

        foreach ($constructorData as $index => $dependency) {
            $item = $dependency['name'***REMOVED***;
            $depVar = $this->params[$index***REMOVED***;

            if ($howManyDep > 1) {
                $args .= self::INDENT_CONSTRUCTOR_PARAM;
            }

            $args .= sprintf(self::CONSTRUCTOR_ARGS, $item, $depVar);

            //só coloca o separador se for mais de um parametro
            if ($howManyDep > 1 && $iterator < ($howManyDep-1)) {
                $args .= self::SEPARATOR_CONSTRUCTOR_PARAM;
                $iterator += 1;
            }

            //só vai pra nova linha se for mais de um parámetro.
            if ($howManyDep > 1) {
                $args .= PHP_EOL;
            }

            $attr .= sprintf(self::CONSTRUCTOR_BODY, $dependency['var'***REMOVED***, $depVar);

            //só pula para a próxima linha se for mais de um parametro
            if ($howManyDep > 1) {
                $attr .= PHP_EOL;
            }
        }

        if ($howManyDep > 1) {
            $html .= PHP_EOL;
        }
        $html .= $args;
        $html .= ($howManyDep > 1) ? '    ) {'.PHP_EOL : ')'.PHP_EOL.'    {'.PHP_EOL;
        $html .= $attr;
        $html .= PHP_EOL;


        $html .= (!($howManyDep > 1)) ? PHP_EOL : '';
        $html .= str_repeat(' ', 4*2).'return $this;'.PHP_EOL;
        $html .= '    }'.PHP_EOL;


        return $html;
    }

    public function getUseConstructor($data, array $ignoreTrait = [***REMOVED***, array $ignoreClass = [***REMOVED***)
    {
        $this->uses = '';

        $values = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

        foreach ($values as $alias => $item) {
            if (is_array($item) && isset($item['ig_t'***REMOVED***) && $item['ig_t'***REMOVED*** === true) {
                continue;
            }

            //o argumento ignore dessa função é relativo às dependências herdadas da classe pai
            //que não precisam de Traits.
            if (!in_array($item, $ignoreTrait) && !($data instanceof Controller) && $data->getType() !== 'Repository') {
                $this->uses .= 'use '.$this->resolveNamespace($item).'Trait;'.PHP_EOL;
            }
        }

        if (!empty($values) && $data->isFactory()) {

            foreach ($values as $alias => $item) {
                if (!in_array($item, $ignoreClass)) {
                    $this->uses .= 'use '.$this->resolveNamespace($item).';'.PHP_EOL;
                }
            }
        }



        return $this->uses;
    }


    public function getDependencyUseNamespace($data)
    {
        if ($data->hasDependency() == null) {
            return [***REMOVED***;
        }

        $deps = [***REMOVED***;

        $dependencies = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

        foreach ($dependencies as $dependency) {
            if (is_array($dependency) && isset($dependency['ig_t'***REMOVED***) && $dependency['ig_t'***REMOVED*** === true) {
                continue;
            }

            $srcType = $this->extractSrcTypeFromDependency($dependency);

            $srcName = $this->extractSrcNameFromDependency($dependency);

            $expand = is_array($dependency) && isset($dependency['expand'***REMOVED***) && $dependency['expand'***REMOVED*** === false ? '' : 'Trait';

            $depNamespace = ($srcType[0***REMOVED*** == '\\')
                ? sprintf('%s\%s%s', ltrim($srcType, '\\'), $srcName, $expand)
                : sprintf('%s\%s\%s%s', $this->getModule()->getModuleName(), $srcType, $srcName, $expand);

            $deps[***REMOVED*** = $depNamespace;
        }

        return $deps;
    }

    public function extractSrcTypeFromDependency($dependency)
    {
        if (is_array($dependency) && isset($dependency['class'***REMOVED***)) {
            $dependency = $dependency['class'***REMOVED***;
        }

        $srcType = $this->extractSrcType($dependency);
        if ($srcType == 'SearchForm') {
            return 'Form\\Search';
        } elseif ($srcType == 'ControllerPlugin') {
            return 'Controller\\Plugin';
        }

        return $srcType;
    }

    public function getUse($data)
    {
        $this->uses = [***REMOVED***;

        if (!empty($data->getImplements())) {
            foreach ($data->getImplements() as $alias => $item) {
                $this->uses[***REMOVED*** = $this->resolveNamespace($item);
            }
        }

        $this->uses = array_merge($this->uses, $this->getDependencyUseNamespace($data));

        if ($data->getExtends() !== null) {
            $extends = $data->getExtends();

            if (strpos($extends, 'ControllerPlugin\\') !== false) {
                $extends = str_replace('ControllerPlugin\\', 'Controller\\Plugin\\', $extends);
            }
            if (strpos($extends, 'ViewHelper\\') !== false) {
                $extends = str_replace('ViewHelper\\', 'View\\Helper\\', $extends);
            }

            $this->uses[***REMOVED*** = $this->resolveNamespace($extends);
        }

        if ($data->getExtends() == null && $data instanceof Controller) {
            if ($this->str('class', $data->getType()) == 'Action') {
              $this->uses[***REMOVED*** = 'Zend\Mvc\Controller\AbstractActionController';
            }

            if ($this->str('class', $data->getType()) == 'Console') {
              $this->uses[***REMOVED*** = 'Zend\Mvc\Controller\AbstractConsoleController';
            }

            if ($this->str('class', $data->getType()) == 'Rest') {
              $this->uses[***REMOVED*** = 'Zend\Mvc\Controller\AbstractRestfulController';
            }
        }

        if ($data->hasDependency() && $data->isFactory()) {

            $values = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

            foreach ($values as $item) {
                $this->uses[***REMOVED*** = $this->resolveNamespace($item);
            }
        }

        return $this->printUse($this->uses);
    }

    public function checkUseForConstructor($data)
    {
        $this->uses = [***REMOVED***;

        if ($data->hasDependency() && $data->isFactory()) {
            foreach ($data->getDependency() as $item) {
                $this->uses[***REMOVED*** = $this->resolveNamespace($item);
            }
        }

        return $this->printUse($this->uses);
    }

    public function extractNamesFromNamespaceArray(array $extract)
    {
        foreach ($extract as $name => $item) {
            if (!is_int($name)) {
                $data[***REMOVED*** = $name;
                continue;
            }

            $names = explode('\\', $item);
            $data[***REMOVED*** = end($names);
        }

        $html = '';

        if (count($data)>1) {
            $separator = '    ';
            $html .= PHP_EOL;
        } else {
            $separator = ' ';
        }


        foreach ($data as $i => $item) {
            $html .= $separator.$item;


            if (isset($data[$i+1***REMOVED***)) {
                $html .= ',';
            }

            $html .= PHP_EOL;
        }

        return $html;
    }

    public function getImplements($data, array $additional = null)
    {
        if (empty($data->getImplements()) && empty($additional)) {
            return PHP_EOL;
        }

        if ($data->getImplements() === null) {
            $imp = [***REMOVED***;
        } else {
            $imp = $data->getImplements();
        }

        if ($additional === null) {
            $additional = [***REMOVED***;
        }

        $implements = array_merge($additional, $imp);



        $html = ' implements';

        $html .= $this->extractNamesFromNamespaceArray($implements);

        return $html;
    }

    public function getDependencyUseAttribute($data, $eol = true, array $ignoreList = [***REMOVED***)
    {
        $attribute = '';

        if ($data->hasDependency() == null) {
            return '';
        }

        //$dependencies = $data->getDependency();

        $dependencies = array_map("unserialize", array_unique(array_map("serialize", $data->getDependency())));

        $count = count($dependencies);
        $now = 0;

        foreach ($dependencies as $i => $dependency) {

            if (is_array($dependency) && isset($dependency['ig_t'***REMOVED***) && $dependency['ig_t'***REMOVED*** === true) {
                continue;
            }

            $dependencyClass = (is_array($dependency) && isset($dependency['class'***REMOVED***)) ? $dependency['class'***REMOVED*** : $dependency;
            /*
                $dependencyClass = $dependency['class'***REMOVED***;
            } else {
                $dependencyClass = $dependency;
            }
            */

            if (in_array($dependencyClass, $ignoreList)
                || in_array($this->getModule()->getModuleName().'\\'.$dependencyClass, $ignoreList)
            ) {
                continue;
            }

            //var_dump($i, $dependency);
            $srcName = $this->extractSrcNameFromDependency($dependencyClass);

            $expand = is_array($dependency) && isset($dependency['expand'***REMOVED***) && $dependency['expand'***REMOVED*** === false ? '' : 'Trait';

            $namespace = sprintf('%s%s', $srcName, $expand);


            $attribute .= <<<EOL
    use $namespace;

EOL;

            if ($count>1 && $now < $count-1) {
                $attribute .= PHP_EOL;
            }

            $now += 1;
        }

        $eol = ($eol) ? PHP_EOL : '';

        return (!empty($attribute)) ? $attribute.$eol : $eol;
    }

    /**
     * Cria os Atributos das Classes de acordo com as Dependências
     *
     * {@inheritDoc}
     * @see \Gear\Creator\FileUseAttributeInterface::getUseAttribute()
     */
    public function getUseAttribute($data, array $include = null, array $default = [***REMOVED***)
    {
        /* Load Dependency */
        //$this->loadDependencyService($data);

        $attributes = $this->getDependencyUseAttribute($data, false, $default);

        if (!empty($include)) {
            foreach ($include as $name => $item) {
                if (!is_int($name)) {
                    $attributes .= '    use '.$name.';'.PHP_EOL;
                    continue;
                }

                $names = explode('\\', $item);

                $attributes .= '    use '.end($names).';'.PHP_EOL;
            }
        }

        return $attributes;
    }
}
