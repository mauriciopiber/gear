<?php
namespace Gear\Model;
use Zend\Db\Adapter\Adapter;


/**
 * @author piber
 * Classe responsável por gerar a estrutura inicial do módulo, e suas subpastas.
 */
class BootstrapGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }
    /**
     *
     * @param string $table_body Corpo da Tabela que será criada, provavelmente um partialLoop.
     * @param number $indent identação mínima
     * @return string Tabela HTML Completa
     */
    public function putTable($table_body,$indent=0)
    {

        $b  = $this->getIndent($indent).trim('<div class="row table-list">').PHP_EOL;
        $b .= $this->getIndent($indent+1).trim('    <div class="col-lg-12">').PHP_EOL;
        $b .= $this->getIndent($indent+2).trim('        <table class="table table-hover table-bordered">').PHP_EOL;
        $b .= $table_body;
        $b .= $this->getIndent($indent+2).trim('        </table>').PHP_EOL;
        $b .= $this->getIndent($indent+1).trim('    </div>').PHP_EOL;
        $b .= $this->getIndent($indent).trim('</div>').PHP_EOL;

        return $b;
    }

    /**
     * @param Table Columns $columns Tabelas do banco de dados
     * @param number $indent identação mínima
     * @return string Head da Tabela HTML
     */
    public function getTableHead($table,$columns,$indent = 2)
    {

        $url = $this->str('url',$this->getFileName($this->str('class',$table)));

        $b = '';
        $b .= $this->getIndent($indent+1).'<thead>'.PHP_EOL;
        $b .= $this->getIndent($indent+2).'<tr>'.PHP_EOL;
//var_dump($columns);die();
        foreach($columns as $i => $v)
        {
            //var_dump($v);
            if($v->dataType=='text' || in_array($this->str('class',$v->name),array('Created','Updated'))) {
                continue;
            }
            $var = $this->str('var',$v->name);
            $label = $this->str('label',$v->name);

            $b .= $this->getIndent($indent+3).trim('<th>').PHP_EOL;
            $b .= $this->getIndent($indent+4).trim('    <a href="<?php echo $this->url(\''.$this->str('url',$this->getModule()).'/'.$url.'/list\', array(\'action\' => \''.$this->getConfig()->getActionName('list').'\',\'order_by\' => \''.$var.'\',\'order\' => $this->orderSearch($this->order),\'page\' => 1)); ?>">').PHP_EOL;
            $b .= $this->getIndent($indent+5).trim('    <?php echo $this->translate(\''.$label.'\'); ?>').PHP_EOL;
            $b .= $this->getIndent($indent+4).trim('    </a>').PHP_EOL;
            $b .= $this->getIndent($indent+4).trim('    <span class="glyphicon glyphicon-arrow-<?php echo $this->orderIcon(\''.$var.'\',$this->order_by,$this->order); ?>"></span>').PHP_EOL;
            $b .= $this->getIndent($indent+3).trim('</th>').PHP_EOL;
        }
        $b .= $this->getIndent($indent+3).'<th><?php echo $this->translate(\'Action\'); ?></th>'.PHP_EOL;
        $b .= $this->getIndent($indent+2).'</tr>'.PHP_EOL;
        $b .= $this->getIndent($indent+1).'</thead>'.PHP_EOL;

        return $b;
    }

    public function getTableBody($module_name,$table_name,$indent = 2)
    {
        $b = '';
        $b .= $this->getIndent($indent+1).'<tbody>'.PHP_EOL;
        $b .= $this->getIndent($indent+2).trim('<?php echo $this->partialLoop(\''.$this->controllerToUrl($module_name).'/'.$this->str('url',$this->getFileName($this->str('class',$table_name))).'/'.$this->getConfig()->getActionName('list').'-row.phtml\', $this->paginator); ?>').PHP_EOL;
        $b .= $this->getIndent($indent+1).'</tbody>'.PHP_EOL;
        return $b;
    }

    public function getTableFooter($indent)
    {
        $b = '';
        $b .= $this->getIndent($indent+1).'<tfoot>'.PHP_EOL;
        $b .= $this->getIndent($indent+1).'</tfoot>'.PHP_EOL;
        return $b;
    }

    public function getPaginator($table)
    {
        //var_dump($table);die();
        $b = $this->getIndent(0).trim(
            '<?php echo $this->paginationControl(
                       $this->paginator,
                       \'Sliding\',
                       \'application/paginator\',
                       array(
                           \'order_by\' => $this->order_by,
                           \'order\' => $this->order,
                           \'url_page\' => \''.$this->str('url',$this->getModule()).'/'.$this->str('url',$this->getFileName($this->str('class',$table))).'\',
                           \'action\' => \''.$this->getConfig()->getActionName('list').'\'
                       )
                   );
            ?>').PHP_EOL;
        $b .= $this->getIndent(0).trim('<?php echo $this->render(\'application/deleting\');?>').PHP_EOL;
        return $b;
    }
}