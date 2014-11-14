<?php

namespace Gear\Model;
use Zend\Db\Adapter\Adapter;

class ControllerGear extends MakeGear
{

    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/src/'.$this->getModule().'/Controller';
    }

    public function generate()
    {
        $entities = $this->getConfig()->getTables();
        if (is_array($entities) && count($entities)>0) {

            foreach ($entities as  $table) {
                //echo 'Iniciando criação do '.$this->str('label',$this->getFileName($table)).'Controller '."\n";
                $this->createController($table, array('crud'));
            }
        } else {
            return false;
        }
    }

    /**
     * Creates a single Controller
     */
    public function createController($table,$action)
    {
        $module = $this->getModule();
        $buffer = '';
        $buffer .= $this->getNamespace($module.'\Controller');
        $buffer .= $this->getUse($table);
        $buffer .= $this->getClass($this->getFileName($this->str('class',$table)));

        foreach ($action as $action) {
            switch ($action) {
                case 'crud':
                    $buffer .= $this->getAddMethod($table);
                    $buffer .= $this->getEditMethod($module,$table);
                    $buffer .= $this->getListMethod($table);
                    $buffer .= $this->getDelMethod($table);
                    $buffer .= $this->getViewMethod($table);

                    if ($this->checkImage($table)) {
                        $buffer .= $this->getImageMethod($module,$table);
                    }

                    //$buffer .= $this->geReportMethod($module,$table);
                    break;

                case 'index':
                    $buffer .= $this->getIndexMethod();
                    break;

                default:

                    break;
            }
        }
        $buffer .= $this->getEndFile();
        $this->mkPHP($this->getFinalPath(), $this->getFileName($table).'Controller', $buffer);
    }

    public function createIndexController()
    {
        $controller = 'index';
        $action = array('index');

        return $this->createController($controller,$action);
    }

    public function getEntityManager()
    {
        $aaa= '';

        $aaa.= $this->getIndent(1).trim('/**').PHP_EOL;
        $aaa.= $this->getIndent(1).trim(' * @var Doctrine\ORM\EntityManager').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('*/').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('protected $entityManager;').PHP_EOL.PHP_EOL;

        $aaa.= $this->getIndent(1).trim('public function getEntityManager() ').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('{').PHP_EOL;
           $aaa.= $this->getIndent(2).trim('    if (null === $this->entityManager) {').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('        $this->entityManager = $this->getServiceLocator()->get(\'doctrine.entitymanager.orm_default\');').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    }').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    return $this->entityManager;').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        return $aaa;
    }

    public function getEntityById($module,$table,$new = true)
    {
        $aaa= '';
        $aaa.= $this->getIndent(2).trim('$id = $this->getEvent()->getRouteMatch()->getParam(\'id\');').PHP_EOL;
        $aaa.= ($new) ? $this->newProduct($table,2) : '';
        $aaa.= $this->getIndent(2).trim('if ($id)').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('{').PHP_EOL;

        $aaa.= $this->getIndent(3).trim('$'.$this->underlineToClass($table).' = $this->getEntityManager()->getRepository(\''.$this->toClass($module).'\Entity\\'.$this->underlineToClass($table).'\')->find($id);').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('}').PHP_EOL;
        $aaa.= PHP_EOL;

        return $aaa;
    }

    public function newProduct($table,$indent = 1)
    {
        return $this->getIndent($indent).trim('$'.$this->underlineToClass($table).' = new '.$this->underlineToClass($table).'();').PHP_EOL.PHP_EOL;
    }

    public function getFormHydrator($module,$table)
    {
        $aaa= '';
        $aaa.= $this->getIndent(2).trim('$form = new '.$this->underlineToClass($table).'Form($this->getEntityManager());').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('$form->setHydrator(new DoctrineEntity($this->getEntityManager(),\''.$this->controllerToClass($module).'\Entity\\'.$this->underlineToClass($table).'\'));').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('$form->bind($'.$this->underlineToClass($table).');').PHP_EOL;
        $aaa.= PHP_EOL;

        return $aaa;
    }

    public function getToRoute($table,$indent = 4)
    {
        return $this->getIndent($indent).trim('return $this->redirect()->toRoute(\''.$this->controllerToCode($table).'\');').PHP_EOL;
    }

    public function getImageMethod()
    {
        $aaa = PHP_EOL;
        $aaa.= $this->powerLine(1,'public function %sAction()',array($this->getConfig()->getActionName('image')));
        $aaa.= $this->powerLine(1,'{');

        $aaa.= $this->powerLine(2,'$headLink = $this->getServiceLocator()->get(\'viewhelpermanager\')->get(\'headLink\');');
        $aaa.= $this->powerLine(2,'$headLink->appendStylesheet(\'http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css\');');
        $aaa.= $this->powerLine(2,'$headLink->appendStylesheet(\'/jQueryFileUpload/css/style.css\');');
        $aaa.= $this->powerLine(2,'$headLink->appendStylesheet(\'/jQueryFileUpload/css/jquery.fileupload.css\');');
        $aaa.= $this->powerLine(2,'$headLink->appendStylesheet(\'/jQueryFileUpload/css/jquery.fileupload-ui.css\');',array(),true);

        $aaa.= $this->powerLine(2,'$headScript = $this->getServiceLocator()->get(\'viewhelpermanager\')->get(\'headScript\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/vendor/jquery.ui.widget.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/jquery.iframe-transport.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/jquery.fileupload.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/jquery.fileupload-process.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/jquery.fileupload-image.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/jquery.fileupload-validate.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/jquery.fileupload-ui.js\');');
        $aaa.= $this->powerLine(2,'$headScript->appendFile(\'/jQueryFileUpload/js/main.js\');',array(),true);

        $aaa.= $this->powerLine(2,'return new ViewModel(');
        $aaa.= $this->powerLine(3,'    array()');
        $aaa.= $this->powerLine(2,');');

        $aaa.= $this->powerLine(1,'}',true);

        return $aaa;
    }

    public function getViewMethod($table)
    {
        $entity = $this->str('var',$this->getFileName($table));
        $class = $this->str('class',$this->getFileName($table));

        $tableLine = $this->str('uline',$this->getFileName($this->str('class',$table)));
        $tableUrl = $this->str('url',$this->getFileName($this->str('class',$table)));

        $aaa = $this->getIndent(1).trim('public function '.$this->getConfig()->getActionName('view').'Action()').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('{').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    $'.$entity.' = $this->getServiceLocator()->get(\'logic_'.$tableLine.'\');').PHP_EOL.PHP_EOL;

        $aaa.= $this->getIndent(2).trim('    $id'.$class.' = $this->params()->fromRoute(\'id\')     ? (int) $this->params()->fromRoute(\'id\') : null;').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    if (!$id'.$class.') {').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('        return $this->redirect()->toRoute(\''.$this->str('url',$this->getModule()).'/'.$tableUrl.'/list\');').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    }').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    $view = $'.$entity.'->selectById($id'.$class.');').PHP_EOL.PHP_EOL;

        $aaa.= $this->getIndent(2).trim('    if (!$view) {').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('        return $this->redirect()->toRoute(\''.$this->str('url',$this->getModule()).'/'.$tableUrl.'/list\');').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    }').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    return new ViewModel(').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('array(').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('            \'data\' => $view').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('        )').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('    );').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('}').PHP_EOL;

        return $aaa;

    }


    public function getListMethod($table)
    {

        $tableClass = $this->getFileName($this->str('class',$table));
        $tableVar = $this->str('var',$table);
        $tableLine = $this->str('uline',$this->getFileName($this->str('class',$table)));

        $aaa = $this->getIndent(1).trim('/**').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('  * @SuppressWarnings(PHPMD.NPathComplexity)').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('  */').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('public function '.$this->getConfig()->getActionName('list').'Action()').PHP_EOL;
        $aaa.= $this->getIndent(1).trim('{').PHP_EOL;

        $aaa.= $this->getIndent(2).trim('$this->session()->detachSession(\''.$tableClass.'\');').PHP_EOL;

        $aaa.= $this->getIndent(2).trim('$'.$tableVar.'Entity = $this->getServiceLocator()->get(\'logic_'.$tableLine.'\');').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('$formSearch = $this->getServiceLocator()->get(\'form_search_'.$tableLine.'\');').PHP_EOL.PHP_EOL;

        $aaa.= $this->powerLine(2,'$session = new \Zend\Session\Container(\'criteria\');',array($tableClass,$tableVar));

        $aaa.= $this->getIndent(2).trim('$orderBy = $this->params()->fromRoute(\'order_by\') ? $this->params()->fromRoute(\'order_by\') : \'id'.$tableClass.'\';').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('$order    = $this->params()->fromRoute(\'order\')    ? $this->params()->fromRoute(\'order\') : \'asc\';').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('$page     = $this->params()->fromRoute(\'page\')     ? (int) $this->params()->fromRoute(\'page\') : 1;').PHP_EOL.PHP_EOL;

        $aaa.= $this->getIndent(2).trim('$request = $this->getRequest();').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('if ($request->isPost()) {').PHP_EOL.PHP_EOL;

        $aaa.= $this->getIndent(3).trim('    $post = $request->getPost();').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('    $formSearch->setData($post);').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('    $criteria = $this->criteria()->setWhereCriteria($post);').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('    $query = $'.$tableVar.'Entity->selectAll(').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('       array(').PHP_EOL;
        $aaa.= $this->getIndent(5).trim('           \'where\' => $criteria,').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        )').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('    );').PHP_EOL;

        $aaa.= $this->powerLine(3,'$session->%s = $this->criteria()->serialize($post);',array($tableVar));
        $aaa.= $this->getIndent(3).trim('    $adapter = new \DoctrineORMModule\Paginator\Adapter\DoctrinePaginator(new ORMPaginator($query));').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('    $paginator = new Paginator($adapter);').PHP_EOL;

        $aaa.= $this->getIndent(2).trim('} else {').PHP_EOL.PHP_EOL;

        $aaa.= $this->powerLine(3,'if (isset($session->%s)) {',array($tableVar));

        $aaa.= $this->powerLine(4,'        $whereCriteria = $this->criteria()->unserialize($session->%s);',array($tableVar));

        $aaa.= $this->getIndent(4).trim('if ($whereCriteria) {').PHP_EOL;
        $aaa.= $this->getIndent(5).trim('    $formSearch->setData($whereCriteria);').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('}').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('$criteria = $this->criteria()->setWhereCriteria($whereCriteria);').PHP_EOL;
        $aaa.= $this->powerLine(3,'} else {');
        $aaa.= $this->powerLine(4,'$criteria = array();');
        $aaa.= $this->powerLine(3,'}',array(),true);

        $aaa.= $this->getIndent(3).trim('        $query = $'.$tableVar.'Entity->selectAll(').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('            array(').PHP_EOL;
        $aaa.= $this->getIndent(5).trim('                \'where\' => $criteria,').PHP_EOL;
        $aaa.= $this->getIndent(5).trim('                \'order\' => $this->criteria()->getOrderCriteria($orderBy, $order),').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('            )').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('        );').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('        $adapter = new \DoctrineORMModule\Paginator\Adapter\DoctrinePaginator(new ORMPaginator($query));').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('        $paginator = new Paginator($adapter);').PHP_EOL;
        //$aaa.= $this->getIndent(4).trim('        $this->getServiceLocator()->get(\'memcached\')->setItem(\''.$tableVar.'Paginator\',$paginator);').PHP_EOL;
        //$aaa.= $this->getIndent(4).trim('        $this->getServiceLocator()->get(\'memcached\')->setItem(\''.$tableVar.'order_by\',$orderBy);').PHP_EOL;
        //$aaa.= $this->getIndent(4).trim('        $this->getServiceLocator()->get(\'memcached\')->setItem(\''.$tableVar.'order\',$order);').PHP_EOL.PHP_EOL;
        //$aaa.= $this->getIndent(3).trim('    }').PHP_EOL.PHP_EOL;

        $aaa.= $this->getIndent(2).trim('}').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('$paginator->setDefaultItemCountPerPage($this->criteria()->getLimit());').PHP_EOL;
        $aaa.= $this->getIndent(2).trim('$paginator->setCurrentPageNumber($page);').PHP_EOL.PHP_EOL;

        $aaa.= $this->getIndent(2).trim('return new ViewModel(').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('array(').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        \'paginator\' => $paginator,').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        \'form\'      => $formSearch,').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        \'order_by\'  => $orderBy,').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        \'order\'     => $order,').PHP_EOL;
        $aaa.= $this->getIndent(4).trim('        \'page\'      => $page').PHP_EOL;
        $aaa.= $this->getIndent(3).trim('    )').PHP_EOL;
        $aaa.= $this->getIndent(2).trim(');').PHP_EOL;

        $aaa.= $this->getIndent(1).trim('}').PHP_EOL.PHP_EOL;

        return $aaa;
    }


    public function getUse($table)
    {

        $module = $this->getModule();
        $tableName = $this->getFileName($this->str('class',$table));

        $buffer = '';
        $buffer .= 'use Zend\Mvc\Controller\AbstractActionController;'.PHP_EOL;
        $buffer .= 'use Zend\View\Model\ViewModel;'.PHP_EOL;
        $buffer .= 'use Zend\Db\Sql\Sql;'.PHP_EOL;
        $buffer .= 'use Zend\Form\Form;'.PHP_EOL;
        $buffer .= 'use Zend\Paginator\Paginator;'.PHP_EOL;
        $buffer .= 'use Doctrine\ORM\EntityManager;'.PHP_EOL;
        $buffer .= 'use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;'.PHP_EOL;
        $buffer .= 'use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;'.PHP_EOL;
        $buffer .= 'use '.$module.'\Form\\'.$tableName.'Form;'.PHP_EOL;
        $buffer .= 'use '.$module.'\Filter\\'.$tableName.'Filter;'.PHP_EOL;
        $buffer .= 'use '.$module.'\Entity\\'.$this->str('class',$table).';'.PHP_EOL;

        $buffer .= PHP_EOL;

        return $buffer;
    }

    public function getClass($tableName)
    {
        $buffer = '';
        $buffer .= 'class '.$tableName.'Controller extends AbstractActionController'.PHP_EOL;
        $buffer .= '{'.PHP_EOL;

        return $buffer;
    }

}
