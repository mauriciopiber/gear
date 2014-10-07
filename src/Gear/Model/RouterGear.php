<?php

namespace Gear\Model;

/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class RouterGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function createRoutesFromModule($tables)
    {
        return $this->getRoute($tables);
    }

    public function getRoute($tables)
    {
        //var_dump($tables);die();
        $module = $this->getModule();

        $capit = $this->str('class',$module);
        $b = '';
        $b .= $this->getIndent(1).trim("'router' => array(").PHP_EOL;
        $b .= $this->getIndent(2).trim("    'routes' => array(").PHP_EOL;

        $table_class = 'Index';
        $table_link  = $this->str('url',$this->str('class',$this->getModule()));
        $action = 'index';
        //$table_link = $this-.g

        $b .= $this->getIndent(3).trim("'".$table_link."' => array(").PHP_EOL;
        $b .= $this->getIndent(4).trim("    'type' => 'segment',").PHP_EOL;
        $b .= $this->getIndent(4).trim("    'options' => array(").PHP_EOL;
        $b .= $this->getIndent(5).trim("        'route' => '/".$table_link."',").PHP_EOL;
        $b .= $this->getIndent(5).trim("        'defaults' => array(").PHP_EOL;
        $b .= $this->getIndent(6).trim("            'controller' => '".$capit."\Controller\\".$table_class."',").PHP_EOL;
        $b .= $this->getIndent(6).trim("            'action' => '".$action."'").PHP_EOL;
        $b .= $this->getIndent(5).trim("        ),").PHP_EOL;
        $b .= $this->getIndent(4).trim("    ),").PHP_EOL;
        $b .= $this->getIndent(4).trim("    'may_terminate' => true,").PHP_EOL;
        $b .= $this->getIndent(4).trim("    'child_routes' => array(").PHP_EOL;

        foreach ($tables as $i => $v) {
            if ($v=='index') {
                continue;
            }
            $table_class = $this->getFileName($this->str('class',$v));
            $table_link  = $this->str('url',$this->getFileName($this->str('class',$v)));
            $action = $this->getConfig()->getActionName('list');

            $b .= $this->getIndent(5).trim("'".$table_link."' => array(").PHP_EOL;
            $b .= $this->getIndent(6).trim("    'type' => 'literal',").PHP_EOL;
            $b .= $this->getIndent(6).trim("    'options' => array(").PHP_EOL;
            $b .= $this->getIndent(7).trim("        'route' => '/".$table_link."',").PHP_EOL;
            $b .= $this->getIndent(7).trim("        'defaults' => array(").PHP_EOL;
            $b .= $this->getIndent(8).trim("            'controller' => '".$capit."\Controller\\".$table_class."',").PHP_EOL;
            $b .= $this->getIndent(8).trim("            'action' => '".$action."'").PHP_EOL;
            $b .= $this->getIndent(7).trim("        ),").PHP_EOL;
            $b .= $this->getIndent(6).trim("    ),").PHP_EOL;
            $b .= $this->getIndent(6).trim("    'may_terminate' => true,").PHP_EOL;
            $b .= $this->getIndent(6).trim("    'child_routes' => array(").PHP_EOL;
            $b .= $this->getIndent(7).trim("        'list' => array(").PHP_EOL;
            $b .= $this->getIndent(8).trim("            'type' => 'segment',").PHP_EOL;
            $b .= $this->getIndent(8).trim("            'options' => array(").PHP_EOL;
            $b .= $this->getIndent(9).trim("                'route' => '/[:action***REMOVED***[/page/:page***REMOVED***[/order_by/:order_by***REMOVED***[/:order***REMOVED***',").PHP_EOL;
            $b .= $this->getIndent(9).trim("                'constraints' => array(").PHP_EOL;
            $b .= $this->getIndent(10).trim("                    'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',").PHP_EOL;
            $b .= $this->getIndent(10).trim("                    'page' => '[0-9***REMOVED***+',").PHP_EOL;
            $b .= $this->getIndent(10).trim("                    'order_by' => '[a-zA-Z***REMOVED***[a-zA-Z0-9_-***REMOVED****',").PHP_EOL;
            $b .= $this->getIndent(10).trim("                    'order' => 'asc|desc',").PHP_EOL;
            $b .= $this->getIndent(9).trim("                ),").PHP_EOL;
            $b .= $this->getIndent(9).trim("                'defaults' => array(").PHP_EOL;
            $b .= $this->getIndent(10).trim("                    'controller' => '".$capit."\Controller\\".$table_class."',").PHP_EOL;
            $b .= $this->getIndent(10).trim("                    'page'       => 1,").PHP_EOL;
            //$b .= $this->getIndent(10).trim("                    'order_by'   => 'id$table_class',").PHP_EOL;
            //$b .= $this->getIndent(10).trim("                    'order'      => 'desc' ,").PHP_EOL;
            $b .= $this->getIndent(9).trim("                ),").PHP_EOL;
            $b .= $this->getIndent(8).trim("            )").PHP_EOL;
            $b .= $this->getIndent(7).trim("        ),").PHP_EOL;
            $b .= $this->getIndent(7).trim('        \'all\' => array(').PHP_EOL;
            $b .= $this->getIndent(8).trim('        	\'type\' => \'segment\',').PHP_EOL;
            $b .= $this->getIndent(8).trim('        	\'options\' => array(').PHP_EOL;
            $b .= $this->getIndent(9).trim('        		\'route\' => \'/:action[/***REMOVED***[:id***REMOVED***\',').PHP_EOL;
            $b .= $this->getIndent(9).trim('        		\'defaults\' => array(').PHP_EOL;
            $b .= $this->getIndent(10).trim('        			\'controller\' => \''.$this->str('class',$this->getModule()).'\Controller\\'.$table_class.'\',').PHP_EOL;
            $b .= $this->getIndent(9).trim('                ),').PHP_EOL;
            $b .= $this->getIndent(9).trim('        	    \'constraints\' => array(').PHP_EOL;
            $b .= $this->getIndent(10).trim('        		    \'id\'     => \'[0-9***REMOVED****\',').PHP_EOL;

            //$b .= $this->getIndent(10).trim(sprintf('  	    	\'action\' => \'edit|view|del|add|list\'')).PHP_EOL;

            if ($this->checkImage($v)) {
                $b .= $this->getIndent(10).trim(sprintf('  	    	\'action\' => \'%s|%s|%s|%s|%s\%s',
                    $this->getConfig()->getActionName('edit'),
                    $this->getConfig()->getActionName('view'),
                    $this->getConfig()->getActionName('del'),
                    $this->getConfig()->getActionName('add'),
                    $this->getConfig()->getActionName('list'),
                    $this->getConfig()->getActionName('image')
                    )
                ).PHP_EOL;
            } elseif ($v=='imagem') {
                $b .= $this->getIndent(10).trim(sprintf('  	    	\'action\' => \'%s|%s|%s|%s|%s\%s\%s\%s',
                    $this->getConfig()->getActionName('edit'),
                    $this->getConfig()->getActionName('view'),
                    $this->getConfig()->getActionName('del'),
                    $this->getConfig()->getActionName('add'),
                    $this->getConfig()->getActionName('list'),
                    $this->getConfig()->getActionName('add-image-entity'),
                    $this->getConfig()->getActionName('list-image-entity'),
                    $this->getConfig()->getActionName('del-image-entity'))
                ).PHP_EOL;
            } else {
                $b .= $this->getIndent(10).trim(sprintf('  	    	\'action\' => \'%s|%s|%s|%s|%s\'',
                    $this->getConfig()->getActionName('edit'),
                    $this->getConfig()->getActionName('view'),
                    $this->getConfig()->getActionName('del'),
                    $this->getConfig()->getActionName('add'),
                    $this->getConfig()->getActionName('list'))
                ).PHP_EOL;
            }

            $b .= $this->getIndent(9).trim('        	    ),').PHP_EOL;
            $b .= $this->getIndent(8).trim('        	),').PHP_EOL;
            $b .= $this->getIndent(8).trim('        	\'may_terminate\' => true,').PHP_EOL;
            $b .= $this->getIndent(7).trim('        ),').PHP_EOL;
            $b .= $this->getIndent(6).trim("    ),").PHP_EOL;
            $b .= $this->getIndent(5).trim("),").PHP_EOL;

        }

        $table_class = 'Index';
        $table_link  = $this->str('url',$this->getFileName($this->str('class',$this->getModule())));
        $action = 'index';
        $b .= $this->getIndent(4).trim("    ),").PHP_EOL;
        $b .= $this->getIndent(3).trim("),").PHP_EOL;

        $b .= $this->getIndent(2).trim("    ),").PHP_EOL;
        $b .= $this->getIndent(1).trim("),").PHP_EOL;

        return $b;
    }

}
