<?php
namespace TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class ListSteps extends \TestUpload\AcceptanceTester\AcceptanceSteps
{

    /**
     * Função responsável por contar quantos ítens possui na cabeça da tabela,
     * pra evitar que apareçam dados a mais que necessário.
     */
    public function verifyHeadTable($class, $countItens)
    {
        $instance = new $class();
        $I = $this;
        $I->seeNumberOfElements($instance::$tableHeadRow, $countItens);

        unset($instance);
    }

    public function verifyOnPage($class, $label)
    {
        $I = $this;
        $instance = new $class;
        $I->amOnPage($instance::$URL);
        $I->see($label);
    }


    /**
     * Função responsável por verificar a tela de abertura da página de listar, ao acessar pela primeira vez
     */

    public function verifyFirstListing($class)
    {
        $I = $this;
        $instance = new $class();
        $I->seeNumberOfElements($instance::$tableBodyRow, 10);
        $I->see('30', $instance::getTableBodyRowByIndex(1));
        $I->dontSee('29', $instance::getTableBodyRowByIndex(1));
        $I->dontSee('30', $instance::getTableBodyRowByIndex(10));
        $I->see('21', $instance::getTableBodyRowByIndex(10));

        unset($instance);
    }


    public function verifyFilterByLike($class)
    {
        $I = $this;
        $instance = new $class();
        $I->click('Exibir Filtro');
        $I->fillField('#likeField', '15');
        $I->click('Pesquisar');
        $I->seeNumberOfElements($instance::$tableBodyRow, 1);
        $I->see('15', $instance::getTableBodyRowByIndex(1));


        $I->click('Exibir Filtro');
        $I->fillField('#likeField', '21');
        $I->click('Pesquisar');
        $I->seeNumberOfElements($instance::$tableBodyRow, 1);
        $I->see('21', $instance::getTableBodyRowByIndex(1));

        unset($instance);
    }


    public function verifyResetFilter($class)
    {
        $I = $this;
        $instance = new $class();
        //limpar filtro e voltar ao normal.
        $I->click('Exibir Filtro');
        $I->click('Limpar');
        $I->click('Pesquisar');
        $I->seeNumberOfElements($instance::$tableBodyRow, 10);
        $I->see('30', $instance::getTableBodyRowByIndex(1));

        unset($instance);
    }

    public function verifyPaginator($class)
    {
        $I = $this;
        $instance = new $class();

        //paginar todas páginas verificando se primeiro e último ítens são os esperados compatíveis ao banco.
        $I->click($instance::getPaginatorByIndex(2).' > a');
        $I->see('30', $instance::getTableBodyRowByIndex(1));
        $I->see('21', $instance::getTableBodyRowByIndex(10));

        $I->click($instance::getPaginatorByIndex(3).' > a');
        $I->see('20', $instance::getTableBodyRowByIndex(1));
        $I->see('11', $instance::getTableBodyRowByIndex(10));

        $I->click($instance::getPaginatorByIndex(4).' > a');
        $I->see('10', $instance::getTableBodyRowByIndex(1));
        $I->see('1', $instance::getTableBodyRowByIndex(10));

        unset($instance);
        //ordenar por ID e verificar em cada página da paginação se o primeiro item e o último estão corretos.
    }

    public function verifyOrdenationById($class)
    {
        $I = $this;
        $instance = new $class();

        $I->click($instance::getTableHeadColumnByIndex(1).' > a');
        $I->see('1', $instance::getTableBodyRowByIndex(1));
        $I->see('10', $instance::getTableBodyRowByIndex(10));

        $I->click($instance::getPaginatorByIndex(3).' > a');
        $I->see('11', $instance::getTableBodyRowByIndex(1));
        $I->see('20', $instance::getTableBodyRowByIndex(10));

        unset($instance);
    }
}
