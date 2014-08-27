<?php

namespace Gear\Model;
use Zend\Db\Adapter\Adapter;
use Gear\Model\MakeGear;
use Gear\Model\Schema;


/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class ViewGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        $module = $this->getConfig()->getModule();
        return $this->getLocal().'/module/'.$module.'/view/'.$this->toUrl($module);
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if (is_array($entities) && count($entities)>0) {

            foreach ($entities as $table) {
                $this->createView($table);
            }
        } else {
            return false;
        }
    }

    public function createView($table)
    {
        $module = $this->getModule();
        $controllerPath = $this->str('url',$this->getFileName($this->str('class', $table)));
        $finalPath = $this->mkDir($this->getFinalPath().'/'.$controllerPath);
        //echo $finalPath;die();
        $this->initViewHtml($finalPath, $table, $module);
        return true;
    }


    public function initViewHtml($finalPath,$table,$module)
    {
        $this->mkHTML($finalPath,$this->getConfig()->getActionName('view'),$this->getViewHTML($table));
        $this->mkHTML($finalPath,$this->getConfig()->getActionName('list'),$this->getListHTML($module,$table));
        $this->mkHTML($finalPath,$this->getConfig()->getActionName('list').'-row',$this->getListRowHTML($table));

        $this->mkHTML($finalPath,$this->getConfig()->getActionName('add') ,$this->getAddHTML($module,$table));
        $this->mkHTML($finalPath,$this->getConfig()->getActionName('edit'),$this->getEditHTML($module,$table));

        if($this->checkImage($table)) {
            $this->mkHTML($finalPath,$this->getConfig()->getActionName('image') ,$this->getImagesHTML($module,$table));
        }
        //$this->mkHTML($finalPath,'del' ,'<div>del  '.$table.'</div>');
    }



    public function getImagesHtml()
    {
    	$aaa = $this->getIndent(0).trim('<div class="row">').PHP_EOL;
    	$aaa.= $this->getIndent(1).trim('    <div class="col-lg-12">').PHP_EOL;
    	$aaa.= $this->getIndent(2).trim('	    <?php echo $this->render(\'administrador/produto/template-form.phtml\');?>').PHP_EOL;
    	$aaa.= $this->getIndent(2).trim('	    <?php echo $this->render(\'administrador/produto/template-control.phtml\');?>').PHP_EOL;
    	$aaa.= $this->getIndent(2).trim('		<?php echo $this->render(\'administrador/produto/template-upload.phtml\');?>').PHP_EOL;
    	$aaa.= $this->getIndent(2).trim('	    <?php echo $this->render(\'administrador/produto/template-download.phtml\');?>').PHP_EOL;
    	$aaa.= $this->getIndent(1).trim('	</div>').PHP_EOL;
    	$aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;
    	return $aaa;
    }

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    public function createIndexView($modulePaths = null)
    {
        $controller = $this->str('url', 'index');

        $submodule = (isset($modulePaths->viewsubmodule) ? $modulePaths->viewsubmodule : $this->getFinalPath());

        $finalPath = $this->mkDir($submodule.'/'.$controller);
        //var_dump($this->getIndexHTML());die();
        $this->mkHTML($finalPath,'index', $this->getIndexHTML());
    }

    public function getIndexHTML()
    {
        $aaa= '';
        $aaa.= $this->getInitViewport($this->getModule(),'index');
        $aaa.= $this->getInitDivRowColumn(12);

        $aaa.= $this->getIndent(2).trim('<table class="table">').PHP_EOL;

        //$aaa.= $this->getIndent(3).trim('<li>').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('<tr>').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('<td>').PHP_EOL;

        $aaa.= $this->getIndent(4).trim('<a class="btn btn-primary" href="<?php echo $this->url(\''.$this->str('url',$this->getModule()).'\');?>">'
           .$this->str('label',$this->getModule()).'</a>').PHP_EOL;


        $aaa.= $this->getIndent(3).trim('</td>').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('</tr>').PHP_EOL;


        foreach($this->getConfig()->getTables() as $v) {

            $tableName = $this->getFileName($this->str('class',$v));
            $aaa.= $this->getIndent(3).trim('<tr>').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('<td>').PHP_EOL;
            $aaa.= $this->getIndent(5).trim('<span class="badge alert-success"><?php echo $this->'.$this->str('uline',$tableName).';?></span>').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('</td>').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('<td>').PHP_EOL;
            $aaa.= $this->getIndent(5).trim('<a class="btn btn-primary" href="<?php echo $this->url(\''.$this->str('url',$this->getModule()).'/'.$this->str('url',$tableName).'/all\',array(\'action\' => \''.$this->getConfig()->getActionName('list').'\'));?>">'.$this->str('label',$tableName).'</a>').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('</td>').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('<td>').PHP_EOL;
            $aaa.= $this->getIndent(5).trim('<a class="btn btn-primary" href="<?php echo $this->url(\''.$this->str('url',$this->getModule()).'/'.$this->str('url',$tableName).'/all\',array(\'action\' => \''.$this->getConfig()->getActionName('add').'\'));?>">Add '.$this->str('label',$tableName).'</a>').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('</td>').PHP_EOL;
            $aaa.= $this->getIndent(3).trim('</tr>').PHP_EOL;

        }

        $aaa.= $this->getIndent(2).trim('<ul>').PHP_EOL;






        $aaa.= $this->getEndViewport();

        return $aaa;
    }

    public function getInitDivRowColumn($lgg)
    {
        $aaa = $this->getIndent(0).trim('<div class="row">').PHP_EOL;
    	$aaa.= $this->getIndent(1).trim('<div class="col-lg-'.$lgg.'">').PHP_EOL;
    	return $aaa;
    }

    public function getInitViewport($module,$name)
    {
        $aaa= '';
        $aaa.= $this->getIndent(0).trim('<?php').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$title = \''.$this->str('label',$module).' '.$this->str('label',$name).'\';').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$this->headTitle($title);').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('?>').PHP_EOL;
        return $aaa;
    }

    public function getSetPartialLoop($indent = 0)
    {
        return PHP_EOL.$this->getIndent($indent+0).trim('<?php $this->partialLoop()->setObjectKey(\'object\');?>').PHP_EOL;
    }



    public function getEndViewport()
    {
        $aaa= '';
        $aaa.= $this->getIndent(1).trim('</div>').PHP_EOL;
        $aaa.= trim('</div>');
        return $aaa;
    }

    public function getBreadCrumb()
    {
    	//$aaa = $this->getIndent(0).trim('div class="row">').PHP_EOL;
    	$aaa = $this->getIndent(1).trim('<div class="col-lg-3">').PHP_EOL;
    	$aaa.= $this->getIndent(2).trim('    <div class="pull-left">').PHP_EOL;
    	$aaa.= $this->getIndent(3).trim('	    <?php').PHP_EOL;
    	$aaa.= $this->getIndent(4).trim('	        echo $this->navigation(\'navigation\')->breadcrumbs()->setMinDepth(0);').PHP_EOL;
    	$aaa.= $this->getIndent(3).trim('	    ?>').PHP_EOL;
    	$aaa.= $this->getIndent(2).trim('    </div>').PHP_EOL;
    	$aaa.= $this->getIndent(1).trim('</div>').PHP_EOL;
    	//$aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;


    	return $aaa;
    }

    public function getAddButton($table)
    {
        $aaa= '';
        $aaa.= $this->getIndent(0).trim('   <div class="row top-list">').PHP_EOL;

        $aaa.= $this->getBreadCrumb();

        $aaa.= $this->getIndent(1).trim('        <div class="col-lg-6 col-lg-offset-3">').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('            <a class="pull-right" href="<?php echo $this->url(\''.$this->str('url',$this->getModule()).'/'.$this->str('url',$this->getFileName($this->str('class',$table))).'/all\', array(\'action\' => \''.$this->getConfig()->getActionName('add').'\')); ?>">').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('                <button type="button" class="btn btn-success">').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('                    <span class="glyphicon glyphicon-plus"></span> <?php echo $this->translate(\'Add new\');?>&nbsp;<?php echo $this->translate(\''.$this->str('label',$table).'\');?>').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('                </button>').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('            </a>').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('        </div>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('    </div>').PHP_EOL;
        return $aaa;
    }

    public function getListHTML($module,$tableName)
    {
        $bootstrap = new \Gear\Model\BootstrapGear($this->getConfig());
        $schema = new Schema($this->getAdapter());

        $collumns = $schema->getColumnNames($tableName);

        $columns = $this->getColumns($tableName);

        $aaa= '';
        $aaa.= $this->getSetPartialLoop();

        $aaa.= $this->getInitViewport($module,$tableName);

        $aaa.= $this->getAddButton($tableName);

        $aaa.= $this->getSearchFilter($tableName,$collumns);


    	$table = $bootstrap->getTableHead($tableName,$columns);

    	$table .= $bootstrap->getTableBody($module,$tableName);

    	$table .= $bootstrap->getTableFooter(2);

    	$aaa.= $bootstrap->putTable($table);

    	$aaa.= $bootstrap->getPaginator($tableName);

    	return $aaa;
    }

    public function checkOpenNewDivRow($total,$reference)
    {
        if($reference%4==0 && $reference < $total)
        {
            $aaa= '';
            $aaa.= $this->getIndent(2).trim('</div>').PHP_EOL;
            $aaa.= $this->getIndent(2).trim('<div class="row">').PHP_EOL;
        } else {
            $aaa= '';
        }
        return $aaa;
    }

    public function getSearchFilter($table,$columns)
    {

        $tableLine = $this->str('uline',$table);
        $tableUrl = $this->str('url',$this->getModule()).'/'.$this->str('url',$this->getFileName($this->str('class',$table)));

        $aaa = '';

        $aaa.= $this->getIndent(0).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('    <div class="col-lg-1">').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('        <a href="#" class="filter-trigger">Filter</a>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('    </div>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;


        $aaa.= $this->getIndent(0).trim('<div class="row search-list">').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        <?php').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form = $this->form;').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form->setAttribute(\'action\', $this->url(\''.$tableUrl.'\', array(\'action\' => \''.$this->getConfig()->getActionName('list').'\')));').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form->prepare();').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form->setAttributes(array(\'id\' => \'searchForm\'));').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            echo $this->form()->openTag($form);').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        ?>').PHP_EOL;

        $columns = $this->getColumns($tableLine);

        $perLine = 4;
        $colLg  = 12/$perLine;
        $text = false;
        $processed = 0;
        $totalFk = 0;


        foreach ($columns as $i => $v) {
            if ($v->fk || ($v->pk == false && $v->dataType=='int')) {
                $totalFk += 1;
            }
        }

        $aaa.= $this->getIndent(2).trim('<div class="row">').PHP_EOL;


        //echo $totalFk;die();
        foreach($columns as $i => $v) {
            if (in_array($v->dataType,array('varchar', 'text'))) {
                $text = true;
            }

            $colVar = $this->str('var', $v->name);

            if ($v->fk) {
                $processed += 1;
        	    $aaa.= $this->getIndent(3).trim('<div class="col-lg-'.$colLg.'">').PHP_EOL;
        	    $aaa.= $this->getIndent(4).trim('    <div class="form-group">').PHP_EOL;
        	    $aaa.= $this->getIndent(5).trim('        <?php echo $this->formLabel($form->get(\''.$colVar.'\')); ?>').PHP_EOL;
        	    $aaa.= $this->getIndent(5).trim('        <?php echo $this->formSelect($form->get(\''.$colVar.'\')->setAttribute(\'class\',\'form-control custom\')); ?>').PHP_EOL;
        	    $aaa.= $this->getIndent(4).trim('    </div>').PHP_EOL;
        	    $aaa.= $this->getIndent(3).trim('</div>').PHP_EOL;

            } elseif ($v->dataType=='int' && $v->pk == false) {

                $processed += 1;

                $aaa.= $this->getIndent(3).trim('<div class="col-lg-'.$colLg.'">').PHP_EOL;
                $aaa.= $this->getIndent(4).trim('    <div class="form-group">').PHP_EOL;
                $aaa.= $this->getIndent(5).trim('        <?php echo $this->formRow($form->get(\''.$colVar.'From\')->setAttribute(\'class\',\'form-control numeric-just-positive\')); ?>').PHP_EOL;
                $aaa.= $this->getIndent(5).trim('        <?php echo $this->formRow($form->get(\''.$colVar.'To\')->setAttribute(\'class\',\'form-control numeric-just-positive\')); ?>').PHP_EOL;
                $aaa.= $this->getIndent(4).trim('    </div>').PHP_EOL;
                $aaa.= $this->getIndent(3).trim('</div>').PHP_EOL;

                $aaa.= $this->checkOpenNewDivRow($totalFk,$processed);

        	} elseif ($v->dataType=='decimal') {

        	    $processed += 1;

        	    $aaa.= $this->getIndent(3).trim('<div class="col-lg-'.$colLg.'">').PHP_EOL;
        	    $aaa.= $this->getIndent(4).trim('    <div class="form-group">').PHP_EOL;
        	    $aaa.= $this->getIndent(5).trim('        <?php echo $this->formRow($form->get(\''.$colVar.'From\')->setAttribute(\'class\',\'form-control maskMoney\')); ?>').PHP_EOL;
        	    $aaa.= $this->getIndent(5).trim('        <?php echo $this->formRow($form->get(\''.$colVar.'To\')->setAttribute(\'class\',\'form-control maskMoney\')); ?>').PHP_EOL;
        	    $aaa.= $this->getIndent(4).trim('    </div>').PHP_EOL;
        	    $aaa.= $this->getIndent(3).trim('</div>').PHP_EOL;

        	    $aaa.= $this->checkOpenNewDivRow($totalFk, $processed);

        	} elseif ($v->dataType=='datetime') {

        	} else {
        	    $aaa.= $this->checkOpenNewDivRow($totalFk, $processed);
        	}



        }

        if ($text) {
            $aaa.= $this->getIndent(3).trim('<div class="col-lg-'.$colLg.'">').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('        <div class="form-group">').PHP_EOL;
            $aaa.= $this->getIndent(5).trim('            <?php echo $this->formRow($form->get(\'like\')->setAttribute(\'class\',\'form-control\')); ?>').PHP_EOL;
            $aaa.= $this->getIndent(4).trim('        </div>').PHP_EOL;
            $aaa.= $this->getIndent(3).trim('</div>').PHP_EOL;
        }
        $aaa.= $this->getIndent(2).trim('</div>').PHP_EOL;

        $aaa.= $this->getIndent(2).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('<div class="col-lg-1">').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('         <div class="form-group">').PHP_EOL;
        $aaa.= $this->getIndent(5).trim('            <?php echo $this->formSubmit($form->get(\'submit\')->setAttribute(\'class\',\'btn btn-default\')); ?>').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        </div>').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('</div>').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('<div class="col-lg-1">').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        <button class="btn btn-default reset"><?php echo $this->translate(\'Reset\');?></button>').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('</div>').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('</div>').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('<?php echo $this->form()->closeTag(); ?>').PHP_EOL;

        $aaa.= $this->getIndent(1).trim('    </div>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;
        //echo $b;die();
        return $aaa;
    }


    public function getListRowHTML($name)
    {
        $schema = new Schema($this->getAdapter());
        $input  = new \Gear\Model\InputGear($this->getConfig());

        $collumns    = $schema->getColumns($name);
        $constraints = $schema->getConstraints($name);

        $aaa= $this->getIndent(0).'<tr>'.PHP_EOL;
        foreach ($collumns as  $v) {

        	$speciality = false;
            if ($v->getDataType()=='text' || in_array($v->getName(), array('created','updated'))) {
                continue;
            }
            /**
                Exceções do Engine_Teste.
             */
            $nameToClass = $this->str('class',$v->getName());

            if (preg_match('/^id_/',$v->getName())) {
                /*
                if($v->getName()=='id_lixeira') {
                    $method = '$this->object->get'.$nameToClass.'()';
                } else
                */
                if ($v->getName()!='id_'.$v->getTableName()) {

                    $constraint = $schema->hasConstraint($v->getName(),$constraints);
                    if ($constraint===false) {

                        $method = '($this->object->get'.$nameToClass.'()!==null) ? $this->escapeHtml($this->object->get'.$nameToClass.'()) : \'\'';

                    } else {

                        if ($constraint->getReferencedColumns()===$constraint->getColumns()) {

                            $property = $input->getProperty($constraint->getReferencedTableName());
                            $method = '($this->object->get'.$nameToClass.'()!==null) ? $this->escapeHtml($this->object->get'.$nameToClass.'()->get'.$property.'()) : \'\'';

                        } else {

                        	$property = $input->getProperty($constraint->getReferencedTableName());

                        	$subclass = $this->str('class',$property);


                            $method = '($this->object->get'.$nameToClass.'()!==null) ? $this->escapeHtml($this->object->get'.$nameToClass.'()->get'.$subclass.'()) : \'\'';
                        }

                    }
                } else {
                    $method = '$this->escapeHtml($this->object->get'.$nameToClass.'())';
                }
            } elseif ($v->getDataType()=='datetime' || $v->getDataType()=='timestamp' || $v->getDataType()=='date') {
                $method = '($this->object->get'.$nameToClass.'()!==null) ? $this->escapeHtml($this->object->get'.$nameToClass.'()->format(\'d-m-Y H:i:s\')) : \'\'';
            } else {

            	//$managerGear = new \Gear\Model\ManagerGear($this->getConfig());
            	$speciality = '';
            	//$managerGear->getSpeciality($this->str('class',$name),$this->str('class',$v->getName()));

            	/**
            	 * @todo
            	 */
            	switch ($speciality) {
            		case 'Simple-Image':
                        $method = '<img src="<?php echo $this->object->get'.$nameToClass.'()?>"/>';
            			break;
            		case 'default':
            		default:
            			$method = '$this->escapeHtml($this->object->get'.$nameToClass.'())';
            	}
            }
            if ($speciality == false || $speciality == 'default') {
            	$aaa.= $this->getIndent(1).'<td><?php echo '.$method.';?></td>'.PHP_EOL;
            } else {
            	$aaa.= $this->getIndent(1).'<td>'.$method.'</td>'.PHP_EOL;
            }
            $speciality = false;
        }
        $primaryKey = $schema->hasConstraint(null, $constraints,'PRIMARY KEY');

        if (!isset($primaryKey) || $primaryKey==null) {
            $aaa.= $this->getIndent(1).'<td>'.PHP_EOL;
            $aaa.= $this->getIndent(1).'</td>'.PHP_EOL;
            $aaa.= $this->getIndent(1).'<td>'.PHP_EOL;
            $aaa.= $this->getIndent(1).'</td>'.PHP_EOL;
        } else {
            $column = $primaryKey->getColumns();
            //var_dump($column);
            $key = $this->underlineToClass(array_pop($column));
            $method = '$this->object->get'.$key.'()';
            $tempName = $this->getFileName($name);
            $aaa.= $this->getIndent(1).trim('    <td>').PHP_EOL;

            $aaa.= $this->getViewAction($tempName);
            $aaa.= $this->getEditAction($tempName);
            $aaa.= $this->getDelAction($tempName);
        }
        $aaa.=  $this->getIndent(0).'</tr>'.PHP_EOL;
        return $aaa;
    	//return '1';
    }

    public function getEditAction($tempName)
    {
        $aaa= '';
        $aaa.= $this->powerLine(2,'<a href="<?php echo $this->url(\'%s/%s/all\', array(\'action\' => \'%s\', \'id\' => $this->object->getId%s())); ?>">',
            array($this->str('url', $this->getModule()), $this->str('url', $tempName),$this->getConfig()->getActionName('edit'), $this->str('class', $tempName)));

        $aaa.= $this->powerLine(3,'                <span class="glyphicon glyphicon-pencil"></span>');
        $aaa.= $this->powerLine(2,' </a>');

        return $aaa;
    }

    public function getViewAction($tempName)
    {
        $aaa= '';
        $aaa.= $this->powerLine(2,'<a href="<?php echo $this->url(\'%s/%s/all\', array(\'action\' => \'%s\', \'id\' => $this->object->getId%s())); ?>">',
            array($this->str('url',$this->getModule()),$this->str('url',$tempName),$this->getConfig()->getActionName('view'),$this->str('class',$tempName)));

        $aaa.= $this->powerLine(3,'                <span class="glyphicon glyphicon-eye-open"></span>');
        $aaa.= $this->powerLine(2,' </a>');

        return $aaa;
    }

    public function getDelAction($tempName)
    {
        $aaa= '';
        $aaa.= $this->powerLine(2,'        <form method="POST" action="<?php echo $this->url(\'%s/%s/all\', array(\'action\' => \'%s\', \'id\' => $this->object->getId%s())); ?>" accept-charset="UTF-8" style="display:inline">',array($this->str('url',$this->getModule()),$this->str('url',$tempName),$this->getConfig()->getActionName('del'),$this->str('class',$tempName))).PHP_EOL;
        $aaa.= $this->powerLine(3,'             <a data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo $this->translate(\'Delete '.$this->str('label',$tempName).'\');?>" data-message="<?php echo $this->translate(\'Are you sure you want to delete this '.$this->str('label',$tempName).'?\')?>">').PHP_EOL;
        $aaa.= $this->powerLine(4,'                <span class="glyphicon glyphicon-trash"></span>').PHP_EOL;
        $aaa.= $this->powerLine(3,'            </a>').PHP_EOL;
        $aaa.= $this->powerLine(2,'        </form>').PHP_EOL;

        return $aaa;
    }

    public function getActionButtons()
    {

    }

    public function getAddHTML($module,$name)
    {
        $aaa= '';
        $aaa.= $this->getIndent(0).trim('<?php').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$title = \''.$this->str('label', $module).'- Add '.$this->str('label', $name).'\';').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$this->headTitle($title);').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('?>').PHP_EOL;

        $aaa.= $this->getIndent(0).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getBreadCrumb();
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;

        if ($this->checkImage($name)) {
            $aaa.= $this->getImageLink($name);
        }
        $aaa.= $this->getIndent(0).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        <?php').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form = $this->form;').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form->setAttribute(\'action\', $this->url(\''.$this->str('url',$this->getModule()).'/'.$this->str('url',$this->getFileName($this->str('class',$name))).'/all\', array(\'action\' => \''.$this->getConfig()->getActionName('add').'\')));').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form->prepare();').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            echo $this->form()->openTag($form);').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        ?>').PHP_EOL;
        $aaa.= $this->makeFields($this->getColumns($this->str('uline', $name)),'add');
        $aaa.= $this->getIndent(2).trim('        <div class="form-group">').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            <?php echo $this->formSubmit($form->get(\'submit\')->setAttribute(\'class\',\'btn btn-default\')); ?>').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            <a class="btn btn-default reset" href="<?php echo $this->url(\''.$this->str('url',$this->getConfig()->getModule()).'/'.$this->str('url',$name).'/list\');?>">Voltar</a>').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        </div>').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        <?php echo $this->form()->closeTag(); ?>').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('    </div>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;

        return $aaa;
    }

    public function getViewHTML($table)
    {
    	$schema = new \Gear\Model\Schema($this->getConfig()->getDriver());
        $module = $this->getModule();

        $columns = $this->getColumns($table);

        $constraints = $schema->getConstraints($this->str('uline',$table));

        $aaa = $this->getIndent(0).trim('<?php').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$title = \''.$this->str('label',$module).'- Add '.$this->str('label',$table).'\';').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$this->headTitle($title);').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('?>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getBreadCrumb();
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    <div class="panel panel-default">').PHP_EOL;

        foreach ($columns as  $v) {
            $aaa.= $this->getIndent(3).trim('<div class="panel-body">').PHP_EOL;

            if (preg_match('/^Id/', $v->name)) {
            	$constraint = $schema->hasConstraint($this->str('uline', $v->name),$constraints);
            	if ($constraint===false) {
            		$aaa.= $this->getIndent(4).trim($this->str('label', $v->name).': <?php echo $this->escapeHtml($this->data->get'.$this->str('class', $v->name).'());?>').PHP_EOL;
            	} else {
            		$aaa.= $this->getIndent(4).trim($this->str('label', $v->name).':
            				<?php echo $this->escapeHtml($this->data->get'.$this->str('class', $v->name).'()->get'.$this->str('class', $v->name).'());?>').PHP_EOL;
            	}
            } elseif($v->dataType == 'datetime' || $v->dataType == 'timestamp' || $v->dataType == 'date') {

            	$aaa.= $this->getIndent(4).trim($this->str('label', $v->name).': <?php echo ($this->data->get'.$this->str('class', $v->name).'() != null) ? $this->escapeHtml($this->data->get'.$this->str('class', $v->name).'()->format(\'d-m-Y H:i:s\')) : $this->translate(\'Not Updated Yet\');?>').PHP_EOL;
            	//$method = '($this->data->get'.$nameToClass.'()!==null) ? $this->data->get'.$nameToClass.'()->format(\'d-m-Y H:i:s\') : \'\'';
            } else {


            	$aaa.= $this->getIndent(4).trim($this->str('label', $v->name).': <?php echo $this->escapeHtml($this->data->get'.$this->str('class', $v->name).'());?>').PHP_EOL;
            	//$method = '$this->data->get'.$nameToClass.'()';
            }


            $aaa.= $this->getIndent(3).trim(' </div>').PHP_EOL;
        }

        $aaa.= $this->getIndent(2).trim('    </div>').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('    </div>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;

        return $aaa;

    }

    public function getImageLink($table)
    {
    	$aaa = $this->getIndent(0).trim('<div class="row">').PHP_EOL;
    	$aaa.= $this->getIndent(1).trim('    <div class="col-lg-1 col-lg-offset-11">').PHP_EOL;
    	$aaa.= $this->getIndent(2).trim('        <a href="<?php echo $this->url(\''.$this->str('url',$this->getModule()).'/'.$this->str('url',$table).'/all\',array(\'action\' => \''.$this->getConfig()->getActionName('image').'\'));?>">Imagens</a>').PHP_EOL;
    	$aaa.= $this->getIndent(1).trim('    </div>').PHP_EOL;
    	$aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;
    	return $aaa;
    }



    public function getEditHTML($module,$name)
    {
        $aaa= '';
        $aaa.= $this->getIndent(0).trim('<?php').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$title = \''.$this->str('label',$module).'- Edit '.$this->str('label',$name).'\';').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('$this->headTitle($title);').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('?>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getBreadCrumb();
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;
        if ($this->checkImage($name)) {
            $aaa.= $this->getImageLink($name);
        }
        $aaa.= $this->getIndent(0).trim('<div class="row">').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        <?php').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form = $this->form;').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form->setAttribute(\'action\', $this->url(\''.$this->str('url',$this->getModule()).'/'.$this->str('url',$this->getFileName($this->str('class',$name))).'/all\', array(\'action\' => \''.$this->getConfig()->getActionName('edit').'\',\'id\' => $this->id'.$this->str('class',$name).')));').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            $form->prepare();').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            echo $this->form()->openTag($form);').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        ?>').PHP_EOL;
        $aaa.= $this->makeFields($this->getColumns($this->str('uline',$name)),'edit');
        $aaa.= $this->getIndent(2).trim('        <div class="form-group">').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            <?php echo $this->formSubmit($form->get(\'submit\')->setAttribute(\'class\',\'btn btn-default\')); ?>').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('            <a class="btn btn-default reset" href="<?php echo $this->url(\''.$this->str('url',$this->getConfig()->getModule()).'/'.$this->str('url',$name).'/list\');?>">Voltar</a>').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        </div>').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('        <?php echo $this->form()->closeTag(); ?>').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('    </div>').PHP_EOL;
        $aaa.= $this->getIndent(0).trim('</div>').PHP_EOL;
        return $aaa;
    }

    public function makeFields($columns, $method = 'add')
    {

        $aaa= '';
        foreach ($columns as $v) {

            $var = $this->str('var',$v->name);

            if ($v->dataType=='int' && $v->fk)
            {
                $aaa.= $this->getIndent(2).trim('        <div class="form-group">').PHP_EOL;
                $aaa.= $this->getIndent(3).trim('            <?php echo $this->formLabel($form->get(\''.$var.'\')); ?>').PHP_EOL;
                $aaa.= $this->getIndent(3).trim('            <?php echo $this->formSelect($form->get(\''.$var.'\')->setAttribute(\'class\',\'form-control\')); ?>').PHP_EOL;
                $aaa.= $this->getIndent(3).trim('            <?php echo $this->formelementerrors($form->get(\''.$var.'\')); ?>').PHP_EOL;
                $aaa.= $this->getIndent(2).trim('        </div>').PHP_EOL;

            } elseif ($v->dataType=='varchar' || $v->dataType=='text' || $v->dataType=='longtext' || ($v->dataType=='int' && !$v->pk && !$v->fk)) {

                $aaa.= $this->getIndent(2).trim('        <div class="form-group">').PHP_EOL;
                $aaa.= $this->getIndent(3).trim('            <?php echo $this->formRow($form->get(\''.$var.'\')->setAttribute(\'class\',\'form-control\')); ?>').PHP_EOL;
                $aaa.= $this->getIndent(2).trim('        </div>').PHP_EOL;

                /**
                 * @TODO
                 */
            } elseif ($v->pk && $method == 'edit') {

                $aaa.= $this->getIndent(3).trim('            <?php echo $this->formHidden($form->get(\''.$var.'\')->setAttribute(\'class\',\'form-control\')); ?>').PHP_EOL;
            } elseif ($v->dataType=='datetime' || $v->dataType=='date') {

                if (!in_array($var,array('created','updated'))) {

                    $aaa.= $this->getIndent(2).trim('        <div class="form-group">').PHP_EOL;
                    $aaa.= $this->getIndent(3).trim('            <?php echo $this->formRow($form->get(\''.$var.'\')->setAttribute(\'class\',\'form-control datepicker\')); ?>').PHP_EOL;
                    $aaa.= $this->getIndent(2).trim('        </div>').PHP_EOL;
                }
            } elseif ($v->dataType == 'decimal') {
                $aaa.= $this->getIndent(2).trim('        <div class="form-group">').PHP_EOL;
                $aaa.= $this->getIndent(3).trim('            <?php echo $this->formRow($form->get(\''.$var.'\')->setAttribute(\'class\',\'form-control maskMoney\')); ?>').PHP_EOL;
                $aaa.= $this->getIndent(2).trim('        </div>').PHP_EOL;
            }

        }

        return $aaa;
    }



    public function createModuleView($module,$tables,$basePath)
    {
        //criar pasta
        foreach($tables as $v)
        {
        	$controllerPath = $this->underlineToUrl($v);

        	$finalPath = $this->mkDir($basePath.'/'.$controllerPath);

        	$this->initViewHtml($finalPath,$v,$module);
        }
        //criar 4 arquivos.
        return true;
    }

}