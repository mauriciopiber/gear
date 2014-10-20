<?php
/**
 *
 * @author piber
 * 0.1.0 - Essa classe será responsável por adicionar cruds ao módulos zf2 do gear.
 */
namespace Gear\Service;

use Gear\Service\AbstractJsonService;

class PageService extends AbstractJsonService
{
    public function getSchema()
    {
        return \Zend\Json\Json::decode(file_get_contents($this->getJson()));
    }

    public function isPageAlreadyExist(\Gear\ValueObject\Page $page)
    {


    }

    /**
     */
    public function pushPageIntoSchema(\Gear\ValueOBject\Page $page)
    {
        $json = \Zend\Json\Json::decode(file_get_contents($this->getJson()));

        $index = new \stdClass();
        $index->controller = $page->getController();
        $index->action     = $page->getAction();
        $index->route      = $page->getRoute();
        $index->role       = $page->getRole();

        $module = $this->getConfig()->getModule();

        $pages = &$json->$module->page;
        $pages[***REMOVED*** = $index;

        $this->getJsonService()->writeJson(\Zend\Json\Json::encode($json));
    }

    public function create(\Gear\ValueOBject\Page $page)
    {
        $this->pushPageIntoSchema($page);

        $controller      = $this->getServiceLocator()->get('controllerService');

        $controllerTest  = $this->getServiceLocator()->get('controllerTestService');

        $view            = $this->getServiceLocator()->get('viewService');

        $pageTest        = $this->getServiceLocator()->get('pageTestService');

        $acceptanceTest  = $this->getServiceLocator()->get('acceptanceTestService');

        $functionalTest  = $this->getServiceLocator()->get('functionalTestService');

        $config          = $this->getServiceLocator()->get('configService');



        return 'pageService'."\n";

        if ($this->isPageAlreadyExist($pageToCreate)) {
            return sprintf('%s $s already exists', $controller, $action);
        }

        //criar teste unitário pro controller baseado nos parametros existentes
        //criar teste de aceitação pro controller baseado nos parametros
        //criar teste de funcionalidade pro controller baseado nos parametros
        //cria controller baseado nos parametros existentes cadastrados
        //cria view
        //cria navigation baseado nos parametros existentes
        //cria router baseado nos parametros existentes cadastrados
        //adiciona invokable baseado nos parametros existentes

        $pages = $this->getPages();

        return 'sem mock';
        /**
            @endGearing=1:
         */
    }

    public function delete()
    {
        return null;
    }
}
