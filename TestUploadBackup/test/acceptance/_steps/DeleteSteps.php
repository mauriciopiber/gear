<?php
namespace TestUpload\AcceptanceTester;

/**
 * @SuppressWarnings(PHPMD)
 */
class DeleteSteps extends \TestUpload\AcceptanceTester\AcceptanceSteps
{

    public function verifyCanViewBeforeDelete($class, $label, $idToView)
    {
        $I = $this;
        $editPage = str_replace('DeletePage', 'ViewPage', $class);
        $instance = new $editPage;

        $I->amOnPage($instance::$URL.'/'.$idToView);
        $I->seeCurrentUrlEquals($instance::$URL.'/'.$idToView);
        $I->see('Visualizar '.$label.' - '.$idToView);
    }

    public function verifyFilterInstanceBeforeDelete($class, $numberReference)
    {
        $I = $this;
        $editPage = str_replace('DeletePage', 'ListPage', $class);
        $instance = new $editPage;

        $I->amOnPage($instance::$URL);

        $I->click('Exibir Filtro');
        $I->fillField('#likeField', $numberReference);
        $I->click('Pesquisar');
        $I->seeNumberOfElements($instance::$tableBodyRow, 1);
        $I->see($numberReference, $instance::getTableBodyRowByIndex(1));
    }

    public function verifyDeleteSuccessfulFromTableIndex($class, $label, $actionRow)
    {
        $I = $this;
        $editPage = str_replace('DeletePage', 'ListPage', $class);
        $instance = new $editPage;

        $I->click($instance::getTableBodyRowColumnByIndex(1, $actionRow).' form > a');


        $instance = new $class;

        $I->waitForElement($instance::$modalTitle, 3);
        $I->see('Deletar '.$label, $instance::$modalTitle);
        $I->see('Desejas realmente deletar '.$label.'?', $instance::$modalText);

        $I->click($instance::$btnConfirm);
        $I->see('Sucesso! Deletado.');

        $I->amOnPage($instance::$URL);
    }
}
