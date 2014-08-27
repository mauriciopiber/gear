<?php
namespace Gear\Model;

use Zend\Db\Adapter\Adapter;
use Gear\Model\RouterGear;

class ConfigGear extends MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        $module = $this->getConfig()->getModule();
        return $this->getLocal() . '/module/' . $module . '/config';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        $entities = array_merge($entities, array(
            'index'
        ));
        if (is_array($entities) && count($entities) > 0) {
            $this->makeConfig($entities);
        } else {
            return false;
        }
    }

    public function makeConfig($tables_name, $method = 'yml')
    {
        $module = $this->getModule();
        $b = '';
        $b .= $this->getNamespace($module);
        $b .= $this->getInitArray();
        $b .= $this->getControllers($module, $tables_name);
        $b .= $this->getControllerPlugin();
        $b .= $this->getViewManager($module);

        $routerGear = new RouterGear($this->getConfig());

        $b .= $routerGear->createRoutesFromModule($tables_name);

        if ($method == 'db') {
            $b .= $this->getDoctrineAnnotationDriver();
        } else {
            $b .= $this->getDoctrineYAMLDriver($module);
        }

        $b .= $this->getNavigation($tables_name);
        $b .= $this->getEndArray();

        $mod_config = $this->mkPHP($this->getFinalPath(), 'module.config', $b);
    }

    public function getControllers($module_name, $tableNames)
    {
        $b = '';
        $b .= $this->getIndent(1) . trim("'controllers' => array(") . PHP_EOL;
        $b .= $this->getIndent(2) . trim("    'invokables' => array(") . PHP_EOL;

        $base = "" . $this->str('class', $module_name) . "\Controller\\";

        $max = $this->getMaxLenght($base, $tableNames);
        // echo $max."\n";

        // die('aki');
        foreach ($tableNames as $i => $v) {

            $controller = $this->str('class', $this->getFileName($v));

            $controllerName = $this->getInvokableName($controller);

            $emptySpaces = $this->getEmptySpaces($max - strlen($controllerName));

            $b .= $this->getIndent(3) . trim("'" . $controllerName . "'" . $emptySpaces . " => '" . $this->str('class', $module_name) . "\Controller\\" . $this->str('class', $this->getFileName($v)) . "Controller',") . PHP_EOL;
        }
        // die();
        $b .= $this->getIndent(2) . trim("    ),") . PHP_EOL;
        $b .= $this->getIndent(1) . trim("),") . PHP_EOL;
        return $b;
    }

    public function getControllerPlugin()
    {
        $b = $this->getIndent(1) . trim('\'controller_plugins\' => array(') . PHP_EOL;
        $b .= $this->getIndent(2) . trim('    \'invokables\' => array(') . PHP_EOL;
        $b .= $this->getIndent(3) . trim('        \'criteria\' => \'Application\Controller\Plugin\Criteria\',') . PHP_EOL;
        $b .= $this->getIndent(2) . trim('    )') . PHP_EOL;
        $b .= $this->getIndent(1) . trim('),') . PHP_EOL;
        return $b;
    }

    public function getViewManager($module_name)
    {
        $b = '';
        $b .= $this->getIndent(1) . trim("'view_manager' => array(") . PHP_EOL;
        $b .= $this->getIndent(2) . trim('\'template_map\' => array(') . PHP_EOL;
        $b .= $this->getIndent(3) . trim('\'layout/' . $this->str('url', $this->getModule()) . '\' => __DIR__ . \'/../view/layout/layout.phtml\',') . PHP_EOL;
        $b .= $this->getIndent(2) . trim('),') . PHP_EOL;
        $b .= $this->getIndent(2) . trim("    'template_path_stack' => array(") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("        '" . $this->str('url', $this->getModule()) . "' => __DIR__ . '/../view',") . PHP_EOL;
        $b .= $this->getIndent(2) . trim("    ),") . PHP_EOL;
        $b .= $this->getIndent(1) . trim("),") . PHP_EOL;
        return $b;
    }

    public function getDoctrineYAMLDriver($module_name)
    {
        $b = '';
        $b .= $this->getIndent(1) . trim("'doctrine' => array(") . PHP_EOL;
        $b .= $this->getIndent(2) . trim("            'driver' => array(") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("                /* This is where you can change the Mapping Driver */") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("                'orm_default' => array(") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("                    'drivers' => array(") . PHP_EOL;
        $b .= $this->getIndent(5) . trim("                        //'Application\Entity' => 'application_entities_annotation'") . PHP_EOL;
        $b .= $this->getIndent(5) . trim("                        /* uncomment the next line to use YAML Driver*/") . PHP_EOL;
        $b .= $this->getIndent(5) . trim("                        '" . $this->toClass($module_name) . "\Entity' => 'application_entities_yaml'") . PHP_EOL;
        $b .= $this->getIndent(5) . trim("                        /* uncomment the next line to use XML Driver*/") . PHP_EOL;
        $b .= $this->getIndent(5) . trim("                        //'Application\Entity' => 'application_entities_xml'") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("                    ),") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("                ),") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("                /* YamlDriver Example */") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("                'application_entities_yaml' => array(") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("                    'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("                    'paths' => array(__DIR__ . '/../src/' .__NAMESPACE__.  '/Yml/')") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("                ),") . PHP_EOL;
        $b .= $this->getIndent(2) . trim("           ),") . PHP_EOL;

        $b .= $this->getIndent(2) . trim('\'fixture\' => array(') . PHP_EOL;
        $b .= $this->getIndent(3) . trim('    \'' . $this->getModule() . '\' => __DIR__ . \'/../src/' . $this->getModule() . '/Fixture\',') . PHP_EOL;
        $b .= $this->getIndent(2) . trim(')') . PHP_EOL;
        $b .= $this->getIndent(1) . trim("        ),") . PHP_EOL;
        return $b;
    }

    public function getDoctrineAnnotationDriver()
    {
        $b = '';
        $b .= $this->getIndent(1) . trim("'doctrine' => array(") . PHP_EOL;
        $b .= $this->getIndent(2) . trim("    'driver' => array(") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("        __NAMESPACE__ . '_driver' => array(") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("            'cache' => 'array',") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("            'paths' => array(__DIR__ . '/../src/' .__NAMESPACE__.  '/Entity/')") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("        ),") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("        'orm_default' => array(") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("            'drivers' => array(") . PHP_EOL;
        $b .= $this->getIndent(5) . trim("                __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'") . PHP_EOL;
        $b .= $this->getIndent(4) . trim("            )") . PHP_EOL;
        $b .= $this->getIndent(3) . trim("        )") . PHP_EOL;
        $b .= $this->getIndent(2) . trim("    )") . PHP_EOL;
        $b .= $this->getIndent(1) . trim("),") . PHP_EOL;
        return $b;
    }

    public function getNavigation($tableNames)
    {
        $navigationGear = new \Gear\Model\NavigationGear($this->getConfig());

        if ($this->getModule() == 'BigMarket') {

            $navConfig = $navigationGear->getBigMarketConfig();

            $b = '';
            $b .= $this->getIndent(1) . trim('\'navigation\' => array(') . PHP_EOL;
            $b .= $this->getIndent(2) . trim('\'default\' => array(') . PHP_EOL;
            // $b .= $this->getIndent(3).trim(' \''.$this->str('url',$this->getModule()).'\' => array(').PHP_EOL;

            foreach ($navConfig as $i => $v) {

                $b .= $this->getIndent(4) . trim('array(') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('    \'label\' => \'' . $this->str('label', $i) . '\',') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('    \'route\' => \'' . $this->str('url', $i) . '\',') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('    \'pages\' => array(') . PHP_EOL;

                foreach ($v as $a => $c) {
                    $b .= $this->getIndent(6) . trim('array(') . PHP_EOL;
                    $b .= $this->getIndent(7) . trim('    \'label\' => \'' . $this->str('label', $c) . '\',') . PHP_EOL;
                    $b .= $this->getIndent(7) . trim('    \'route\' => \'' . $this->str('url', $c) . '/all\',') . PHP_EOL;
                    $b .= $this->getIndent(7) . trim('    \'action\' => \'list\',') . PHP_EOL;
                    $b .= $this->getIndent(6) . trim('),') . PHP_EOL;
                }

                $b .= $this->getIndent(5) . trim('    ),') . PHP_EOL;

                $b .= $this->getIndent(4) . trim('),') . PHP_EOL;
                // var_dump($v);
            }

            $b .= $this->getIndent(3) . trim('    ),') . PHP_EOL;
            // $b .= $this->getIndent(2).trim(' ),').PHP_EOL;
            $b .= $this->getIndent(1) . trim(')') . PHP_EOL;
        } else {

            $module = $this->getModule();
            $b = '';
            $b .= $this->getIndent(1) . trim('\'navigation\' => array(') . PHP_EOL;
            $b .= $this->getIndent(2) . trim('\'default\' => array(') . PHP_EOL;

            foreach ($tableNames as $i => $v) {

                $v = $this->getFileName($this->str('class', $v));

                $b .= $this->getIndent(3) . trim('array(') . PHP_EOL;
                $b .= $this->getIndent(4) . trim('    \'label\' => \'' . $this->str('label', $v) . '\',') . PHP_EOL;
                $b .= $this->getIndent(4) . trim('    \'route\' => \'' . $this->str('url', $this->getModule()) . '/' . $this->str('url', $v) . '\',') . PHP_EOL;
                $b .= $this->getIndent(4) . trim('    \'pages\' => array(') . PHP_EOL;

                $b .= $this->getIndent(5) . trim('array(') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'label\' => \'List\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'route\' => \'' . $this->str('url', $this->getModule()) . '/' . $this->str('url', $v) . '/all\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'action\' => \''.$this->getConfig()->getActionName('list').'\',') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('),') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('array(') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'label\' => \'Add\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'route\' => \'' . $this->str('url', $this->getModule()) . '/' . $this->str('url', $v) . '/all\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'action\' => \''.$this->getConfig()->getActionName('add').'\',') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('),') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('array(') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('     \'label\' => \'Edit\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'route\' => \'' . $this->str('url', $this->getModule()) . '/' . $this->str('url', $v) . '/all\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'action\' => \''.$this->getConfig()->getActionName('edit').'\',') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('),') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('array(') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'label\' => \'Delete\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'route\' => \'' . $this->str('url', $this->getModule()) . '/' . $this->str('url', $v) . '/all\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'action\' => \''.$this->getConfig()->getActionName('del').'\',') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('),') . PHP_EOL;
                $b .= $this->getIndent(5) . trim('array(') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'label\' => \'View\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'route\' => \'' . $this->str('url', $this->getModule()) . '/' . $this->str('url', $v) . '/all\',') . PHP_EOL;
                $b .= $this->getIndent(6) . trim('    \'action\' => \''.$this->getConfig()->getActionName('view').'\',') . PHP_EOL;
                $b .= $this->getIndent(5) . trim(')') . PHP_EOL;

                $b .= $this->getIndent(4) . trim('    )') . PHP_EOL;
                $b .= $this->getIndent(3) . trim('),') . PHP_EOL;
            }
            // $b .= $this->getIndent(3).trim(" '".ucfirst($module_name)."\Controller\\".$this->controllerToClass($v)."' => '".ucfirst($module_name)."\Controller\\".$this->controllerToClass($v)."Controller',").PHP_EOL;
            $b .= $this->getIndent(2) . trim('),') . PHP_EOL;
            $b .= $this->getIndent(1) . trim(')') . PHP_EOL;
        }

        return $b;
    }



    public function getOptions()
    {
        if ($this->getConfig()->getProject() == 'bigmarket-decuero' && $this->getConfig()->getModule() == 'Administrador') {

            return array(
                'navigation' => array(
                    'defaults' => array(
                        'label' => 'Inicio',
                        'route' => 'administrador/inicio'
                    )
                ),
                'router' => array(
                    'administrador' => array(
                        'login' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/login',
                                'defaults' => array(
                                    'controller' => 'zfcuser',
                                    'action' => 'login'
                                ),
                            ),
                        ),
                        'inicio' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/inicio',
                                'defaults' => array(
                                    'controller' => 'Administrador\Controller\Index',
                                    'action' => 'inicio'
                                ),
                            ),
                        ),
                        'enviar-recuperacao' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/enviar-recuperacao',
                                'defaults' => array(
                                    'controller' => 'Administrador\Controller\Index',
                                    'action' => 'enviar-recuperacao'
                                ),
                            ),
                        ),
                        'enviado-com-sucesso' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/enviado-com-sucesso',
                                'defaults' => array(
                                    'controller' => 'Administrador\Controller\Index',
                                    'action' => 'enviado-com-sucesso'
                                ),
                            ),
                        ),
                        'efetuar-recuperacao' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/efetuar-recuperacao',
                                'defaults' => array(
                                    'controller' => 'Administrador\Controller\Index',
                                    'action' => 'efetuar-recuperacao'
                                ),
                            ),
                        ),
                        'efetuado-com-sucesso' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/efetuado-com-sucesso',
                                'defaults' => array(
                                    'controller' => 'Administrador\Controller\Index',
                                    'action' => 'efetuado-com-sucesso'
                                ),
                            ),
                        ),
                        'logout' => array(
                            'type' => 'literal',
                            'options' => array(
                                'route' => '/logout',
                                'defaults' => array(
                                    'controller' => 'Administrador\Controller\Index',
                                    'action' => 'logout'
                                ),
                            ),
                        ),
                        'imagem' => array(
                            'salvar-imagem' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/salvar-imagem-entidade[/:entidade***REMOVED***[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'Administrador\Controller\Imagem',
                                        'action' => 'salvar-imagem-entidade'
                                    ),
                                    'constraints' => array(
                                        'entidade' => '[a-zA-Z0-9***REMOVED****',
                                        'id' => '[0-9***REMOVED****'
                                    )

                                ),
                                'may_terminate' => true
                            ),
                            'listar-imagem' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/listar-imagem-entidade[/:entidade***REMOVED***[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'Administrador\Controller\Imagem',
                                        'action' => 'listar-imagem-entidade'
                                    ),
                                    'constraints' => array(
                                        'entidade' => '[a-zA-Z0-9***REMOVED****',
                                        'id' => '[0-9***REMOVED****'
                                    )

                                ),
                                'may_terminate' => true
                            ),
                            'deletar-imagem' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/deletar-imagem-entidade[/:entidade***REMOVED***[/:id***REMOVED***',
                                    'defaults' => array(
                                        'controller' => 'Administrador\Controller\Imagem',
                                        'action' => 'deletar-imagem-entidade'
                                    ),
                                    'constraints' => array(
                                        'entidade' => '[a-zA-Z0-9***REMOVED****',
                                        'id' => '[0-9***REMOVED****'
                                    )

                                ),
                                'may_terminate' => true
                            )
                        )
                    )
                )
            );
        }
    }

}