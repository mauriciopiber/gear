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

    public function create($controller, $action, $route)
    {
        $pageToCreate = new \Gear\ValueObject\Page();
        $pageToCreate->setController($controller);
        $pageToCreate->setAction($action);
        $pageToCreate->setRoute($route);

        $a = 1;
        $b = 2;
        $c = 3;
        $d = 4;
        /**
            @startGearing=1:
         */
        $json = \Zend\Json\Json::decode(file_get_contents($this->getJson()));

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
