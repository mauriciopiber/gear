<?php
namespace Gear\Service\Mvc;

use Gear\Service\AbstractJsonService;

class ViewService extends AbstractJsonService
{
    protected $timeTest;

    protected $location;

    public function copyBasicLayout()
    {
        $source = __DIR__.'/../../Template/Layout/sb-admin-2';
        $dest   = $this->getModule()->getPublicFolder().'/sb-admin-2';
        return $this->getDirService()->xcopy(
            $source,
            $dest
        );
    }

    public function getTableBody($db)
    {

        $columns = $db->getTableColumns();

        $text = '';
        foreach ($columns as $i => $v) {

            $text .= '            <td>'.PHP_EOL;

            if ($db->isForeignKey($v)) {
                $text .= sprintf('                <?php echo $this->escapeHtml($this->object->get%s()->getNome()); ?>', $this->str('class', $v->getName())).PHP_EOL;
            } else {
                $text .= sprintf('                <?php echo $this->escapeHtml($this->object->get%s()); ?>', $this->str('class', $v->getName())).PHP_EOL;
            }

            $text .= '            </td>'.PHP_EOL;
        }
        return $text;
    }

    public function getTableHead($columns)
    {
        $text = '        <tr>'.PHP_EOL;
        foreach ($columns as $i => $v) {
            $text .= '            <td>'.PHP_EOL;
            $text .= '                '.$this->str('label', $v->getName()).PHP_EOL;
            $text .= '            </td>'.PHP_EOL;
        }
        $text .= '        </tr>'.PHP_EOL;
        return $text;
    }

    public function getFormElements($action)
    {
        $db = $action->getDb()->getTableColumns();
        $primary = $action->getDb()->getPrimaryKeyColumnName();
        $names = [***REMOVED***;

        foreach ($db as $i => $v) {
            if ($v->getName() != $primary) {

              /*   switch ($v->getDataType()) {
                	case 'varchar':
                	    $type = 'text';

                } */

                $idName = $this->str('var', $v->getName());
                if (strlen($idName) > 18) {
                    $var = substr($idName, 0, 15);
                } else {
                    $var = $idName;
                }
                $names[***REMOVED*** = array('name' => $idName, 'var' => $var);
            }
        }
        return $names;
    }

    public function createActionAdd($action)
    {
        $this->createFileFromTemplate(
            'template/view/add.table.phtml',
            array(
                'elements' => $this->getFormElements($action),
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'action' => $this->str('class', $action->getName()),
                'class' => $this->str('class', $action->getController()->getNameOff()),
                'route' =>  sprintf('%s/%s/create', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeBack' =>  sprintf('%s/%s/list', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
            ),
            'create.phtml',
            $this->getLocation()
        );
    }

    public function createActionEdit($action)
    {
        $this->createFileFromTemplate(
            'template/view/edit.table.phtml',
            array(
                'elements' => $this->getFormElements($action),
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'action' => $this->str('class', $action->getName()),
                'class' => $this->str('class', $action->getController()->getNameOff()),
                'route' =>  sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'routeBack' =>  sprintf('%s/%s/list', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
            ),
            'edit.phtml',
            $this->getLocation()
        );
    }



    public function createActionList($action)
    {
        $tableHead = $this->getTableHead($action->getDb()->getTableColumns());

        $tableBody = $this->getTableBody($action->getDb());



        $this->createFileFromTemplate(
            'template/view/list.table.phtml',
            array(
                'label' => $this->str('label', $action->getController()->getNameOff()),
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'action' => $this->str('class', $action->getName()),
                'tableHead' => $tableHead,
                'controllerViewFolder' => sprintf('%s/%s', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff()))
            ),
            'list.phtml',
            $this->getLocation()
        );

        $this->createFileFromTemplate(
            'template/view/list-row.table.phtml',
            array(
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $action->getController()->getName()),
                'action' => $this->str('class', $action->getName()),
                'tableBody' => $tableBody,
                'routeEdit' => sprintf('%s/%s/edit', $this->str('url', $this->getConfig()->getModule()), $this->str('url', $action->getController()->getNameOff())),
                'getId' => $this->str('class', $action->getDb()->getPrimaryKeyColumnName()),
                'classLabel' => $this->str('label', str_replace('Controller', '', $action->getController()->getName())),
            ),
            'row.phtml',
            $this->getLocation()
        );
    }

    public function createDirectoryFromIntrospect($controller)
    {
        $controllerDir = sprintf(
            '%s/module/%s/view/%s/%s',
            $this->getConfig()->getLocal(),
            $this->getConfig()->getModule(),
            $this->str('url', $this->getConfig()->getModule()),
            $this->str('url', str_replace('Controller', '',$controller->getName()))
        );

        if (!is_dir($controllerDir)) {
            $this->getDirService()->mkDir($controllerDir);
        }
        $this->setLocation($controllerDir);


        return $controllerDir;
    }

    public function introspectFromTable($table)
    {
        $controller = $this->getGearSchema()->getControllerByDb($table);

        $this->createDirectoryFromIntrospect($controller);

        foreach ($controller->getAction() as $action) {
            $action->setController($controller);
            $action->setDb($table);

            switch($action->getName()) {
            	case 'List':
            	    $this->createActionList($action);
            	    break;
            	case 'Create':
            	    $this->createActionAdd($action);
            	    break;
            	case 'Edit':
            	    $this->createActionEdit($action);
            	    break;
            	default:
            	    break;
            }
        }

    }

    public function createErrorView()
    {
        return $this->createFileFromCopy(
            'view/error.module',
            'index.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/error'
        );
    }

    public function create404View()
    {
        return $this->createFileFromCopy(
            'template/view/error/404',
            '404.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/error'
        );
    }

    public function createDirectory($page)
    {

        $controllerDir = sprintf(
            '%s/module/%s/view/%s/%s',
            $this->getConfig()->getLocal(),
            $this->getConfig()->getModule(),
            $this->str('url', $this->getConfig()->getModule()),
            $this->str('url', str_replace('Controller', '',$page->getController()->getName()))
        );

        if (!is_dir($controllerDir)) {
            $this->getDirService()->mkDir($controllerDir);
        }
        $this->setLocation($controllerDir);

        return true;

    }

    public function createFromPage(\Gear\ValueObject\Action $page)
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createDirectory($page);

        $filename     = sprintf('%s.phtml', $this->str('url', $page->getName()));
        $filelocation = sprintf(
            '%s/module/%s/view/%s/%s',
            $this->getConfig()->getLocal(),
            $this->getConfig()->getModule(),
            $this->str('url', $this->getConfig()->getModule()),
            $this->str('url', str_replace('Controller', '',$page->getController()->getName())),
            $this->str('url', $page->getName())
        );

        $this->setTimeTest(new \DateTime('now'));

        $this->createFileFromTemplate(
            'template/view/simple.page.phtml',
            array(
                'module' => $this->str('class', $this->getConfig()->getModule()),
                'controller' => $this->str('class', $page->getController()->getName()),
                'action' => $this->str('class', $page->getName()),
                'version' => $this->getVersion(),
                'date' => $this->getTimeTest()->format('d-m-Y H:i:s')
            ),
            $filename,
            $filelocation
        );

    }

    public function createIndexView()
    {
        $config = $this->getServiceLocator()->get('config');

        $this->createFileFromTemplate(
            'view/simple.module',
            array(
                'module' => $this->str('label', $this->getConfig()->getModule()),
                'version' => $config['version'***REMOVED***
            ),
            'index.phtml',
            sprintf(
                '%s/module/%s/view/%s/index',
                $this->getConfig()->getLocal(),
                $this->getConfig()->getModule(),
                $this->str('url', $this->getConfig()->getModule())
            )
        );
    }

    public function createDeleteView()
    {
        return $this->createFileFromCopy(
            'template/view/layout/delete',
            'delete.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }

    public function createLayoutView()
    {
        return $this->createFileFromCopy(
            'view/layout.module',
            'layout.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }

    public function createBreadcrumbView()
    {
        return $this->createFileFromCopy(
            'view/breadcrumb',
            'breadcrumb.phtml',
            $this->getConfig()->getLocal().'/module/'.$this->getConfig()->getModule().'/view/layout'
        );
    }


    public function getTimeTest()
    {
        return $this->timeTest;
    }

    public function setTimeTest(\DateTime $timeTest)
    {
        $this->timeTest = $timeTest;
        return $this;
    }

	public function getLocation()
	{
		return $this->location;
	}

	public function setLocation($location)
	{
		$this->location = $location;
		return $this;
	}

}
