<?php
namespace FunctionalTester;

class ListSteps extends \FunctionalTester
{
    public function verifyPaginator($class)
    {
        $instance = new $class;
        $I = $this;

        $I->see('Mostrando 1 até 10 de 30 entradas', $instance::$paginatorCount);
        $I->see('<<', $instance::getPaginatorByIndex(1));
        $I->see('1', $instance::getPaginatorByIndex(2));
        $I->seeLink('1', $instance::$URL);
        $I->see('2', $instance::getPaginatorByIndex(3));
        $I->seeLink('2', $instance::$URL);
        $I->see('3', $instance::getPaginatorByIndex(4));
        $I->seeLink('3', $instance::$URL);
        $I->see('>>', $instance::getPaginatorByIndex(5));
        $I->seeNumberOfElements($instance::$paginator, 5);
    }

    public function verifyFilter($class)
    {
        $instance = new $class;
        $I = $this;

        $I->see('Exibir Filtro',$instance::$filterBtn);
        $I->click($instance::$filterBtn);
        $I->see('Esconder Filtro', $instance::$filterBtn);

        $I->seeInField($instance::$filterSearchBtn, 'Pesquisar');
        $I->seeInField($instance::$filterClearBtn, 'Limpar');
        $I->seeInField($instance::$filterLikeField, '');
    }

    public function verifyBreadcrumb($class, $module, $controller, $action)
    {
        $instance = new $class;
        $I = $this;

        $I->see($module, $instance::getBreadcrumbByIndex(1));
        $I->see($controller, $instance::getBreadcrumbByIndex(2));
        $I->see($action, $instance::getBreadcrumbByIndex(3));
        $I->seeNumberOfElements($instance::$breadscrumb, 3);
    }

}
